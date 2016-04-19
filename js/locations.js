// JavaScript Document

$(document).ready(function(){
	$('#btnSaveLocations').click(function(event) {							
		event.preventDefault();
		
		if ($("#hdnId").val() == '')
			var action = "addLocation";
		else
			var action = "updateLocation";
			
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
				clearForm();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	}); // END CLICK

});

function selectRow(i)
{
	$("#hdnId").val(i);
	$("#txtName").val($("#tdName"+i).html());
	$("#txtDescription").val($("#tdDescription"+i).html());
	$("#txtColor").val($('#tdColor'+i).attr("data-color"));
	$("#dvColor").colorpicker('setValue', $('#tdColor'+i).attr("data-color"));	
}
function clearForm()
{
	$("#hdnId").val('');
	$("#txtName").val('');
	$("#txtDescription").val('');
	$("#txtColor").val("#ffffff");
	$("#dvColor").colorpicker('setValue', "#ffffff");
}