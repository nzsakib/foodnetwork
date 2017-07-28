@extends('master')

@section('content')

<section class="shop-profile">
    {{-- <div class="profile"> --}}
        <div class="container">
                
            @if(session()->has('notice'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{ session()->get('notice') }}
                </div>
            @endif

            <div class="row">
                <div class="col-xs-12 col-sm-12  col-md-6 col-lg-6">
                    <h2>{{ $shop->name }}</h2>
                    @if ( isset($shop->opening_hours) && $shop->opening_hours->open_now )
                        <a class="btn btn-sm btn-green">Open</a>
                    @else 
                        <a class="btn btn-sm btn-red">Closed</a>
                    @endif 
                    <div class="claim">
                        <a href="#">Unclaimed</a>
                    </div>
                    @if ( isset($shop->rating) )
                        @for ($i=0; $i < (int)$shop->rating; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    @endif
                    <div class="category">
                        Implement category
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 profile-desc">
                   <a href="#" class="btn btn-primary"><i class="fa fa-star"></i> Write a Review</a>

                   <div class="btn-group" role="group" aria-label="...">
                     <a type="button" href="/upload" class="btn btn-default"><i class="fa fa-camera" aria-hidden="true"></i> Add Photo</a>
                     <a type="button" href="/share" class="btn btn-default"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                     <a type="button" href="/restaurant/{{ $shop->place_id }}/bookmark" class="btn btn-default"> <i class="fa fa-bookmark" aria-hidden="true"></i>Bookmark</a>
                   </div>

                </div> <!-- end column --> 
            </div> <!-- end row -->

            <!-- gallary and info section -->
            <div class="row">
                <div class="col-md-3 card">
                    <div id="topmap"></div>
                </div>
                <div class="col-md-9 img-gallary">
                    <img src="http://via.placeholder.com/250x250" alt="">
                    <img src="http://via.placeholder.com/250x250" alt="">
                    <img src="http://via.placeholder.com/250x250" alt="">
                </div>
            </div>
        </div> <!-- end container -->
    {{-- </div> end profile --}}
</section>
<!-- end:Inner page hero -->
<section class="container">

    <div class="row reviews">
        
        <div class="col-md-9 review-box">
        <div class="new-comment">
        @if ( isset($user) )
            
            <form enctype="multipart/form-data" action="{{ url('comments') }}" method="POST">
            @include('partials/errors')
                <div class="form-group">
                <label class="pull-left">Your Rating:</label>

<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" />
    <label class ="full" for="star5" title="Awesome - 5 stars"></label>
    
    <input type="radio" id="star4" name="rating" value="4" />
    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    
    <input type="radio" id="star3" name="rating" value="3" />
    <label class = "full" for="star3" title="Meh - 3 stars"></label>
    
    <input type="radio" id="star2" name="rating" value="2" />
    <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    
    <input type="radio" id="star1" name="rating" value="1" />
    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    
</fieldset>
                </div>
                {{ csrf_field() }}
    <input type="hidden" name="place_id" value="{{ $shop->place_id }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="form-group ">
        <textarea name="body" id="comment" cols="8" rows="2" placeholder="Type your comment here" class="form-control comment-box"></textarea>
        <a href="#" class="image-icon"><i class="fa fa-camera" aria-hidden="true"></i></a>
        <input type="file" name="review-image[]" multiple accept="image/*" />
    </div>
    
    <button class="btn btn-primary comment-btn" type="submit">Submit</button>
            </form>
            <img id="image" />
            <div id="image-holder"></div>
        @else 

        <p>Please  <a href="/auth/register">Register</a> or <a href="/auth/login?r={{ parse_url(url()->current())['path'] }}">Login</a> to post a comment</p>


        @endif
            <div class="clearfix"></div>
        </div> <!-- end new comment -->
        @if( $dbReviews )
            @foreach ($dbReviews as $review)
                
                <div class="row single-comment">
                    
                    <div class="comment-edit dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                        @if($review->user->id == Auth::id())
                            <li><a href="/user_reviews/{{ $review->id }}/edit">
                                <i class="fa fa-pencil" aria-hidden="true"></i> 
                                Edit
                            </a></li>
                            <li><a href="/user_reviews/{{ $review->id }}/delete">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Delete
                            </a></li>
                        @endif
                        
                            <li><a href="/user_reviews/{{ $review->id }}/flag">
                                <i class="fa fa-flag" aria-hidden="true"></i>
                                Report
                            </a></li>
                        </ul>
                    </div> <!-- dropdown end -->
                
                    <div class="pro-image col-md-2">
                        <h3><a href="/profile/{{ $review->user->id }}/">
                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                        </a></h3>
                        <img src="{{ asset('uploads/avatars/' . $review->user->avatar) }}">
                    
                    </div>
                    <div class="user-comments col-md-10">
                        <h4 class="user-rating">
                       @for ($i=0; $i < (int)$review->rating; $i++)
                           <i class="fa fa-star"></i>
                       @endfor
                       </h4>
                        <span class="timeline"> {{ $review->created_at->diffForHumans() }}</span>
                        <p>{!! nl2br($review->body) !!}</p>

                        @if(count($review->photo) > 0)
                            <div class="row comment-img">
                                @foreach ($review->photo as $p)
                                    <div class="col-md-6">
                                        
                            <a href="{{ url('biz/images/') . '/' . $review->place_id . '/'. $p->filename }}" 
                                data-lightbox="image-{{ $review->id }}">
                            <img src="{{ url('biz/images/') . '/' . $review->place_id . '/'. $p->filename }}" 
                                alt="" class="img-responsive">
                            </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- user vote area -->
                        <div class="row user-vote">
                            <p>Was this review ... ?</p>
                            <a href="/user_reviews/{{ $review->id }}/react/useful" class="btn btn-sm btn-default">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                Useful 
                            </a>
                            <a href="/user_reviews/{{ $review->id }}/react/funny" class="btn btn-sm btn-default">
                                <i class="fa fa-smile-o" aria-hidden="true"></i>
                                Funny
                            </a>
                            <a href="/user_reviews/{{ $review->id }}/react/cool" class="btn btn-sm btn-default">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                Cool
                            </a>
                        </div>
                        <!-- end user vote area -->
                    </div> <!-- end user-comments -->
                </div> <!-- end row, single comment -->
            @endforeach
        @endif

        @if( $reviews )
            @foreach ($reviews as $review)
                
                <div class="row single-comment">
                    <div class="pro-image col-md-2">
                        <img src="{{ $review->profile_photo_url }}" class="img-responsive">
                    </div>
                    <div class="user-comments col-md-10">
                        <h4>{{ $review->author_name }} 
                        <span class="user-rating">
                        @for ($i=0; $i < (int)$review->rating; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        @for ($i=0; $i < 5 - (int)$review->rating; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                        </span>
                        </h4>
                        <span class="timeline"> {{ $review->relative_time_description }}</span>
                        <p>{!! nl2br($review->text) !!}</p>
                    </div> <!-- end user-comments -->
                </div> <!-- end row, single comment -->
            @endforeach
        @endif
        
        {{-- {!! $dbReviews->links() !!} --}}
        </div> <!-- end review-box -->
                <!-- Widget area -->
                <div class="col-md-3 widget sidebar clearfix col-lg-3">
                    <div id="map"></div>
                </div> <!-- end Widget area -->
    </div> <!-- end reviews column -->
</section>

<section>
    <script>
        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
center: {lat: {{ $shop->geometry->location->lat }}, lng: {{ $shop->geometry->location->lng }} },
          zoom: 18
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
          placeId: "{{ $shop->place_id }}"
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            var marker = new google.maps.Marker({
              map: map,
              position: place.geometry.location
            });
            google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                
                place.formatted_address + '</div>');
              infowindow.open(map, this);
            });
          }
        });
      }

      
    </script>
    {{-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&callback=initMap">
    </script> --}}

</section>
@stop
