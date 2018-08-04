<?php

namespace App\Http\Controllers\Admin\ApiControllers;

use App\Category;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'name_ru' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->name_ru = $request->name_ru;

        $category->save();
        return response()->json($category, 200);
    }

    public function update(Category $category, Request $request)
    {
        request()->validate([
            'name' => 'required',
            'name_ru' => 'required'
        ]);
        $category->update([
            'name' => request('name'),
            'name_ru' => request('name_ru')
        ]);
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 200);
    }

    public function remove()
    {
        Category::truncate();
        return response()->json(200);
    }
}
