@extends('master')

@section('content')
<div class="login">
<div class="row">
	<div class="col-md-12 ">
	<h3>Login To The System</h3>
		@include('partials/errors')
		@include('partials/notice')
		<form action="{{ url('auth') }}" method="POST">
			{{ csrf_field() }}
			@if($refer)
				<input type="hidden" name="_refer" value="{!! $refer !!}">
			@endif
			<div class="form-group"> 
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
</div>
</div>
@stop
