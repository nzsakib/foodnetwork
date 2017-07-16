@extends('master')

@section('content')
<div class="register">
<div class="row">
	<div class="col-md-12">
		@include('partials/errors')
		<div class="center">
			<h3>Sign Up</h3>
			<p><strong>Connect with great local businesses</strong></p>
		</div>
		<form action="{{ url('auth/create') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control" value="{{ old('email') }}">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Confirm Password</label>
				<input type="password" name="password_confirmation" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Register</button>
		</form>
	</div>
</div>
</div>
@stop
