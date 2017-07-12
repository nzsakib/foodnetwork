$(document).ready(function(){
	var options = {
	  // types: ['(cities)'],
	  componentRestrictions: {country: "bd"}
	 };
	var input = document.getElementById('mapSearch');
	var autocomplete = new google.maps.places.Autocomplete(input, options);
		
	autocomplete.addListener('place_changed', fillInAddress);

	function fillInAddress() { 
		var place = autocomplete.getPlace();
		// console.log(place);
		var placeLng = place.geometry.location.lng();
		var placeLat = place.geometry.location.lat();
		console.log(placeLat, placeLng);
		
		
	//$.redirect('map.php', {'url': mapCall});
		// $.ajax({   
		//     type : 'POST',
  //           url : 'map.php',
  //           data: {
  //               url : mapCall
  //           },
  //           success : function(data){                                               
  //           	window.location.href = data.redirect;

  //           }   
		// });
	}

	/*https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&type=restaurant&keyword=cruise&key=YOUR_API_KEY*/
	


	
});
