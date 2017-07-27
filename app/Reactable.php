<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactable extends Model
{
    protected $fillable = [ 'reaction_id', 'user_id', 'review_id' ];
}
