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
        $refer = parse_url(url()->previous())['path'];
    	return view('auth.login', compact('refer'));
    }

    public function login()
    {
    	$this->validate(request(), [
    		'email'		=> 'required',
    		'password'	=> 'required'
    	]);
        $refer = request('_refer');
    	if( Auth::attempt(['email' => request('email'), 'password' => request('password')]) ) {
    		return $refer ? redirect($refer) : redirect('/');
    	} else {
    		return redirect()->back();
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
