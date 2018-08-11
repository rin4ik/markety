<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['name', 'logo'];
    protected $appends = ['image'];

    public function getImageAttribute()
    {
        if ($this->logo) {
            return  '/uploads/brands/' . $this->logo;
        }
        return '/uploads/brands/default.png';
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
