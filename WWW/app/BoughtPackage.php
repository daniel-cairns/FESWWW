<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoughtPackage extends Model
{
    public $table = "bought_packages";

    protected $fillable = ['user_id', 'package_id', 'booking_date', 'location'];

    public function package() {
    	return $this->belongsTo('App\Package');
    }
}
