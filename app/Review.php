<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'body', 'rating', 'place_id'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
