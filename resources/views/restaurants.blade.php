@extends('master')

@section('content')
<!-- start: Inner page hero -->
<div class="search-page-cover" data-image-src="{{ asset('images/search.jpg') }}">
    {{-- <img src="{{ asset('images/search.jpg') }}" class="img-responsive">   --}}
</div>
    <div class="result-show container">
       <h3>You Searched for: {{ $search }}</h3>
    </div>
            <!-- //results show -->
  <section class="restaurants-page">
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                  <div class="sidebar clearfix m-b-20">
                  
                      <div id="map"></div>
  
                  </div> <!-- end sidebar -->
              </div> <!-- end columns -->

<div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
  @foreach ($restaurants as $shop)
	
	<div class="restaurant-entry">
		<div class="row">
	   		 <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
	       		 <div class="row">
               <div class="col-md-3">
  	            	<a href="{{ url('/restaurant/' . $shop->place_id) }}"><img src="http://placehold.it/110x110" class="img-thumbnail" alt="Food logo"></a>
  	        	</div>
  	         
  	        <div class="shop-details col-md-8">
  	            <h3><a href="{{ url('/restaurant/' . $shop->place_id) }}">{{ $shop->name }}</a></h3> <span>{{ $shop->vicinity }}</span>
  	            
  	        </div> <!-- end col-md-8 -->
          </div> <!-- end row -->
	    </div> <!-- end col-lg-8 -->

	    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
	        <div class="right-content bg-white">
	            <div class="right-review">
	                <div class="rating-block"> 
	                {{-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> --}} 
					@if ( isset($shop->rating) )
						@for ($i=0; $i < (int) $shop->rating; $i++)
							<i class="fa fa-star"></i>
						@endfor
            @for ($i=0; $i < 5 - (int) $shop->rating; $i++)
              <i class="fa fa-star-o"></i>
            @endfor
          @else 
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
					@endif
	           </div> <!-- end rating-block -->
    <a href="{{ url('/restaurant/' . $shop->place_id) }}" class="btn btn-dash">View Profile</a> 
                  </div> <!-- end right-review -->
	        </div>
	        <!-- end:right info -->
	    </div>
	</div>
	<!--end:row -->
		</div>
	<!-- end:Restaurant entry -->

@endforeach
         </div> <!-- end columns -->
      </div> <!-- end row -->
  </div> <!-- end container -->
            </section>
    <section>
        <script type="text/javascript">
    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
center: {lat: {{ $location->lat }}, lng: {{ $location->lng }} },
      zoom: 18
    });

    var infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);

    service.getDetails({
      placeId: "{{ $place_id }}"
    }, function(place, status) {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
            'Place ID: ' + place.place_id + '<br>' +
            place.formatted_address + '</div>');
          infowindow.open(map, this);
        });
      }
    });
  }
        </script>
    </section>
@stop
