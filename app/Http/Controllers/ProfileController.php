<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Photo;
use App\Review;
use App\User;
use App\Restaurant;
use App\Bookmark;
use Auth;
use Image;
use DB;
use File;
use Storage;

class ProfileController extends Controller
{
	public function __construct()
	{
		// $this->middleware('user');
	}
    public function profile($id)
    {
        
        $ratingCount = DB::table("reviews")
                ->select(DB::raw("count(rating) as total"), "rating")
                ->where("user_id", "=", $id)
                ->groupBy("rating")->get();
        
        $user = User::with([
                    'reviews.restaurant', 
                    'reviews.photo',
                    'reviews' => function($query) {
                        $query->limit(10);
                        $query->with(['reactions' => function($query) {
                                $query->select( DB::raw("count(*) as totalCount, reaction, review_id") );
                                $query->groupBy('reaction', 'review_id');
                                $query->orderBy('reaction', 'asc');
                            }]);
                    }])
                    ->findorFail($id);
        // dd($user->created_at->format("F Y"));
        //$user->reviews;
        // dd($user);
        // return view('account', ['user' => Auth::user()]);
    	return view('user.profile.feed', compact('user', 'ratingCount'));
    }

    public function comment()
    {
    	$this->validate(request(), [
    		'rating' => 'required', 
    		'body' => 'required',
    		'place_id' => 'required'
    	]);

        $r = Restaurant::where('place_id', request('place_id'))->first();
        
        if( !$r )
            $r = $this->saveRestaurant(request('place_id'));
        

        // dd(request(['user_id', 'body', 'rating', 'place_id']));
        if(request()->hasFile('review-image'))
        {
            $images = request()->file('review-image');
            $imageNames = [];
            $dir = public_path('biz/images/' . request('place_id'));
            if(!File::exists($dir)) {
                //chown -R www-data:www-data /path/to/webserver/www
                //chmod -R g+rw /path/to/webserver/www
                //$old = umask(0);
                $path = File::makeDirectory( $dir, 0775 );
                //umask($old);

            }
            foreach ($images as $image) 
            {
                $filename = 'biz-' . request('place_id') . 'user-' . Auth::id() . 't-' . time() . '-' . $image->getClientOriginalName();
                
                $image->move($dir, $filename);
                $imageNames[] = $filename;
            }
            
        }
        if(isset($imageNames)) 
        {
            $data = request(['user_id', 'body', 'rating', 'place_id']);
            //$data['photo'] = 1;
            // $data['rating'] = (int) request('rating');
            $data['restaurant_id'] = $r->id;
            // dd($data);
            $review = Review::create($data);

            foreach ($imageNames as $image) 
            {
                // save to db 
                
                $photo = new Photo();
                $photo->place_id = request('place_id');
                $photo->filename = $image;
                $photo->restaurant_id = $r->id;
                $photo->user_id = Auth::id();
                $photo->review_id = $review->id;
                $photo->save();
            }   
        }
        else {
            $data = request(['user_id', 'body', 'rating', 'place_id']);
            // $data['photo'] = 0;
            $data['restaurant_id'] = $r->id;
            Review::create($data);
        }
        // dd(request(['user_id', 'body', 'rating', 'place_id']));

    	return redirect()->back();
    }

    public function update_avatar()
    {
        // dd($request->all());
        if(request()->hasFile('avatar')) {
            $avatar = request()->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // dd(public_path());
            Image::make($avatar)->resize(300,300)->save( public_path('uploads/avatars/' . $filename) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            return redirect()->back();
        }
    }

    public function getProfileSettings($id)
    {
        if(Auth::id() != (int)$id) {
            return redirect()->back();
        }
        $user = User::findorFail($id);

        return view('profile.settings', compact('user'));
    }

    public function postProfileSettings($id)
    {
        $this->validate(request(), [
            'first_name'    => 'required|min:3',
            'last_name'     => 'required|min:3',
            'location'      => 'required|min:3',
            'email'         => 'nullable|email|unique:users',
            'password'      => 'confirmed'
        ]);
        $user = Auth::user();
        // dd(request());
        if(request()->hasFile('avatar')) {
            $avatar = request()->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // dd(public_path());
            Image::make($avatar)->resize(300,300)->save( public_path('uploads/avatars/' . $filename) );

            // $data['avatar'] = $filename;
            $user->avatar = $filename;
        }
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->location = request('location');
        if(request('email'))
            $user->email = request('email');
        $user->bio = request('bio');
        $user->loves = request('loves');
        if(request('password'))
            $user->password = bcrypt(request('password'));
        $user->save();

        return redirect()->back()->with('notice', 'Your Profile is updated successfully');

    }

    public function reviews($id)
    {
        $user = User::findorFail($id);
        $reviews = $user->reviews()
                    ->with(['reactions' => function($query) {
                        $query->select( DB::raw("count(*) as totalCount, reaction, review_id") );
                        $query->groupBy('reaction', 'review_id');
                        $query->orderBy('reaction', 'asc');
                    }])
                    ->paginate(10);

        return view('user.profile.reviews', compact('user', 'reviews'));
    }

    public function photos($id)
    {
        $user = User::findorFail($id);

        $photos = Photo::where('user_id', '=', $id)->paginate(20);
        // dd($photos);
        return view('user.profile.photos', compact('user', 'photos'));
    }

    public function photoDelete($id)
    {
        $photo = Photo::findOrFail($id);
        if($photo->user_id != Auth::id())
            return redirect()->back()->with('Sorry You are not authorized.');
        $photo->delete();

        return redirect()->back()->with('notice', 'Photo is deleted successfulyy');
    }

    public function bookmarks($id)
    {
        $user = User::findorFail($id);

        $bookmarks = Bookmark::with('restaurant')->where('user_id', '=', $id)->paginate(20);
        // dd($bookmarks);
        return view('user.profile.bookmark', compact('user', 'bookmarks'));
    }

    public function bookmarkDelete($id)
    {
        $bookmark = Bookmark::findOrFail($id);
        if($bookmark->user_id != Auth::id())
            return redirect()->back()->with('notice', 'Sorry You are not authorized.');
        $bookmark->delete();

        return redirect()->back()->with('notice', 'Bookmark is deleted successfulyy');
    }

 
    // later replace this function
    public function saveRestaurant($placeid)
    {
        $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$placeid}&key=AIzaSyDfFt092pXHiO8JMivyLvj1DF7Y04Mndmo";

        $client = new Client();
        $response = $client->post($url);
        $results = $response->getBody()->getContents();
        $data = json_decode($results);
        $shop = $data->result;

        $res = new Restaurant;
        $res->name = $shop->name;
        $res->place_id = $shop->place_id;
        if(isset($shop->formatted_phone_number)) $res->phone = $shop->formatted_phone_number;
        if(isset($shop->formatted_address)) $res->address = $shop->formatted_address; 
        $res->claimed = 0;
        if(isset($shop->website)) $res->website = $shop->website;

        $loc[] = $shop->geometry->location->lat;  
        $loc[] = $shop->geometry->location->lng;
        $location = implode('|', $loc);

        $res->location = $location;
        $res->save(); 
        return $res;
    }
}
