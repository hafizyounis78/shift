// JavaScript Document

$(document).ready(function(){
	$('#btnSaveLocations').click(function(event) {							
		event.preventDefault();
		
		var action = "addLocation";
		alert('hi');
	$.ajax({
			url: baseURL+"Locationscont/"+action,
			type: "POST",
			data:  $("#locationForm").serialize(),
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				alert(returndb);
				$('#tbLocations').html(returndb);
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	}); // END CLICK

});