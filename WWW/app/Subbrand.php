<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subbrand extends Model
{
    public $table = 'subbrands';

    public function images()
    {
        return $this->belongsToMany('App\Image', 'subbrands_images');
    }

    public function packages()
    {
    	return $this->belongsToMany('App\Package', 'subbrands_packages');
    }
}