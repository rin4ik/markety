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
}
