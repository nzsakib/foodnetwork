<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Reaction;
use Auth;
use DB;

class ReactionsController extends Controller
{
   	public function useful($id)
   	{
   		
         $r = Reaction::where(DB::raw('ip = INET_ATON("$ip")'));
         // if null , ip not voted
         //    vote with ip 
   		$user = Auth::user();
         $reacted = new Reaction;
         $reacted->reaction = 1;
         if(Auth::check())
            $reacted->user_id = Auth::id();
         
   		// $review = Review::find($id);
   		$data = [
   			'reaction_id' 	=> $reaction->id,
   			'user_id'		=> $user->id,
   			'review_id'		=> (int)$id
   		];
   		//reaction, user_id / ip , review_id
   		return redirect()->back();
   	}
}
