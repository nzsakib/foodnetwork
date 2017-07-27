<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Reaction;
use Auth;

class ReactionsController extends Controller
{
   	public function useful($id)
   	{
   		if(!Auth::check())
   			redirect()->back();
   		$reaction = Reaction::where('name', '=', 'useful')->first();
   		$user = Auth::user();
   		// $review = Review::find($id);
   		$data = [
   			'reaction_id' 	=> $reaction->id,
   			'user_id'		=> $user->id,
   			'review_id'		=> (int)$id
   		];
   		// dd($data);
   		\App\Reactable::create($data);
   		// $user->reactTo($id, $reaction);

   		return redirect()->back();
   	}
}
