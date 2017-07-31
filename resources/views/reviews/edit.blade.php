
@extends('master')

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-md-7">
			<h3>Update Your Review</h3>
			<hr>
			@include('partials.notice')
			<div class="row">
				<div class="col-md-1">
					<img src="" alt="" class="img-responsive">
				</div>
				<div class="col-md-11">
					<h3><a href="/restaurant/{{ $review->restaurant->place_id }}">{{ $review->restaurant->name }}</a></h3>
					<p>
						@if($review->restaurant->address)
							{{ $review->restaurant->address }}
						@else
							Unknown Location <a href="" class="btn btn-xs btn-default">Update</a>
						@endif
					</p>
				</div>
			</div> <!-- end row -->

			<div class="row">
				<h4>Your review</h4>
				<div class="edit-review-box">
					@include('partials.errors')
					<form method="POST" action="{{ route('update_review', ['id' =>$review->id]) }}">
						{{ csrf_field() }}
						<div class="edit-rating">
							<fieldset class="rating">
								@for ($i = 1; $i <= $review->rating; $i++)
									<input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" checked />
									<label class ="full" for="star{{ $i }}" title="User rating"></label>
								@endfor
								@for ($i = (int)$review->rating+1; $i <= 5; $i++)
								    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" />
								    <label class ="full" for="star{{ $i }}" title=""></label>
								@endfor
							    
							</fieldset>
						</div>
						<div class="edit-text">
							<textarea class="form-control" name="body">{{ trim($review->body) }}</textarea>
						</div>
						<button class="btn btn-dash comment-btn" type="submit">Update Review</button>
					</form>
				</div> <!-- end edit-review-box -->
			</div> <!-- end row -->
		</div> <!-- end col-md-7 -->
		<div class="col-md-5 sidebar-review">
			<h4>Reviews for {{ $review->restaurant->name }}</h4>

			@foreach ($moreReviews as $more)
				<div class="single">
					<div class="row">
						<div class="col-md-2 image">
							<img src="{{ url('/uploads/avatars/' . $more->user->avatar) }}" alt="" class="img-responsive">
						</div>
						<div class="col-md-10">
							<a href="/profile/{{ $more->user->id }}"><h5>{{ $more->user->name }}</h5></a>
							<p class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> 
								@if($more->user->location) 
									{{ $more->user->location }}
								@else 
									Unknown 
								@endif 
							</p>
						</div>
					</div>
					<div class="timestamp rating-block">
						@for ($i = 1; $i <= $more->rating; $i++)
							<i class="fa fa-star"></i>
						@endfor
						@for ($i = 1; $i <= 5 - (int)$more->rating; $i++)
							<i class="fa fa-star-o"></i>
						@endfor
						<p>{{ $more->created_at->diffForHUmans() }}</p>
					</div>
					<p>
						{{ $more->body }}
					</p>
				</div>
			@endforeach
		</div> <!-- end col-md-5 -->
	</div> <!-- end row -->
	


	</div> <!-- end container -->

@endsection
