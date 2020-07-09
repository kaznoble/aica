$j = jQuery.noConflict();

$j(document).ready(function() {
	$j('.butt_port_number').on('click', function() {
		$j('.div_portno_status').html('Loading ...');
		var port_number = $j('#txt_number_of_port').val();
		
		$j.ajax({
			url: "/ajax/aica_admin.php",
			data: {port_no:port_number},
			method: "POST"
			}).then(function (response) {
				// code to execute in case of success
				//response = JSON.stringify(response);
				$j('.div_portno_status').html('Success! it has been updated');
			}, function (response) {
			   // code to execute in case of error
			   $j('.div_portno_status').html('Failed! please try again.');
		});	
		console.log('admin js!!');
	});
});