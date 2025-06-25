<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasRole('admin')) {
            $orders = Order::where('user_id', Auth::id())->get();
        } else {
            $orders = Order::all();
        }

        return view('dashboard.orders.index', [
            'orders' => $orders
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasRole('admin')) {
            // Only allow clients to delete their own orders
            $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
            if (!$order) {
                return redirect()->route('client.orders.index')->with('status', 'You are not allowed to delete this order!');
            }
            $order->products()->detach();
            if($order->delete()){
                return redirect()->route('client.orders.index')->with('status', 'Order was deleted successfully.');
            }
            return redirect()->back()->with('status', 'Something went wrong!');
        }

        $order = Order::findOrFail($id);
        $order->products()->detach();
        if($order->delete()){
            return redirect()->route('admin.orders.index')->with('status', 'Order was deleted successfully.');
        }
        return redirect()->back()->with('status', 'Something went wrong!');
    }
}
