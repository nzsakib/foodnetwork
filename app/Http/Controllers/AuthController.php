<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function show()
    {
        // $refer = request('r');
      // $sessionRedirect = session('redirect');
       // dd($sessionRedirect);
        // $refer = parse_url(url()->previous())['path'];
        $refer = request()->get('r');
        // dd($refer);
    	return view('auth.login', compact('refer'));
    }

    public function login()
    {
        // dd(request('_refer'));
    	$this->validate(request(), [
    		'email'		=> 'required',
    		'password'	=> 'required'
    	]);
        $refer = request('_refer');

    	if( Auth::attempt(['email' => request('email'), 'password' => request('password')]) ) {
    		return $refer ? redirect($refer) : redirect('/');
    	} else {
    		return redirect()->back()->with('danger', 'Wrong Email or Password!!');
    	}

    }

    public function register()
    {
    	return view('auth.register');
    }

    public function create()
    {
    	$this->validate(request(), [
    		'first_name'  => 'required', 
            'last_name'   => 'required', 
    		'email'		  => 'required|unique:users',
    		'password' 	=> 'required|confirmed'
    	]);

    	$first_name = request('first_name');
        $last_name = request('last_name'); 
    	$email = request('email');
    	$password = Hash::make(request('password'));
    	User::create([  'first_name'  => $first_name, 
                        'last_name' => $last_name, 
                        'email' => $email, 
                        'password' =>$password]);

    	return redirect('auth/login');
    }

    public function logout()	
    {
    	Auth::logout();
    	return redirect()->back();
    }
}
