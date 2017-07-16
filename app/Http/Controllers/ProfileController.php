<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Review;
use App\User;
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
    	return view('account', ['user' => $user]);
    }

    public function comment()
    {
    	$this->validate(request(), [
    		'rating' => 'required', 
    		'body' => 'required',
    		'place_id' => 'required'
    	]);
        // dd(request(['user_id', 'body', 'rating', 'place_id']));
        if(request()->hasFile('review-image'))
        {
            $images = request()->file('review-image');
            $imageNames = [];
            $dir = public_path('biz/images/' . request('place_id'));
            if(!File::exists($dir)) {
                // path does not exist
                //$old = umask(0);
                $path = File::makeDirectory( $dir, 0777 );
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
    	   Review::create(request(['user_id', 'body', 'rating', 'place_id'])); 
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
}
