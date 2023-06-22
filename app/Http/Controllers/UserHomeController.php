<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;

use App\Models\Kuota;
use App\Models\Interfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    public function index()
    {
        //ambil data waktu hari ini, untuk booking h+1
        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');

        // abil data interface
        $data = Interfaces::all();

        // jika $ data tidak null maka jalankan
        if ($data->count() > 0) {
            $data = $data[0];
            return view('user.index', [
                'jalur' => Kuota::all()->groupBy('jalur'),
                'title' => 'Home',
                'data' => $data,
                'today' => $today,
            ]);
        } else {

            // jika $data null maka jalankan
            return view('user.index', [
                'jalur' => Kuota::all()->groupBy('jalur'),
                'title' => 'Home',
                'today' => $today,
            ]);
        }
    }

    public function about()
    {
        return view('user.about', ['title' => 'About']);
    }

    public function contact()
    {
        return view('user.contact', ['title' => 'Contact']);
    }

    public function direct()
    {
        return redirect('/');
    }

    public function checkKuota()
    {
        return view('user.kuota.index', [
            'jalur' => Kuota::all()->groupBy('jalur'),
            'bulan' => Kuota::all()->groupBy('bulan'),
            'tahun' => Kuota::all()->groupBy('tahun'),
            'kuota' => Kuota::filter(request(['jalur', 'tanggal', 'jumlah_kuota']))->get(),
            'title' => 'Check Kuota'
        ]);
    }

    public function kuotaPerBulan()
    {

        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');

        return view('user.kuota.kuotaperbulan', [
            'jalur' => Kuota::all()->groupBy('jalur'),
            'bulan' => Kuota::all()->groupBy('bulan'),
            'tahun' => Kuota::all()->groupBy('tahun'),
            'kuota' => Kuota::filter(request(['jalur', 'bulan', 'tahun']))->get(),
            'title' => 'Check Kuota per Bulan',
            'today' => $today
        ]);
    }
}
