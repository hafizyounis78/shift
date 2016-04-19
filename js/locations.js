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
				
				$('#tbLocations').html(returndb);
				var success = $('.alert-success', $("#locationForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				clearForm();
				//success.hide();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	}); // END CLICK
	
	
});

function order(id,varOrderOpr)
{
	/*if($('.order').attr('data-operation') == "up")
		var varOrderOpr = '-1';
	else if($('.order').attr('data-operation') == "down")
		var varOrderOpr = '+1';*/
	
	//alert(varOrderOpr);return;
	var varOrder = $("#tdOrder"+id).html();
	
	$.ajax({
			url: baseURL+"Locationscont/orderLocation",
			type: "POST",
			data:  {varId:id, varOrder:varOrder, varOrderOpr:varOrderOpr},
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				
				$('#tbLocations').html(returndb);
				
								
			}
		});//END $.ajax
}
function selectRow(i)
{
	$("#hdnId").val(i);
	$("#txtName").val($("#tdName"+i).html());
	$("#txtDescription").val($("#tdDescription"+i).html());
	$("#txtColor").val($('#tdColor'+i).attr("data-color"));
	$("#dvColor").colorpicker('setValue', $('#tdColor'+i).attr("data-color"));
	 Metronic.scrollTo($('#locationForm'), -100);
}
function clearForm()
{
	$("#hdnId").val('');
	$("#txtName").val('');
	$("#txtDescription").val('');
	$("#txtColor").val("#ffffff");
	$("#dvColor").colorpicker('setValue', "#ffffff");
}