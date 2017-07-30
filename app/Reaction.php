<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['name'];

    public function reviews()
    {
    	return $this->belongsTo('App\Review');
    }
}
