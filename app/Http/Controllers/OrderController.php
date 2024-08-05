<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::leftJoin('order_details as od', 'orders.id', '=', 'od.order_id')
            ->leftJoin('users as u', 'orders.user_id', '=', 'u.id')
            ->select('orders.*', 'u.username', DB::raw('COUNT(od.id) as total_item'))
            ->groupBy('orders.id')
            ->orderBy('orders.status', 'ASC')
            ->paginate(6);
        return view('app.admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function updateStatus(String $voucher_id)
    {
        $voucher = Order::find($voucher_id);
        if ($voucher) {
            if ($voucher->status == 1) {
                $voucher->status = 2;
            } else {
                $voucher->status = 3;
            }
            $voucher->update();
            return back()->with('statusSuccess', 'Voucher updated successfully!');
        } else {
            return back()->with('statusError', 'No voucher found to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
