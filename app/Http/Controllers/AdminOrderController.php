<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // jika ada request
        if (request()) {

            // tolak pesanan via request
            if (request()->tolak != null) {
                Order::where('id', request()->tolak)->update(array('status' => 'Tolak'));
                Alert::error('Order Ditolak');
                return redirect('/dashboard/order');

                // Konfirmasi pesanan via request
            } elseif (request()->confirm != null) {
                Order::where('id', request()->confirm)->update(array('status' => 'Konfirmasi'));
                Alert::success('Order di Konfirmasi');
                return redirect('/dashboard/order');

                // Detail order via request
            } elseif (request()->kode_order != null) {
                $order = Order::where('kode_order', request()->kode_order)->get();
                return view('admin.dashboard.order.show', [
                    'title' => 'Detail Order',
                    'order' => $order,
                ]);
            }
        }

        return view('admin.dashboard.order.index', [
            'title' => 'Order',
            'orders' => Order::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
