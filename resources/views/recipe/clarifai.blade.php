@extends('master')

@section('content')
	<div class="container clarifai">
		<div class="row">
			<div class="col-md-7">
				<div class="upload-file" id="image-holder">
					<div class="upload-icon">
						<i class="fa fa-upload" aria-hidden="true"></i>
						<h4>Click Here To Upload</h4>
					</div>
				</div>
					<form action="/imgclarifai" method="POST" enctype="multipart/form-data" class="clarifai-form">
					{{ csrf_field() }}
						<input type="file" name="image" accept="image/*" />
						<button type="submit" class="btn btn-dash">Analyze</button>
					</form>
					<button class="btn btn-dash ajax">Analyze Image</button>
					
					<div class="loading pull-right">
						<img src="{{ asset('/images/loading2.gif') }}" alt="">
					</div>
			</div>
			<div class="col-md-5 right">
				<ul class="all-items">

				</ul>
			</div>
		</div>
	</div>
@endsection


@section('js')
	<script>
	var $loading = $('.loading').hide();
	$(document)
	  .ajaxStart(function () {
	    $loading.show();
	  })
	  .ajaxStop(function () {
	    $loading.hide();
	  });

	$(".upload-file").click(function () {
	  $("input[type='file']").trigger('click');
	});

	// Add image to container
	$("form.clarifai-form input[type=file]").on('change', function () {

	     //Get count of selected files
	     var countFiles = $(this)[0].files.length;

	     var imgPath = $(this)[0].value;
	     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	     var image_holder = $("#image-holder");
	     image_holder.empty();

	     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	         if (typeof (FileReader) != "undefined") {

	             //loop for each file selected for uploaded.
	             for (var i = 0; i < countFiles; i++) {

	                 var reader = new FileReader();
	                 reader.onload = function (e) {
	                     $("<img />", {
	                         "src": e.target.result,
	                             "class": "thumb-image img-responsive"
	                     }).appendTo(image_holder);
	                 }

	                 image_holder.show();
	                 reader.readAsDataURL($(this)[0].files[i]);
	             }

	         } else {
	             alert("This browser does not support FileReader.");
	         }
	     } else {
	         alert("Pls select only images");
	     }
	 });

	// Submit Form with ajax
	$('button.ajax').on('click', function(e) {
		e.preventDefault();
	    $.ajax({
	        // Your server script to process the upload
	        url: '/imgclarifai',
	        type: 'POST',

	        // Form data
	        data: new FormData($('form')[0]),

	        // Tell jQuery not to process data or worry about content-type
	        // You *must* include these options!
	        cache: false,
	        contentType: false,
	        processData: false,

	        // Custom XMLHttpRequest
	        xhr: function() {
	            var myXhr = $.ajaxSettings.xhr();
	            if (myXhr.upload) {
	                // For handling the progress of the upload
	                myXhr.upload.addEventListener('progress', function(e) {
	                    if (e.lengthComputable) {
	                        $('progress').attr({
	                            value: e.loaded,
	                            max: e.total,
	                        });
	                    }
	                } , false);
	            }
	            return myXhr;
	        },
	        success: function (result) {
	              console.log(result);
	              var ul = $("ul.all-items");
	              result.forEach(function(objItem) {
	            	var name = objItem.name;
	            	ul.append("<li class='animated fadeInUp'>" + name + "</li>");
	            	
	              });
	        }
	    });
	});

	</script>
@endsection
