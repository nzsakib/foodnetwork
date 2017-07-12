
	$('#mytabs a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});

	
	// $('#mytabs a[href="#ingredients"]').click(function (e) {
	//   e.preventDefault();
	//   $(this).tab('show');
	// });
	// $('#mytabs a[href="#nutrition"]').click(function (e) {
	//   e.preventDefault();
	//   $(this).tab('show');
	// });

	// $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	//   e.target // newly activated tab
	//   e.relatedTarget // previous active tab
	// })
