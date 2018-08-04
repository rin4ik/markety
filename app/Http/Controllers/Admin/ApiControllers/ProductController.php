<?php

namespace App\Http\Controllers\Admin\ApiControllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('manufacturer', 'category')->get();
        return $products;
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
        request()->validate([
            'category_id' => 'required',
            'manufacturer_id' => 'required',
            'list' => 'required'
        ]);
        $product = Product::create([
            'category_id' => $request->category_id,
            'manufacturer_id' => $request->manufacturer_id,
            'list' => $request->list,
        ]);
        return response()->json($product->loadMissing('manufacturer', 'category'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'category_id' => 'required',
            'manufacturer_id' => 'required',
            'list' => 'required'
        ]);
        $product->update([
            'category_id' => request('category_id'),
            'manufacturer_id' => request('manufacturer_id'),
            'list' => request('list')
        ]);
        return response()->json($product->loadMissing('manufacturer', 'category'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 200);
    }

    public function remove()
    {
        Product::truncate();
        return response()->json(null, 200);
    }
}
