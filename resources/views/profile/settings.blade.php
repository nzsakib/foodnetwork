@extends('master')


@section('content')
	<div class="container edit">
		@if(session()->has('notice'))
		    <div class="alert alert-dismissible bg-primary" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      {{ session()->get('notice') }}
		    </div>
		@endif
		<div class="row">
			<div class="col-md-3 sidebar">
				<div class="card">
					<div class="img-container">
						<img src="{{ url('uploads/avatars/' . $user->avatar) }}" class="img-responsive">
					</div>
					<div class="user-desc">
						<h3>{{ $user->name }}</h3>
						<p class="location">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							@if($user->location)
								{{ $user->location }}
							@else 
								Unknown Location
							@endif
						</p>
					</div>
				</div>
				<ul class="settings">
					<li>
						<a href="#">Account 
						<span class="icon-right">
							<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
						</span></a> 
					</li>
					<li>
						<a href="#">Security 
						<span class="icon-right">
							<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
						</span></a> 
					</li>
				</ul>
			</div>
			<div class="col-md-9">
				<h2>Account</h2>
				<hr>
				@include('partials/errors')

				<form action="{{ route('settings', ['id' => $user->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-md-3 control-label">Profile Photo: </label>
						<div class="col-md-9">
							<input type="file" name="avatar">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">First Name: </label>
						<div class="col-md-9">
							<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name: </label>
						<div class="col-md-9">
							<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Your Location: </label>
						<div class="col-md-9">
							
							<input type="text" name="location" class="form-control" placeholder="Your Location..e.g. City, Country" value="{{ $user->location }}">
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Current Email: </label>
						<div class="col-md-9">
							<input type="text" name="current_email" class="form-control" value="{{ $user->email }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">New Email: </label>
						<div class="col-md-9">
							<input type="text" name="email" class="form-control" placeholder="New Email">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Your Biography: </label>
						<div class="col-md-9">
							<textarea class="form-control" placeholder="Tell something about yourself" name="bio">{{ $user->bio }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">What Food you love?: </label>
						<div class="col-md-9">
							<input type="text" name="loves" class="form-control" placeholder="Pasta, Ramen etc..." value="{{ $user->loves }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">New Password: </label>
						<div class="col-md-9">
							<input type="password" name="password" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Verify Password: </label>
						<div class="col-md-9">
							<input type="password" name="password_confirmation" class="form-control">
						</div>
					</div>
					<div class="col-md-9 col-md-offset-3">
						
						<button class="btn btn-dash">Save Changes</button>
					</div>
				</form>
			</div>
		</div>		
	</div>
@endsection
