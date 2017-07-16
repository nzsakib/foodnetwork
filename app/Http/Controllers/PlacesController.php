<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use App\Review;
use Auth;
use DB;

class PlacesController extends Controller
{
	/**
	 * @param  string
	 * @return views
	 */	
    public function show($search)
    {
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $search;
		$url .= "&region=bd&key=AIzaSyDfFt092pXHiO8JMivyLvj1DF7Y04Mndmo";
		$client = new Client();    
		$response = $client->post($url);	
		$results = $response->getBody()->getContents();
		$data = json_decode($results);
		// get nearest restaurants 
        // dd($data->results[0]);
        $place_id = $data->results[0]->place_id;
		$location = $data->results[0]->geometry->location;
		$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" 
				. $location->lat . "," 
				. $location->lng . 
				"&type=restaurant&rankby=distance&key=AIzaSyDfFt092pXHiO8JMivyLvj1DF7Y04Mndmo";
		
		$response = $client->post($url);
		$results = $response->getBody()->getContents();
		// dd($results);
        $data = json_decode($results);
		// dd($data->results);
		$restaurants = $data->results;
        // dd($restaurants);

		return view('restaurants', compact('restaurants', 'location', 'place_id', 'search'));
    }

    /*
    	Returns a restaurant details
     */
    public function details($id)
    {
    	$url = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$id}&key=AIzaSyDfFt092pXHiO8JMivyLvj1DF7Y04Mndmo";

    	$client = new Client();
    	$response = $client->post($url);
    	$results = $response->getBody()->getContents();
    	$data = json_decode($results);
    	$shop = $data->result;
    	// dd($shop);
    	$reviews = (isset($shop->reviews)) ? $shop->reviews : false;
        // dd($reviews);
        // Get reviews from database 
        
        //$dbReviews = Review::with('user')->where('place_id', $id)->latest()->get();
        $dbReviews = Review::with(['user', 'photo'])->where('reviews.place_id', $id)
                             ->latest()
                             ->get();
        // $dbReviews = DB::table('reviews')
        //     ->where('reviews.place_id', $id)
        //     ->leftJoin('photos', 'reviews.id', '=', 'photos.review_id')
        //     ->orderBy('reviews.id', 'ASC')
        //     ->get();


        // $db = $dbReviews->toArray();
        // dd($db);
    	// if there are photos 
    	if(isset($shop->photos)) {
    		$photos = [];
    	// loop through photos and get reference
    		foreach ($shop->photos as $photo) {
    			$call = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=240&maxheight=140&photoreference={$photo->photo_reference}&key=" . env("MAP_API_KEY");
    	// API call to maps to get redirected links
		    	$response = $client->get($call, [
				    // 'query'   => ['get' => 'params'],
				    'on_stats' => function (TransferStats $stats) use (&$url) {
				        $url = $stats->getEffectiveUri();
				    }
				]);
    	// push the link to photos array
    			$photos[] = "" . $url->getScheme() . "://" . $url->getHost() . $url->getPath();
    			break;
    		}
    	} else {
    		// No photos for the shop
    		$photos = false;
    	}
        $user = Auth::user();
    	// $shop->opening_hours->open_now = false;
    	return view('profile', compact('shop', 'reviews', 'photos', 'user', 'dbReviews'));
    }
}