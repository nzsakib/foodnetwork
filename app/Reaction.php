<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['ip', 'reaction', 'review_id'];

    public function reviews()
    {
    	return $this->belongsTo('App\Review');
    }
}
