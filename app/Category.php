<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'name_ru', 'fullName', 'fullName_ru', 'parent_id', 'status'];
    public $timestamps = false;

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
