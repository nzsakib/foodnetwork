@extends('master')

@section('content')
	
	<div class="container">
		<h1>What's on Your Fridge ?</h1>
		<form class="form" action="{{ url('recipe') }}" method="post">
			<div class="form-group">
				<label for="ingred">Ingredients : </label>
				<input type="text" name="ingred" class="form-control"
					placeholder="Comma separated ingredients.....">
			</div>
			{{ csrf_field() }}
			<button class="btn btn-primary">Get Recipe</button>
		</form>
		@if(isset($ingred))
			<h3>Your ingredients are: <strong><em>{{ $ingred }}</em></strong></h3>
		@endif

		@if(isset($recipes) && count($recipes) > 0)
				<div class="row">
			@foreach ($recipes as $recipe)
			<div class="col-md-12 recipe-result">
				{{-- <div class="thumbnail"> --}}
				<div class="col-md-3">
					<img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="img-responsive">
				</div>
					<div class="col-md-9">
						<a href="{{ url('/recipe/' . $recipe->id) }}">
							<h3>{{ $recipe->title }}</h3>
						</a>
						<p>
							<strong>Used Ingredients: </strong> {{ $recipe->usedIngredientCount }} <br>
							<strong>Missing Ingredients: </strong> {{ $recipe->missedIngredientCount }}
						</p>
					</div>
					<!-- end col-md-9 -->
				{{-- </div> --}}
			</div>
					
			@endforeach
				</div>
		@elseif (isset($ingred))
			<div class="alert alert-info text-center" role="alert">
				<p>Sorry No Recipe Found with ingredients <strong>{{ $ingred }}</strong></p>
			</div>
		@endif
	</div>


@endsection
