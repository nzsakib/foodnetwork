@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9">
		<div class="row">
			@foreach ($bookmarks as $bookmark)
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<img src="">
						</div>
						<div class="col-md-10">
							<h4><a href="/restaurant/{{ $bookmark->restaurant->place_id }}">
								{{ $bookmark->restaurant->name }}
							</a></h4>
							<p>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</p>

							<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
								{{ $bookmark->restaurant->address }}
							</p>
						</div>
					</div>
				</div>
			@endforeach	
		</div>
	</div>
@endsection
