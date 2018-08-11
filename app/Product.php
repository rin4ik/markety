<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['manufacturer_id', 'model', 'list', 'category_id'];
    protected $appends = ['characs'];
    protected $casts = [
        'list' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function getCharacsAttribute()
    {
        $count = 0;
        $options = [];
        return $this->list;
        foreach ($this->list as $id => $_array) {
            if (is_array($_array) && $limit > 0) {
                $count += count_recursive($_array, $limit - 1);
            } else {
                $count += 1;
                $options[$id] = $this->multiexplode(['_', '='], $_array);
            }
        }
        return $options;
        // dd($options);
    }

    public function scopeOfCategory($query, $categoryId)
    {
        if (!$categoryId) {
            return;
        }

        $query->where('category_id', $categoryId);
    }

    public function scopeOfBrands($query, $manufacturerId)
    {
        if (!$manufacturerId) {
            return;
        }

        $query->whereIn('manufacturer_id', $manufacturerId);
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
