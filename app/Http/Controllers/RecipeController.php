<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DarrynTen\Clarifai\Clarifai;

class RecipeController extends Controller
{
    public function index()
    {
    	return view('recipe.index');
    }

    public function searchRecipe()
    {
        // dd(request());
        $this->validate(request(), [
            'ingred'    => 'required'
        ]);
        $ingred = implode( ',', request('ingred') );
        // dd($ingred);
    	// $ingred = request('ingred');
    	$client = new Client([ 
    		"headers" => [ 
    			"X-Mashape-Key" => "hpD9lWQOnJmshoD9J6UKJAL5HbaMp1ugmN4jsnDvCduTTWBEd2",
    			"Accept" => "application/json"
    		]
    	]);    

    	$url = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?fillIngredients=false&ingredients=" . $ingred . "&limitLicense=false&number=5&ranking=1";

    	
    	$response = $client->get($url);
    	$results = $response->getBody()->getContents();
    	$recipes = json_decode($results);

    	$response = $client->get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/food/jokes/random");
    	$results = $response->getBody()->getContents();
    	$joke = json_decode($results);

    	return view('recipe.index', compact('ingred', 'recipes'));
    }

    public function getRecipe($id)
    {
    	$client = new Client([ 
    		"headers" => [ 
    			"X-Mashape-Key" => "hpD9lWQOnJmshoD9J6UKJAL5HbaMp1ugmN4jsnDvCduTTWBEd2",
    			"Accept" => "application/json"
    		]
    	]);    

    	$url = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/" . $id . "/information?includeNutrition=true";

    	$response = $client->get($url);
    	$results = $response->getBody()->getContents();
    	$recipe = json_decode($results);

    	// get related recipe
    	$url = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/" . $id ."/similar";

    	$response = $client->get($url);
    	$results = $response->getBody()->getContents();
    	$similar = json_decode($results);

    	// dd($similar);
    	// dd($recipe);
        $titles = [];
        $needs = [];
        foreach ($recipe->nutrition->nutrients as $item) {
            // dd($item);
            $titles[] = $item->title;
            $needs[] = $item->percentOfDailyNeeds;
        }
        // dd(json_encode($titles));

        $steps = empty($recipe->analyzedInstructions) ? false : $recipe->analyzedInstructions[0]->steps;
    	// dd($steps);


    	return view('recipe.show', compact('recipe', 'steps', 'similar', 'titles', 'needs'));
    }

    public function image()
    {
        
        return view("recipe.clarifai");
    }
    public function postClarifai()
    {
        // return "clicked";
        // return request()->all();
        $this->validate(request(), [
            'image' => 'required|mimes:jpeg,jpg,png,tiff,bmp'
        ]);

        if(request()->hasFile('image')) {
            $image = request()->file('image');
            $filename = $image->getClientOriginalName();
            $dir = public_path('clarifai');
            $image->move($dir, $filename);
            $imageUrl = url('clarifai/' . $filename);
            $clarifai = new Clarifai(
                'MSTt5aJ9KDRihYRrPN4cpTBzynnP-wY8Ra9HBc-t',
                '4KfWK-sbHOJciFl5jwZMq0Ty8j-f0C1FVDbr6z61'
            );
            // dd($imageUrl);
            $imageData = file_get_contents($imageUrl);
            $base64 = base64_encode($imageData);
            // dd($base64);
            // return $base64;
            $modelResult = $clarifai->getModelRepository()->predictEncoded(
                $base64,
                \DarrynTen\Clarifai\Repository\ModelRepository::FOOD
            );

            $result = (object)$modelResult;

            return $result->outputs[0]['data']['concepts'];

        }
    }
}
