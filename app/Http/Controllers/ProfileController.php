<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Photo;
use App\Review;
use App\User;
use App\Restaurant;
use Auth;
use Image;
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
        
        $user = User::findorFail($id);
        
        
        // dd($user);
        // return view('account', ['user' => Auth::user()]);
    	return view('user.profile.feed', ['user' => $user]);
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
            $data['photo'] = 1;
            $data['restaurant_id'] = $r->id;
            $review = Review::create($data);
            foreach ($imageNames as $image) 
            {
                // save to db 
                // place id, filename, review id
                $photo = new Photo();
                $photo->place_id = request('place_id');
                $photo->filename = $image;
                $photo->review_id = $review->id;
                $photo->save();
            }   
        }
        else {
            $data = request(['user_id', 'body', 'rating', 'place_id']);
            $data['photo'] = 0;
            $data['restaurant_id'] = $r->id;
            Review::create($data);
        }
        // dd(request(['user_id', 'body', 'rating', 'place_id']));

    	return redirect()->back();
    }

    public function update_avatar(Request $request)
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

    public function getEditProfile($id)
    {
        $user = User::findorFail($id);

        return view('profile.edit', compact('user'));
    }

    public function postEditProfile($id)
    {
        dd($id);
    }

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
