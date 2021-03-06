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
   		$this->reactIfNotreacted($id, 1);
         return redirect()->back();   
   	}

      public function funny($id)
      {
         $this->reactIfNotreacted($id, 2);
         return redirect()->back();   
      }

      public function cool($id)
      {
         $this->reactIfNotreacted($id, 3);
         return redirect()->back();   
      }

      public function reactIfNotreacted($review_id, $checkReaction)
      {
         $ip = request()->ip();
         $user_id = null;
         if(Auth::check())
            $user_id = Auth::id();
         $r = Reaction::where([
                           ['ip', '=', DB::raw("INET_ATON('$ip')")],
                           ['review_id', '=', $review_id]
                        ])->first();
         // dd($r);
         if($r) {
            // user previously reviewed, now update or delete from db
            if($r->reaction == $checkReaction)
               $r->delete();
            else {
               $r->reaction = $checkReaction;
               $r->save();
            }
         }
         else {
            // User did not reacted before
            $temp = Reaction::create([
               'ip'  => DB::raw("INET_ATON('$ip')"),
               'reaction'  => $checkReaction,
               'review_id' => $review_id,
               'user_id'   => $user_id
            ]);
         }
      }
}
