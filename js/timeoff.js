// JavaScript Document
var staffList="";
$(document).ready(function(){
	$('#btnSaveTimeoff').click(function(event) {							
		event.preventDefault();
		
		if ($("#hdnId").val() == '')
			var action = "addTimeoff";
		else
			var action = "updateTimeoff";
			
	$.ajax({
			url: baseURL+"Timeoffcont/"+action,
			type: "POST",
			data:  $("#timeOffForm").serialize(),
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

var ComponentsDropdowns = function () {

 var handleMultiSelect = function () {
        $('#my_multi_select1').multiSelect({
            selectableOptgroup: true,
			
			afterSelect: function(values){
			  
			},
			afterDeselect: function(values){
			   $.ajax({
					url: baseURL+"Usertypeperm/deleteusertypepermession",
					type: "POST",
					data:  {user_type_id : $("#drpUsertypeperm").val(),
								  values : values},
					error: function(xhr, status, error) {
						//var err = eval("(" + xhr.responseText + ")");
						alert(xhr.responseText);
					},
					beforeSend: function(){},
					complete: function(){},
					success: function(returndb){
						if(returndb != '')
							$('#my_multi_select2').multiSelect('select', values);
					}
				});//END $.ajax
			},
			
			selectableHeader: "<div class='btn-danger' align='center'><b> غـيـر مـتـاحـة </b></div>",
  			selectionHeader: "<div class='btn-success' align='center'><b> مـتـاحــة </b></div>"
        });
	
    }
	
	return {
        //main function to initiate the module
        init: function () {            
           handleMultiSelect();
        }
    };

}();
