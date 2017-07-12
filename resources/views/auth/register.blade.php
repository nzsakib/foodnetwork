@extends('master')

@section('content')
<div class="row">
	<div class="register col-md-offset-4 col-md-4">
		@include('partials/errors')
		<h3>Register Users</h3>
		<form action="{{ url('auth/create') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control">
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
@stop
