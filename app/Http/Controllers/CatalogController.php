<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Http\Request;
use App\Product;

class CatalogController extends Controller
{
    public function show(Catalog $catalog, Request $request)
    {
        if (request()->wantsJson()) {
            $products = Product::with('manufacturer')->ofCategory($request->categoryId)->ofBrands($request->brands)
            ->get();
            return response()->json($products, 200);
        }
        $catalog->loadMissing(['category.manufacturers.products' => function ($query) use ($catalog) {
            return  $query->where('category_id', $catalog->category_id);
        }]);
        $catalog->loadMissing('category.products.manufacturer');

        if (count($catalog->children) > 0) {
            return view('pages.catalogs.index', compact('catalog'));
        }
        $filters = $catalog->category->filters;
        return view('pages.catalogs.show', compact('catalog', 'filters'));
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
