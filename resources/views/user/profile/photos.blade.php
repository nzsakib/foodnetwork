@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9 photos">
		@foreach ($photos as $photo)
			<div class="single">
				<img src="{{ url('biz/images/' . $photo->place_id . '/' . $photo->filename) }}" class="img-responsive" data-toggle="modal" data-target="#imageModal{{ $photo->id }}">	
			</div>

			<div class="modal fade" id="imageModal{{ $photo->id }}" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        <div class="modal-body">
			          <img src="{{ url('biz/images/' . $photo->place_id . '/' . $photo->filename) }}" class="img-responsive">
			        </div>
			        <div class="modal-footer">
			          <button>Like</button>
			          <button>Delete</button>
			          <button>Report</button>
			        </div> <!-- modal footer -->
			      </div> <!-- modal content -->
			      
			    </div> <!-- modal dialog -->
			  </div> <!-- modal ends -->
			
		@endforeach
	</div>
@endsection
