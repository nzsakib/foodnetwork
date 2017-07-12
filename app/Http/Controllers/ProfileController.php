<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\User;
use Auth;
use Image;

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
    	Review::create(request(['user_id', 'body', 'rating', 'place_id']));

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
