<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Restaurant;
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
    	$review = Review::with('restaurant')->find($id);
    	if($review->user_id != Auth::id() )
    		return redirect('restaurant/' . $review->place_id);
    	
    	$moreReviews = Review::with('user')->where([
    			['id', '!=', $review->id],
    			['restaurant_id', '=', $review->restaurant_id] ])
				->latest()->take(5)->get();
    	// dd($moreReviews);
    	return view('reviews.edit', compact('review', 'moreReviews'));
    }

    public function update()
    {
    		
    }

    public function test(Review $review, Restaurant $restaurant, $place_id, $review_id)
    {
		dd($review);    	
    }
}
