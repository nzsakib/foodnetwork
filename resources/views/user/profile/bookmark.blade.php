@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9 bookmark">
		@include('partials.notice')
		<div class="row">
			@foreach ($bookmarks as $bookmark)
				<div class="col-md-12 single">
					<div class="row">
						<div class="col-md-2">
							<img src="{{ asset('/images/restaurant-icon.png') }}" class="img-responsive">
						</div>
						<div class="col-md-8">
							<h4><a href="/restaurant/{{ $bookmark->restaurant->place_id }}">
								{{ $bookmark->restaurant->name }}
							</a></h4>
							

							<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
								{{ $bookmark->restaurant->address }}
							</p>

						</div>
						<div class="delete col-md-2">
							@if(Auth::check())
								<a href="{{ route('bookmarkDelete', ['id' => $bookmark->id]) }}">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							@endif
						</div>
					</div>
				</div>
			@endforeach	
		</div>
	</div>
@endsection
