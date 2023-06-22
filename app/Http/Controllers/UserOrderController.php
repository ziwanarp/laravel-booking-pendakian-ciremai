<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Kuota;
use App\Models\Order;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;

define('HARGA', '50000');

class UserOrderController extends Controller
{
    public function order()
    {

        if (request()->kuota != null) {
            $kuota = Kuota::where('id', request()->kuota)->get();

            return view('user.order.order', [
                'title' => 'Detail Order',
                'kuota' => $kuota
            ]);
        } else {
            return redirect('/');
        }
    }

    public function konfirmasiOrder()
    {

        $harga = HARGA * request()->jumlah_pendaki;
        return view('user.order.konfirmasi', [
            'title' => 'Upload Bukti Pembayaran',
            'order' => request(),
            'harga' => $harga
        ]);
    }

    public function orderStore(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'kuota_id' => 'required',
            'kode_order' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'jalur' => 'required',
            'tanggal_naik' => 'required',
            'tanggal_turun' => 'required',
            'jumlah_pendaki' => 'required',
        ];

        $validatedData = $request->validate($rules);

        // set kode order
        $tgl = preg_replace("/[^a-zA-Z0-9]/", "", $validatedData['tanggal_naik']);
        $validatedData['kode_order'] = $validatedData['kode_order'] . strtoupper(substr($validatedData['jalur'], 0, 3)) . $tgl . $validatedData['jumlah_pendaki'] . (rand(10, 99));;

        $order = Order::create($validatedData);

        if ($order === false) {
            Alert::error('Booking Gagal !');
            return redirect('/');
        } else {
            // dapatkan kuota berdasarkan id
            $kuota = Kuota::where('id', $validatedData['kuota_id'])->get();
            // jumlah kuota dikurang jumlah order
            $kuota = $kuota[0]->jumlah_kuota - $validatedData['jumlah_pendaki'];
            // update kuota
            Kuota::where('id', $validatedData['kuota_id'])->update(['jumlah_kuota' => $kuota]);

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->kode_order,
                    'gross_amount' => $order->harga,
                ),
                'customer_details' => array(
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->user->no_hp,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            $order->update(['snapToken' => $snapToken]);

            Alert::success('Lakukan Pembayaran !');
            return redirect('/order/myorders?order=' . $order->kode_order);
        }
    }

    public function myOrders()
    {
        //abdil data waktu hari ini, untuk booking h+1
        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');
        if (request()->order != null) {
            $order = Order::where('kode_order', request()->order)->get();
            return view('user.order.detail', [
                'title' => 'Detail Order',
                'order' => $order,
            ]);
        } else {
            $order = Order::where('user_id', auth()->user()->id)->get();
            return view('user.order.myorder', [
                'title' => 'My Orders',
                'orders' => $order,
                'today' => $today,
            ]);
        }
    }

    public function struk($request)
    {
        $data = Order::where('kode_order', $request)->get();
        $data = $data[0];
        // return view('user.strukpembayaran.index', ['data' => $data]);
        $pdf = Pdf::loadView('user.strukpembayaran.index', ['data' => $data]);
        return $pdf->download('Struk_' . $request . '.pdf');
    }

    public function getReschedule(Order $order)
    {
        //abdil data waktu hari ini, untuk booking h+1
        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');
        if ($order->reschedule > 0 || $order->tanggal_naik < $today || $order->status == 'Tolak') {
            Alert::error('Forbidden !');
            return redirect('/order/myorders');
        }
        return view('user.reschedule.index', [
            'title' => 'Reschedule Pendakian',
            'order' => $order,
            'today' => $today,
        ]);
    }

    public function reschedule(Request $request, Order $order)
    {
        // cek apakah kuota untuk reschedule tersedia
        $hasil = Kuota::where('jalur', $request->jalur)->where('tanggal', $request->tanggal_naik)->where('jumlah_kuota', '>=', $request->jumlah_pendaki)->get();

        // jika kuota reschedule tersedia
        if ($hasil->count() > 0) {
            // set tanggal turun = tanggal naik +3 days
            $tgl_turun = Carbon::parse($request->tanggal_naik)->addDays(3)->format('Y-m-d');
            // update data reschedule
            Order::where('id', $order->id)->update(['tanggal_naik' => $request->tanggal_naik, 'tanggal_turun' => $tgl_turun, 'reschedule' => 1]);
            // update jumlah kuota
            $update_kuota = $hasil[0]->jumlah_kuota - $request->jumlah_pendaki;
            $hasil[0]->update(['jumlah_kuota' => $update_kuota]);

            Alert::success('Reschedule Berhasil !');
            return redirect('order/myorders');
        }
        // jika kuota reshedule tidak tersedia
        else {
            Alert::error('Reschedule Gagal !', 'Kuota tidak tersedia !!!');
            return redirect('order/myorders');
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = Order::where('kode_order', $request->order_id)->get();
                $order = $order[0];
                $order->update(['status' => 'Konfirmasi']);
            }
            if ($request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                $order = Order::where('kode_order', $request->order_id)->get();
                $order = $order[0];
                $order->update(['status' => 'Tolak']);
            }
        }
    }
}
