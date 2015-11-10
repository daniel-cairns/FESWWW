<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';

    public function subbrands()
    {
        return $this->belongsToMany('App\Subbrand', 'subbrands_images');
    }

    public function packages() 
    {
        return $this->belongsToMany('App\Package','bought_packages_images');
    }
}
