@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9">
	@foreach ($reviews as $review)
		
	
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

	{{ $reviews->links() }}
	</div>
@endsection
