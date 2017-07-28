@extends('master')


@section('content')
	<div class="container edit">
		<div class="row">
			<div class="col-md-3 sidebar">
				<div class="card">
					<div class="img-container">
						<img src="http://via.placeholder.com/100x100" class="img-responsive">
					</div>
					<div class="user-desc">
						<h3>Md. Nazmus Sakib</h3>
						<p class="location">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							Dhaka, Bangladesh
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
				<form action="" class="form-horizontal">
					<div class="form-group">
						<label class="col-md-3 control-label">First Name: </label>
						<div class="col-md-9">
							<input type="text" name="first_name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name: </label>
						<div class="col-md-9">
							<input type="text" name="last_name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Your Location: </label>
						<div class="col-md-9">
							<input type="text" name="location" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email: </label>
						<div class="col-md-9">
							<input type="text" name="email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Your Biography: </label>
						<div class="col-md-9">
							<textarea class="form-control" placeholder="Tell something about yourself" name="bio">
								
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">What Food you love?: </label>
						<div class="col-md-9">
							<input type="text" name="loves" class="form-control" placeholder="Pasta, Ramen etc...">
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
