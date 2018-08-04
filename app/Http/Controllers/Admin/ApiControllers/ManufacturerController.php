<?php

namespace App\Http\Controllers\Admin\ApiControllers;

use App\Manufacturer;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return $manufacturers;
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required'
        ]);
        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->name;
        if ($request->get('logo')) {
            $logo = $request->get('logo');
            $name = time() . '.' . explode('/', explode(':', substr($logo, 0, strpos($logo, ';')))[1])[1];
            \Image::make($request->get('logo'))->resize(60, 60, function ($c) {
                $c->upsize();
            })->save(public_path('uploads/brands/') . $name);
            $manufacturer->logo = $name;
        }
        $manufacturer->save();
        return response()->json($manufacturer, 200);
    }

    public function update(Manufacturer $manufacturer, Request $request)
    {
        request()->validate([
            'name' => 'required'
        ]);
        $manufacturer->update([
            'name' => request('name')
        ]);
        if ($request->get('logo')) {
            $logo = $request->get('logo');
            $name = time() . '.' . explode('/', explode(':', substr($logo, 0, strpos($logo, ';')))[1])[1];
            \Image::make($request->get('logo'))->fit(60, 60, function ($c) {
                $c->upsize();
            })->save(public_path('uploads/brands/') . $name);
            $manufacturer->update([
                'logo' => $name
            ]);
        }
        return response()->json($manufacturer, 200);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return response()->json(null, 200);
    }

    public function remove()
    {
        Manufacturer::truncate();
        return response()->json(null, 200);
    }
}
