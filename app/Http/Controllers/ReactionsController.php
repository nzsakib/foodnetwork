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
         $r = Reaction::where([
                           [DB::raw('ip = INET_ATON("$ip")')],
                           ['review_id', '=', $review_id]
                        ])->first();
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
            Reaction::create([
               'ip'  => DB::raw('ip = INET_ATON("$ip")'),
               'reaction'  => $checkReaction,
               'review_id' => $review_id
            ]);
         }
      }
}
