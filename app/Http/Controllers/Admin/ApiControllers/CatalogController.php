<?php

namespace App\Http\Controllers\Admin\ApiControllers;

use App\Catalog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::with('category')->get()->toTree();
        return $catalogs;
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
                    'name' => 'required',
                    'name_ru' => 'required',
                    'fullName' => 'required',
                    'fullName_ru' => 'required',
                    'status' => 'required',
                ]);
        $catalog = Catalog::create([
                    'parent_id' => request('parent_id'),
                    'category_id' => request('category_id'),
                    'name' => request('name'),
                    'name_ru' => request('name_ru'),
                    'fullName' => request('fullName'),
                    'fullName_ru' => request('fullName_ru'),
                    'status' => request('status')
                ]);
        $catalog->load('descendants');

        return response()->json($catalog, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $catalog->update([
            'parent_id' => request('parent_id'),
            'category_id' => request('category_id'),
            'name' => request('name'),
            'name_ru' => request('name_ru'),
            'fullName' => request('fullname'),
            'fullName_ru' => request('fullname_ru'),
            'status' => request('status')
        ]);
        $catalog->load('descendants');
        return response()->json($catalog, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return response()->json(null, 200);
    }
}
