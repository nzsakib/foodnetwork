<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;

class ReviewsController extends Controller
{
    public function delete($id)
    {
    	$review = Review::find($id);
    	
    	if($review->user_id != Auth::id() )
    		return redirect('restaurant/' . $review->place_id);

    	$review->delete();

    	return redirect()->back()->with('notice', 'Your Review Deleted Successfully!!');;
    }

    public function edit($id)
    {
    	$review = Review::find($id);
    	if($review->user_id != Auth::id() )
    		return redirect('restaurant/' . $review->place_id);
    	dd($review);
    	return view('reviews.edit', compact('review'));
    }

    public function update()
    {
    		
    }
}
