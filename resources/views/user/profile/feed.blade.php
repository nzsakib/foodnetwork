@extends('user.master-profile')

@section('onFeed')
		
	
			
			<div class="col-md-6">
			@foreach ($user->reviews as $review)
				
			
				<div class="usr-self-single-review">
					<div class="restaurant row">
						<div class="col-md-2">	
							<img src="http://placehold.it/50x50">
						</div>
						<div class="col-md-10 desc">	
							<h5><a href="/restaurant/{{ $review->restaurant->place_id }}">{{ $review->restaurant->name }}</a></h5>
							<div class="cat">
								<a href="#">Thai</a>
							</div>
							<div class="address">
								{{ $review->restaurant->address }}
							</div>
						</div>
					</div>
					<div class="row">
						<span class="usr-rating col-md-3">
							@for ($i = 1; $i <= $review->rating; $i++)
								<i class="fa fa-star" aria-hidden="true"></i>
							@endfor
							@for ($i = 1; $i <= 5-$review->rating; $i++)
								<i class="fa fa-star-o" aria-hidden="true"></i>
							@endfor
						</span>
						<div class="date col-md-9">
							{{ $review->created_at->diffForHumans() }}
						</div>
					</div>
					<div class="comment">
						<p>
							{{ $review->body }}
						</p> 
					</div>
				</div>
			@endforeach
			</div>
			<div class="col-md-3">
				<h4>About Nazmus Sakib</h4>
				<h5>Rating Distribution</h5>
				@foreach ($ratingCount as $rating)
					<label>{{ $rating->rating  }} Stars</label>: {{ $rating->total  }} <br>
					
				@endforeach
			
				<h5>Review Votes</h5>
				<ul>
					<li>Useful: 28</li>
					<li>Funny: 2</li>
					<li>Cool: 22</li>
				</ul>

				<h5>Stats</h5>
				<ul>
					<li>Tips: 2</li>
					<li>Bookmarks: 433</li>
					<li>Reviews: 2</li>
				</ul>

				<h5>Location</h5>
				<p>San Francisco, CA</p>

				<h5>Member Since</h5>
				<p>{{ $user->created_at->format("F Y") }}</p>

				<h5>Things I Love</h5>
				<p>cheap & great food, wine, and sushi.</p>

				
			</div>
		


@stop
