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

    public function sliders()
    {
    	return $this->belongsToMany('App\Subbrand', 'slider_images');
    }
}
