<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Repositories\SubCate;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $subcate = new SubCate;
        $allCategories = Category::all();
        try {
            $categories = $subcate->getCategories();
        } catch (Exception $e) {
            //no parent category found
        }
        return view('admin.pages.categories.index', compact('categories', 'allCategories'));
    }

    public function store()
    {
        $subcate = new SubCate;

        request()->validate([
            'name' => 'required',
            'name_ru' => 'required',
            'fullName' => 'required',
            'fullName_ru' => 'required',
            'status' => 'required'
        ]);
        $category = Category::create([
            'parent_id' => request('parent_id'),
            'name' => request('name'),
            'name_ru' => request('name_ru'),
            'fullName' => request('fullname'),
            'fullName_ru' => request('fullname_ru'),
            'status' => request('status')
        ]);

        return response()->json($category->loadMissing('childCategories'), 200);
    }

    public function update(Category $category)
    {
        $category->update([
            'parent_id' => request('parent_id'),
            'name' => request('name'),
            'name_ru' => request('name_ru'),
            'fullName' => request('fullname'),
            'fullName_ru' => request('fullname_ru'),
            'status' => request('status')
        ]);
        return response()->json($category->loadMissing('childCategories'), 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 200);
    }
}
