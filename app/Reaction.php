<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['name'];

    public function review()
    {
    	return $this->belongsToMany('App\Review', 'reactables')
    				->withPivot('user_id')
    				->withTimestamps();
    }
}
