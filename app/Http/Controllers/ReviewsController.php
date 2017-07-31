<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Restaurant;
use App\Report;
use Carbon\Carbon;
use Auth;
use DB;

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

    public function report($id)
    {
        $review = Review::find($id);
        if(Auth::check()) {
            $userId = Auth::id();
            $ip = request()->ip();

            $report = Report::where([
                ['user_id', '=', $userId],
                ['review_id', '=', $id]])->first();

                // dd($report);
            if(count($report) == 0) {
                DB::table('reports')->insert(
                    [
                        'user_id'   => $userId,
                        'ip'        => DB::raw("INET_ATON('$ip')"),
                        'review_id' => (int)$id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
                // Report::create([
                //     'user_id'   => $userId,
                //     'ip'        => $ip,
                //     'review_id' => (int)$id
                // ]);
                return redirect()->back()->with('notice', 'Thanks for reporting. We will soon take necessary action. Thanks');
            }
            else {
                return redirect()->back()->with('notice', 'You already reported this before. We will soon take necessary action. Thanks. ');
            }
        }
        else {
            // user is not logged in , Get the ip
            $ip = request()->ip();
            $report = Report::where([
                ['ip', '=', DB::raw("INET_ATON('$ip')")],
                ['review_id', '=', $id]])->first();
// dd(!$report);
            if(!$report) {
                Report::create([
                    'ip'   => DB::raw("INET_ATON('$ip')"),
                    'review_id' => (int)$id
                ]);
                return redirect()->back()->with('notice', 'Thanks for reporting. We will soon take necessary action. Thanks');
            }
            else {
                return redirect()->back()->with('notice', 'You previously reported this before. We will soon take necessary action. Thanks. ');
            }
        }
        return redirect()->back()->with('notice', 'Successfully Reported.');
    }

    public function update($id)
    {
        $this->validate(request(), [
            'rating'    => 'required',
            'body'      => 'required'
        ]);
        // dd(request()->all());
        $review = Review::where('id', $id)->update(request(['rating', 'body']));

        return redirect()->back()->with('notice', 'Review Successfully updated');
    }
}
