<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'restaurant_id', 'place_id'];

    public function restaurant()
    {
    	return $this->belongsTo('App\Restaurant', 'restaurant_id');
    }
}
