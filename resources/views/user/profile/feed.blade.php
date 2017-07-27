@extends('master')

@section('content')
		<div class="user-header">
	<div class="container">
			 <div class="row">
			 	<div class="col-md-9">
			 		<img src="{{ asset('uploads/avatars/' . $user->avatar)  }}" class="profile-pic">
			 		<h1>{{ $user->name }}</h1>
			 	
			 		@if($user->location)
			 			<h4>{{ $user->location }}</h4>
			 		@else 
			 			<h4>Unknown Location</h4>
			 		@endif
			 		<div class="summary">
			 			58 Friends  12 Reviews   8 Photos
			 		</div>
			 		<div class="bio">
			 		@if($user->bio)
			 			{{ $user->bio }}
			 		@else 
			 		 	User bio not provided
			 		 @endif
			 		</div>
			 		{{-- <h2>{{ $user->name }}'s Profile</h2>
			 		<form enctype="multipart/form-data" action="{{ url('profile') }}" method="POST">
			 			<div class="form-group">
			 				<label>Update Profile Image</label>
			 				<input type="file" name="avatar">
			 			</div>
			 				{{ csrf_field() }}
			 			<button class="btn btn-primary" type="submit">Submit</button>
			 		</form> --}}
			 	</div>
			 	<!-- col-md-10 -->
			 	<div class="col-md-3">
			 		<ul>
			 			<li>Add Friend</li>
			 			<li>Send Message</li>
			 			<li>Follow Nazmus Sakib</li>
			 		</ul>
			 	</div>
			 </div>
			 <!-- row -->
	</div>
	<!-- container -->
		</div> 
		<!-- user-header -->
	<div class="container">
		<div class="row">
			<ul class="tabs clearfix">
				<li><a href="#">Profile Overview</a></li>
				<li><a href="#">Friends</a></li>
				<li><a href="#">Reviews</a></li>
				<li><a href="#">Business Photos</a></li>
				<li><a href="#">Bookmarks</a></li>
			</ul>
		</div> <!-- row -->
	</div>

	<div class="container">
		<div class="row user-self-reviews">
			<div class="col-md-9">
				<div class="usr-self-single-review">
					<div class="restaurant row">
						<div class="col-md-1">	
							<img src="http://placehold.it/50x50">
						</div>
						<div class="col-md-11 desc">	
							<h5><a href="#">Thai St Cafe</a></h5>
							<div class="cat">
								<a href="#">Thai</a>
							</div>
							<div class="address">
								3137 Industrial Rd
								Las Vegas, NV 89109 
							</div>
						</div>
					</div>
					<div class="row">
						<span class="usr-rating col-md-3">Star star star star</span>
						<div class="date col-md-9">
							12/7/2017
						</div>
					</div>
					<div class="comment">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<h4>About Nazmus Sakib</h4>
				<h5>Rating Distribution</h5>
				<label>5 Stars</label>: 0 <br>
				<label>4 Stars</label>: 0 <br>
				<label>3 Stars</label>: 0 <br>
				<label>2 Stars</label>: 0 <br>

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
				<p>March 2017</p>

				<h5>Things I Love</h5>
				<p>cheap & great food, wine, and sushi.</p>

				
			</div>
		</div>
	</div>


@stop
