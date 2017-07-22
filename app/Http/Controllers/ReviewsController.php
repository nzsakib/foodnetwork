<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewsController extends Controller
{
    public function delete($id)
    {
    	Review::destroy($id);

    	return redirect()->back();
    }

    public function edit($id)
    {
    	
    }
}
