<?php namespace App;

use App\Restaurant;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class Maps 
{
	public function saveRestaurant($placeid)
	{
		$url = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$placeid}&key=" 
				. env('MAP_API_KEY');

		$client = new Client();
		$response = $client->post($url);
		$results = $response->getBody()->getContents();
		$data = json_decode($results);
		$shop = $data->result;
		// dd($shop);
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
