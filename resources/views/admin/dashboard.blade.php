@extends('master-admin')

@section('admin')
	
	<div class="container-fluid">
	<div class="row admin">
		<div class="col-md-3 sidebar">
			<ul>
				<li>  <a href="#">
					<span class="icon"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
					Dashboard</a>
				</li>
				<li><a href="#"> 
					<span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
					All Users</a>
				</li>
				<li><a href="#">
					<span class="icon"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
					All Reviews</a>
				</li>
				<li><a href="#">
					<span class="icon"><i class="fa fa-flag-o" aria-hidden="true"></i></span>
					Flagged Reports</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			Details
		</div>
	</div>
	</div>

@endsection
