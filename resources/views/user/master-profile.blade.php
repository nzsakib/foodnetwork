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
			 			<p>Unknown Location</p>
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
			 		
			 	</div>
			 	<!-- col-md-10 -->
			 	<div class="col-md-3">
			 		
			 	</div>
			 </div>
			 <!-- row -->
	</div>
	<!-- container -->
		</div> 
		<!-- user-header -->


<div class="container">
	<div class="row">
		<div class="col-md-3 sidebar">
			<ul class="settings">
				<li>
					<a href="/profile/{{ $user->id }}">
					<i class="fa fa-user" aria-hidden="true"></i>
						Profile Overview
					</a>
				</li>
				<li>
					<a href="/profile/{{ $user->id }}/friends">
						<span class="icon-left">
							<i class="fa fa-users" aria-hidden="true"></i>
						</span>
						Friends
					</a>
				</li>
				<li>
					<a href="/profile/{{ $user->id }}/reviews">
					<span class="icon-left">
						<i class="fa fa-star" aria-hidden="true"></i>
					</span>
						Reviews
					</a>
				</li>
				<li>
					<a href="/profile/{{ $user->id }}/photos">
						<span class="icon-left">
							<i class="fa fa-camera" aria-hidden="true"></i>
						</span>
						Business Photos
					</a>
				</li>
				<li>
					<a href="/profile/{{ $user->id }}/bookmarks">
						<span class="icon-left">
							<i class="fa fa-bookmark" aria-hidden="true"></i>
						</span>
						Bookmarks
					</a>
				</li>
				<li>
					<a href="/profile/{{ $user->id }}/recipe">
						<span class="icon-left">
							<i class="fa fa-spoon" aria-hidden="true"></i>
						</span>
						Recipe
					</a>
				</li>
			</ul>
		</div> <!-- end col-md-3 and sidebar -->

		@yield('onFeed')
		
	</div> <!-- end row -->
</div> <!-- end container -->



@stop
