<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('dashboard.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $data = $request->only(['name', 'qty', 'price', 'description']);
        $data['user_id'] = Auth::id();

        if($request->hasfile('image')) {
            // rename
            $file = $request['image']->getClientOriginalName();
            $name = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $image = time().'-'.$name.'.'.$ext;
    
            Storage::putFileAs('public/products/', $request['image'], $image);
            $data['image'] = $image;
        }

        if(Product::create($data)) {
            return redirect()->route('products.index')->with('status', 'Product was created successfully.');
        }

        return redirect()->back()->with('status', 'Something want wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('view-product', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        return view('dashboard.products.edit', [
            'product' => $product
        ]);
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
        $request->validate([
            'name' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required'
        ]); 
        
        $data = $request->only(['name', 'qty', 'price', 'description']);
        $product = Product::findOrFail($id);

        if($request->hasfile('image')) {
            // rename
            $file = $request['image']->getClientOriginalName();
            $name = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $image = time().'-'.$name.'.'.$ext;
    
            Storage::delete($product->image);
            Storage::putFileAs('public/products/', $request['image'], $image);
            $product->image = $image;
        }
        
        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;

        if($product->save()) {
            return redirect()->route('products.index')->with('status', 'Product was updated successfully.');
        }
        
        return redirect()->back()->with('status', 'Something want wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->delete()){
            return redirect()->route('products.index')->with('status', 'Product was deleted successfully.');
        }
        
        return redirect()->back()->with('status', 'Something want wrong!');
    }
}
