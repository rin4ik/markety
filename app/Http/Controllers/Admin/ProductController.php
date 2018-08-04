<?php

namespace App\Http\Controllers\Admin;

use App\Filter;
use App\Product;
use App\Category;
use App\Manufacturer;
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
        $categories = Category::with('filters')->get();
        $manufacturers = Manufacturer::get();
        $filterset = Filter::get();
        foreach ($filterset as $filter) {
            $count = 0;
            $options = [];
            foreach ($filter->list as $id => $_array) {
                if (is_array($_array) && $limit > 0) {
                    $count += count_recursive($_array, $limit - 1);
                } else {
                    $count += 1;
                    $options[$id] = $this->multiexplode(['/', '='], $_array);
                    // $options[$id] = explode('/', );
                }
            }
            $filters[] = [
                    'name' => $filter->name,
                    'name_ru' => $filter->name_ru,
                    'options' => $options,
                    'type' => $filter->type,
                    'status' => $filter->status,
                    'use' => $filter->use,
                    'position' => $filter->position
                ];
        };
        $filters = collect($filters);
        return view('admin.pages.products.index', compact('filters', 'products', 'categories', 'manufacturers'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
