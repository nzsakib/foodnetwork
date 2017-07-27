<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['place_id', 'filename', 'review_id', 'restaurant_id'];
    
    
}
