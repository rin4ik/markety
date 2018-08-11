<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::get();
        $categories = Category::all();
        foreach ($manufacturers as $manufacturer) {
            $options = [];
            foreach ($manufacturer->categories as $key => $value) {
                $options[] = $value->pivot->category_id;
            }
            $manufacturer['categoryIds'] = $options;
        }

        return view('admin.pages.manufacturers.index', compact('manufacturers', 'categories'));
    }

    public function store(Request $request)
    {
    }

    public function update(Manufacturer $manufacturer, Request $request)
    {
    }
}
