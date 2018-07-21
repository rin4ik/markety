<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['child_categories'];

    public function transform(Category $category)
    {
        return [
                'id' => $category->id,
                'parent_id' => $category->parent_id,
                'name' => $category->name,
                'name_ru' => $category->name_ru,
                'fullName' => $category->fullName,
                'fullName_ru' => $category->fullName_ru
            ];
    }

    public function includeChild_categories(Category $category)
    {
        return $this->collection($category->child_categories, new CategoryTransformer);
    }
}
