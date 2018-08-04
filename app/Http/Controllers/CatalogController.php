<?php

namespace App\Http\Controllers;

use App\Catalog;

class CatalogController extends Controller
{
    public function show(Catalog $catalog)
    {
        $catalog->loadMissing('descendants', 'category.products.manufacturer')->paginate(50);

        if (count($catalog->children) > 0) {
            return view('pages.catalogs.index', compact('catalog'));
        }
        $filters = [];
        foreach ($catalog->category->filters as $filter) {
            $count = 0;
            $options = [];
            foreach ($filter->list as $id => $_array) {
                if (is_array($_array) && $limit > 0) {
                    $count += count_recursive($_array, $limit - 1);
                } else {
                    $count += 1;
                    $options[$id] = $this->multiexplode(['/', '='], $_array);
                    // $options[$id] = explode('/', );
                }
            }
            $filters[] = [
                'name' => $filter->name,
                'name_ru' => $filter->name_ru,
                'options' => $options,
                'type' => $filter->type,
                'status' => $filter->status,
                'use' => $filter->use,
                'position' => $filter->position,
            ];
        };
        $filters = collect($filters);
        return view('pages.catalogs.show', compact('catalog', 'filters'));
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
