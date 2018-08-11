<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Product;
use Illuminate\Http\Request;
use App\ModelFilters\ProductFilter;

class CatalogController extends Controller
{
    public function show(Catalog $catalog, Request $request)
    {
        if (request()->wantsJson()) {
            $items = Product::with('manufacturer')->filter($request->all(), ProductFilter::class)->paginate(32);
            $products = [
                'pagination' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'from' => $items->firstItem(),
                    'to' => $items->lastItem(),
                    'offset' => 5
                ],
                'data' => $items
            ];
            return  $products = collect($products);
        }
        // $catalog->loadMissing('category.manufacturers');
        $items = Product::with('manufacturer')->filter(['categoryId' => $catalog->category_id, 'brands' => $request->brands], ProductFilter::class)->paginate(32);
        $products = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'offset' => 5
            ],
            'data' => $items,
            'brands' => $request->all()
        ];
        $products = collect($products);
        $catalog->loadMissing(['category.manufacturers.products' => function ($query) use ($catalog) {
            return  $query->where('category_id', $catalog->category_id);
        }]);

        if (count($catalog->children) > 0) {
            return view('pages.catalogs.index', compact('catalog'));
        }
        $filters = $catalog->category->filters;
        return view('pages.catalogs.show', compact('catalog', 'filters', 'products'));
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
