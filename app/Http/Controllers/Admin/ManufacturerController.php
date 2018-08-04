<?php

namespace App\Http\Controllers\Admin;

use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.pages.manufacturers.index', compact('manufacturers'));
    }

    public function store(Request $request)
    {
    }

    public function update(Manufacturer $manufacturer, Request $request)
    {
    }
}
