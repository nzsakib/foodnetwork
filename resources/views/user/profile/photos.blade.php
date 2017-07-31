@extends('user.master-profile')

@section('onFeed')
	<div class="col-md-9 photos">
		@foreach ($photos as $photo)
			<div class="single">
				<a class="modalLink" href="{{ url('biz/images/' . $photo->place_id . '/' . $photo->filename) }}">
				<img src="{{ url('biz/images/' . $photo->place_id . '/' . $photo->filename) }}" class="img-responsive" data-toggle="modal" data-target="#imageModal{{ $photo->id }}">
				</a>	
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
			          @if(Auth::id() == $photo->user_id)
							<a href="{{ route('photoDelete', ['id' => $photo->id]) }}" class="btn btn-danger">Delete</a>
			          @endif
			        </div> <!-- modal footer -->
			      </div> <!-- modal content -->
			      
			    </div> <!-- modal dialog -->
			  </div> <!-- modal ends -->
			
		@endforeach
	</div>
@endsection

@section('js')
	<script>
		$("a.modalLink").click(function(e) {
			e.preventDefault();
		});
	</script>
@endsection
