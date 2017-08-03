@extends('user.master-profile')

@section('onFeed')
		
	
			
			<div class="col-md-6 user-profile">
			@foreach ($user->reviews as $review)
				
			
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
			</div>
			<div class="col-md-3 profile-sidebar">
				<h4>About Nazmus Sakib</h4>
				<h5>Rating Distribution</h5>
			

				<canvas id="graph" width="100" height="100"></canvas>
				<h5>Review Votes</h5>
				<ul>
					<li>Useful: <strong>{{ $reactionArray[0] }}</strong></li>
					<li>Funny: <strong>{{ $reactionArray[1] }}</strong></li>
					<li>Cool: <strong>{{ $reactionArray[2] }}</strong></li>
				</ul>

				<h5>Stats</h5>
				<ul>
					<li>Bookmarks: <strong>{{ $bookmarkCount }}</strong></li>
					<li>Reviews: <strong>{{ $reviewCount }}</strong></li>
				</ul>

				<h5>Location</h5>
				<p>{{ $user->location }}</p>

				<h5>Member Since</h5>
				<p>{{ $user->created_at->format("F Y") }}</p>

				<h5>Things I Love</h5>
				<p>
					@if($user->loves)
						{{ $user->loves }}
					@else 
						Yet to discover the world of food !!
					@endif
				</p>

				
			</div>
		


@stop

@section('js')
	<script>
	var bgColors = ['rgba(26, 223, 223, 0.5)',
					'rgba(26, 223, 223, 0.5)',
					'rgba(26, 223, 223, 0.5)',
					'rgba(26, 223, 223, 0.5)',
					'rgba(26, 223, 223, 0.5)'
				];
	var lineColors = ['rgba(26, 223, 223, 1)',
					'rgba(26, 223, 223, 1)',
					'rgba(26, 223, 223, 1)',
					'rgba(26, 223, 223, 1)',
					'rgba(26, 223, 223, 1)'
				];
	var data = {
		labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
		datasets: [
			{
				label: "Rating Count",
				backgroundColor: bgColors,
			    borderColor: lineColors,
			    borderWidth: 1,
				data: {!! json_encode($finalArray) !!}
			}
		]
	};
		var ctx = document.querySelector("#graph").getContext('2d');
		new Chart(ctx, {
		  type: 'horizontalBar',
		  data: data
		});
	</script>
@endsection
