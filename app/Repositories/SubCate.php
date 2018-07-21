<?php

namespace App\Repositories;

use App\Category;

class SubCate
{
    public function getCategories()
    {
        $categories = Category::where('parent_id', null)->get();//united
        $categories = $this->addRelation($categories);

        return $categories;
    }

    public function selectChild($id)
    {
        $categories = Category::where('parent_id', $id)->get(); //rooney

        $categories = $this->addRelation($categories);

        return $categories;
    }

    protected function addRelation($categories)
    {
        $categories->map(function ($item, $key) {
            $sub = $this->selectChild($item->id);

            return $item = array_add($item, 'child_categories', $sub);
        });

        return collect($categories);
    }
}
