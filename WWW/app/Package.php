<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table = "packages";

    public function subbrands()
    {
    	return $this->belongsToMany('App\Subbrand', 'subbrands_packages');
    }

    public function users()
    {
    	return$this->belongsToMany('App\User', 'bought_packages');
    }

    public function boughtPackages()
    {
        return$this->hasMany('App\BoughtPackage', 'package_id');
    }
}
