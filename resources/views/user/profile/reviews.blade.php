@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9 user-profile">
	@foreach ($reviews as $review)
		
	<div class="single-review">
		<div class="restaurant row">
		<div class="comment-edit dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		        <i class="fa fa-angle-down" aria-hidden="true"></i>
		    </a>
		    <ul class="dropdown-menu dropdown-menu-right">
		    @if($review->user->id == Auth::id())
		        <li><a href="/user_reviews/{{ $review->id }}/edit">
		            <i class="fa fa-pencil" aria-hidden="true"></i> 
		            Edit
		        </a></li>
		        <li><a href="/user_reviews/{{ $review->id }}/delete">
		            <i class="fa fa-trash-o" aria-hidden="true"></i>
		            Delete
		        </a></li>
		    @endif
		    
		        <li><a href="/user_reviews/{{ $review->id }}/flag">
		            <i class="fa fa-flag" aria-hidden="true"></i>
		            Report
		        </a></li>
		    </ul>
		</div> <!-- dropdown end -->

			<div class="col-md-3 restaurant-img">	
				<img src="{{ asset('/images/restaurant-icon.png') }}" class="img-thumbnail">

				<span class="time">
					<p>{{ $review->created_at->diffForHumans() }}</p>
				</span>
			</div>
			<div class="col-md-9 desc">	
				<h4><a href="/restaurant/{{ $review->restaurant->place_id }}">{{ $review->restaurant->name }}</a></h4>
				
				<div class="address">
					{{ $review->restaurant->address }}
				</div>
				<div class="profile-rating">
					@for ($i = 1; $i <= $review->rating; $i++)
						<i class="fa fa-star" aria-hidden="true"></i>
					@endfor
					@for ($i = 1; $i <= 5-$review->rating; $i++)
						<i class="fa fa-star-o" aria-hidden="true"></i>
					@endfor
				</div>
			</div>

		</div>
		
		<div class=" row comment">
			<p>
				{{ $review->body }}
			</p> 
		</div>
		
		<!-- user vote area -->
		<div class="row user-vote">
		    <p>Was this review ... ?</p>
		    
		    <?php 
		        $react = $review->reactions->toArray(); 
		        $r = array_pluck($react, 'totalCount', 'reaction');
		    ?>
		    <a href="/user_reviews/{{ $review->id }}/react/useful" class="btn btn-sm ">
		        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
		        Useful @if(array_has($r, 1))
		            <span class="badge">{{ $r[1] }}</span>
		                @endif
		    </a>
		    <a href="/user_reviews/{{ $review->id }}/react/funny" class="btn btn-sm ">
		        <i class="fa fa-smile-o" aria-hidden="true"></i>
		        Funny @if(array_has($r, 2))
		            <span class="badge">{{ $r[2] }}</span>
		                @endif
		    </a>
		    <a href="/user_reviews/{{ $review->id }}/react/cool" class="btn btn-sm ">
		        <i class="fa fa-heart-o" aria-hidden="true"></i>
		        Cool @if(array_has($r, 3))
		            <span class="badge">{{ $r[3] }}</span>
		                @endif
		    </a>
		</div>
		<!-- end user vote area -->
	</div>
	@endforeach

	{{ $reviews->links() }}
	</div>
@endsection
