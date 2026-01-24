<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.Order.index', compact('orders'));
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
    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id)->first();
        $order_items = OrderItem::where('order_id', $order->id)->with('item')->get();
        return view('admin.Order.detail', compact('order', 'order_items'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status_cooked($id){
        $order = Order::findOrFail($id);
        $order->status = 'cooked';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }

    public function order_confirm($id){
        $order = Order::findOrFail($id);
        
        if($order->status == 'pending' || $order->status == 'cooked'){
            $order->status = 'settlement';
        }elseif($order->status == 'settlement'){
            $order->status = 'pending';
        }

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');

    }
}
