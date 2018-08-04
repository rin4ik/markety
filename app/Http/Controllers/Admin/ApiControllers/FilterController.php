<?php

namespace App\Http\Controllers\Admin\ApiControllers;

use App\Filter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::get();
        return $filters;
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
        $allList = request('list');
        foreach ($allList as $index => $item) {
            if (!empty($item['uz']) && !empty($item['ru'])) {
                $data[] = $index + 1 . '/' . $item['uz'] . '=' . $item['ru'];
            }
        }

        request()->validate([
            'name' => 'required',
            'category_id' => 'required',
            'name_ru' => 'required',
            'position' => 'required',
            'list' => 'required',
            'type' => 'required',
            'status' => 'required',
            'use' => 'required',
        ]);
        $filter = Filter::create([
                'category_id' => request('category_id'),
                'name' => request('name'),
                'name_ru' => request('name_ru'),
                'position' => request('position'),
                'list' => $data,
                'type' => request('type'),
                'status' => request('status'),
                'use' => request('use')
            ]);

        return response()->json($filter->loadMissing('category'), 200);
    }

    public function remove()
    {
        Filter::truncate();
        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Filter  $filter
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Filter $filter)
    {
        $allList = request('list');
        foreach ($allList as $index => $item) {
            if (!empty($item['uz']) && !empty($item['ru'])) {
                $data[] = $index + 1 . '/' . $item['uz'] . '=' . $item['ru'];
            }
        }
        request()->validate([
            'name' => 'required',
            'name_ru' => 'required',
            'category_id' => 'required',
            'position' => 'required',
            'list' => 'required',
            'type' => 'required',
            'status' => 'required',
            'use' => 'required'
        ]);
        $filter->update([
            'name' => request('name'),
            'name_ru' => request('name_ru'),
            'position' => request('position'),
            'category_id' => request('category_id'),
            'list' => $data,
            'type' => request('type'),
            'status' => request('status'),
            'use' => request('use')
        ]);

        return response()->json($filter->loadMissing('category'), 200);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Filter  $filter
    * @return \Illuminate\Http\Response
    */
    public function destroy(Filter $filter)
    {
        $filter->delete();
        return response()->json(null, 200);
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
