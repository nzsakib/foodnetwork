@extends('master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 single-recipe">
				<h1>{{ $recipe->title }}</h1>
				<img src="{{ $recipe->image }}" class="img-responsive main-image">
				<ul class="init clearfix">
					<li>
						<div class="icon"><i class="fa fa-usd" aria-hidden="true"></i></div> 
						<strong>$ {{ $recipe->pricePerServing / 100 }}</strong> Per Serving 
					</li>
					<li>
						<div class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i> </div>
						<strong>Ready in: {{ $recipe->readyInMinutes }}</strong> minutes
					</li>
					<li>
						<div class="like icon"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div> 0  
						<div class="dislike icon"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></div> 0
					</li>
				</ul>
<div class="row">

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet" />

<div id="mytabs">
<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#instruction" aria-controls="instruction" role="tab" data-toggle="tab">Instructions</a></li>
	    <li role="presentation"><a href="#ingredients" aria-controls="ingredients" role="tab" data-toggle="tab">Ingredients</a></li>
	    <li role="presentation"><a href="#nutrition" aria-controls="nutrition" role="tab" data-toggle="tab">Nutrition</a></li>
  </ul>
  <!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="instruction">
  	@if($steps)
		<ul>
			@foreach ($steps as $step)
					<li>
						<strong>Step: </strong>{{ $step->number }}
						<p>{{ $step->step }}</p>
					</li>
			@endforeach
		</ul>
	@else
		<h3><a href="{{ $recipe->sourceUrl }}" target="__blank">CLick here for step by step instructions</a></h3>
  	@endif
  </div>
  <div role="tabpanel" class="tab-pane" id="ingredients">
  	@foreach ($recipe->extendedIngredients as $item)
  		<div class="ingredient">
  			<div class="amount">{{ $item->amount }} {{ $item->unit }}</div>
	  		<div class="ingredient-image">
	  			@if (isset($item->image))
	  				<img src="{{ $item->image }}" alt="{{ $item->originalString }}" class="img-responsive">
	  			@else 
	  				<img src="{{ asset('images/no.jpeg') }}" alt="{{ $item->originalString }}" class="img-responsive">
	  			@endif
	  		</div>
	  		<div class="ingredient-name">
	  			{{ $item->name }}
	  		</div>
  		</div>
  	@endforeach
  </div>
  <div role="tabpanel" class="tab-pane" id="nutrition">
  	<canvas id="graph" width="100%" height="200"></canvas>
  </div>
</div> <!-- Tab panes end -->
</div>
</div> <!-- row -->
			</div> <!-- col-md-8 -->
			<div class="col-md-4 related-recipe">
				<h3>Related Recipe</h3>
				@foreach ($similar as $related)
					<div class="row">
					<a href="{{ url('recipe/' . $related->id) }}">	
						<div class="col-md-12">
							<div class="col-md-3">
								<img src="http://spoonacular.com/recipeImages/{{ $related->imageUrls[0] }}" class="img-responsive">
							</div>
							<div class="col-md-9">
								<h5>{{ $related->title }}</h5>
								<strong>Ready in: </strong> {{ $related->readyInMinutes }} minutes
							</div>
						</div>
						</a>
					</div> <!-- row -->
				@endforeach
			</div> <!-- col-md-3 -->
		</div>
		<!-- end row -->
	</div>
@endsection

@section('js')
	<script>
		var titles = {!! json_encode($titles) !!};
		var needs = {!! json_encode($needs) !!};
		
		var l = needs.length;
		var bgColors = [];
		var lineColors = [];
		for(var i = 0; i< l; i++) {
			bgColors.push('rgba(26, 223, 223, 0.5)');
		}
		for(var i = 0; i< l; i++) {
			lineColors.push('rgba(26, 223, 223, 1)');
		}
		var data = {
			labels: titles,
			datasets: [
			{
				label: "Percentage",
				backgroundColor: bgColors,
		      borderColor: lineColors,
		      borderWidth: 1,
				data: needs
			}
			]
		};
		var ctx = document.querySelector("#graph").getContext('2d');
		new Chart(ctx, {
		  type: 'horizontalBar',
		  data: data,
		  options: {
		          scales: {
		              
		              xAxes: [{
		              ticks: {
		              
		                     min: 0,
		                     max: 100,
		                     callback: function(value){return value+ "%"}
		                  },  
		  								scaleLabel: {
		                     display: true,
		                     labelString: "Percentage"
		                  }
		              }]
		          }
		      }
		});
	</script>
@endsection
