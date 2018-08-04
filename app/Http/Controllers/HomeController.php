<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::get()->toTree();
        return view('pages.index', compact('catalogs'));
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
     * @param  \App\Catalog  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catalog  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catalog  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catalog  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $category)
    {
        //
    }
}
