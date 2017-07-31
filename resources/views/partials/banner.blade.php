<section class="search" data-image-src="{{ asset('images/front.jpg') }}">
   
    <h1 class="animated fadeInDown">Search For Nearest Restaurants </h1>
    <h5 class="animated fadeInLeft">Find restaurants, and get Reviews</h5>
  
    <form class="form" method="POST" action="{{ url('restaurants') }}">
        {{ csrf_field() }}
        <div class="row">
        <div class="form-group col-xs-4 col-sm-9 col-md-9">
            <label class="sr-only" for="mapSearch">My current location....</label>
            <div class="form-group">
                <input name="place" type="text" class="form-control " id="mapSearch" placeholder="My Location...."> 
            </div>
        </div>
{{--                     <button onclick="location.href='{{ url('restaurant') }}'" type="button" class="btn theme-btn btn-lg">Search food</button> --}}
        <button type="submit" class="btn btn-primary col-xs-2 col-sm-2 col-md-3">Get results</button>
        </div>
    </form>
    
  
</section>
