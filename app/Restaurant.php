<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function reviews()
    {
    	return $this->hasMany('App\Review');
    }

    public function bookmarks()
    {
    	return $this->hasMany('App\Bookmark');
    }
}
