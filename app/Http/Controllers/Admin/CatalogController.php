<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\Category;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::get()->toTree();
        $categories = Category::get();
        $all = Catalog::get();
        return view('admin.pages.catalogs.index', compact('catalogs', 'all', 'categories'));
    }

    public function store()
    {
        return response()->json($catalog->loadMissing('childCatalogs'), 200);
    }

    public function update(Catalog $catalog)
    {
    }

    public function destroy(Catalog $catalog)
    {
    }
}
