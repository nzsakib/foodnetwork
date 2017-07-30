<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Review extends Model
{
    protected $fillable = ['user_id', 'body', 'rating', 'place_id', 'restaurant_id'];

    public function photo()
    {
    	return $this->hasMany('App\Photo', 'review_id');
    }
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
    	return $this->belongsTo('App\Restaurant');
    }

    public function reactions()
    {
        return $this->hasMany('App\Reaction');
    }
}
