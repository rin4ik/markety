<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use  NodeTrait;

    protected $fillable = ['name', 'name_ru', 'fullName', 'category_id', 'fullName_ru', 'parent_id', 'status'];
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function childCatalogs()
    {
        return $this->hasMany(Catalog::class, 'parent_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
