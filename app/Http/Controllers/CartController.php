<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderShipped;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index() {
        return view('cart');
    }
    
    public function add(Request $request, $product) {
        $product = Product::findOrFail($product);

        if($product->qty <= 0) {
            return redirect()->route('shop')->with('status', 'Product is out of stock!');
        }

        $request->validate([
            'qty' => 'required|integer|lte:'.$product->qty
        ]);

        $item = array(
            'id' => $product->id,
            'price' => $product->price,
            'quantity' => $request->qty,
            'name' => $product->name
        );

        // add to cart
        if(\Cart::add($item)) {
            return redirect()->route('cart.index')->with('status', 'Product was added to cart successfully.');
        }

        // redirect (cart)
        return redirect()->back()->with('status', 'Something want wrong!');
    }

    public function inc($item) {
        $product = Product::findOrFail($item);
        $cart_item = \Cart::get($item);

        if($cart_item['quantity'] < $product->qty) {
            \Cart::update($item, ['quantity' => 1]);
            return redirect()->back();
        } else {
            return redirect()->back()->with('cart_status', 'We only have ' .$product->qty .' ' .$product->name .' in stock!');
        }
    }

    public function dec($item) {
        $cart_item = \Cart::get($item);

        if($cart_item['quantity'] <= 1) {
            \Cart::remove($item);
        } else {
            \Cart::update($item, ['quantity' => -1]);
        }

        return redirect()->back();
    }

    public function checkout(Request $request) {
        // No required fields for checkout
        $user = Auth::user();
        $data = [
            'fullname' => $user->name,
            'email' => $user->email,
            'phone' => $request->phone ?? '',
            'user_id' => $user->id,
            'total' => \Cart::getTotal(),
        ];

        $order = Order::create($data);
        $pids = [];

        foreach(\Cart::getContent() as $item) { 
            $pids[] = $item->id;

            // update stock
            $p = Product::find($item->id);
            $p->qty -= $item->quantity;
            $p->save();

            // delete item from cart
            \Cart::remove($item->id);

            // send email to product owner (for each product)
            // $user = $p->user()->first();
            // Mail::to($user->email)->send(new OrderShipped($order));
        }

        $order->products()->attach($pids);

        // send email to customer
        // Mail::to($request->email)->send(new OrderShipped($order));

        if (Auth::user() && Auth::user()->hasRole('client')) {
            return redirect()->route('client.orders.index')->with('status', 'Order was created successfully.');
        }
        return redirect()->route('orders.index')->with('status', 'Order was created successfully.');
    }
}
