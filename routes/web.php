<?php

Route::get('/', function () {
    return view('search');
});

Route::get('restaurants/{search}', 'PlacesController@show');

Route::post('restaurants', function(){
	$places = request('place');
	return redirect('restaurants/' . $places);
});

Route::get('restaurant/{id}', 'PlacesController@details');
Route::get('/auth/login', 'AuthController@show')->middleware('guest');
Route::post('/auth', 'AuthController@login');
Route::get('auth/register', 'AuthController@register')->middleware('guest');
Route::post('auth/create', 'AuthController@create');
Route::get('logout', 'AuthController@logout');
Route::get('user/{id}', 'ProfileController@profile');
Route::get('profile/{id}', 'ProfileController@profile');
Route::get('profile/{id}/edit', 'ProfileController@getEditProfile');
Route::post('profile/{id}/edit', 'ProfileController@postEditProfile');
Route::post('profile', 'ProfileController@update_avatar');
Route::post('comments', 'ProfileController@comment');
Route::get('biz_photos/{id}', 'RestaurantController@photo');

Route::get('recipe', 'RecipeController@index');
Route::post('recipe', 'RecipeController@searchRecipe');
Route::get('recipe/{id}', 'RecipeController@getRecipe');
