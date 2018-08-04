<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = ['name', 'name_ru', 'type', 'list', 'position', 'category_id', 'slug', 'status', 'use'];
    protected $casts = [
        'list' => 'array',
    ];
    protected $appends = ['options'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getOptionsAttribute()
    {
        $count = 0;
        $options = [];
        foreach ($this->list as $id => $_array) {
            if (is_array($_array) && $limit > 0) {
                $count += count_recursive($_array, $limit - 1);
            } else {
                $count += 1;
                $options[$id] = $this->multiexplode(['/', '='], $_array);
            }
        }
        return $options;
    }

    public function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}
