<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function reviews()
    {
    	return $this->hasMany('App\Review');
    }
}
