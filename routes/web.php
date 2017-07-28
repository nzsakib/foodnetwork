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
Route::get('profile/{id}/reviews', 'ProfileController@reviews');
Route::get('profile/{id}/photos', 'ProfileController@photos');
Route::get('profile/{id}/bookmarks', 'ProfileController@bookmarks');

Route::get('profile/{id}/edit', 'ProfileController@getEditProfile');
Route::post('profile/{id}/edit', 'ProfileController@postEditProfile');
Route::post('profile', 'ProfileController@update_avatar');
Route::post('comments', 'ProfileController@comment');
Route::get('biz_photos/{id}', 'RestaurantController@photo');

Route::get('recipe', 'RecipeController@index');
Route::post('recipe', 'RecipeController@searchRecipe');
Route::get('recipe/{id}', 'RecipeController@getRecipe');

Route::get('restaurant/{$place_id}/review/create', 'ReviewsController@store');
Route::get('user_reviews/{id}/delete', 'ReviewsController@delete')->middleware('user');
Route::get('user_reviews/{id}/edit', 'ReviewsController@edit')->middleware('user');
Route::get('user_reviews/{id}/flag', 'ReviewsController@report');

Route::get('user_reviews/{id}/react/useful', 'ReactionsController@useful');
Route::get('user_reviews/{id}/react/funny', 'ReactionsController@funny');
Route::get('user_reviews/{id}/react/cool', 'ReactionsController@cool');

// (select name,count(*) as count from reactables join reactions on reaction_id = reactions.id 
// where review_id = 7 group by name);

Route::get('admin/dashboard', 'AdminController@dashboard');

Route::get('restaurant/{place_id}/bookmark', 'PlacesController@bookmark');
