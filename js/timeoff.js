// JavaScript Document
var staffList="";
$(document).ready(function(){
	$('#btnSaveTimeoff').click(function(event) {							
		event.preventDefault();
		
		//if ($("#hdnId").val() == '')
			var action = "addTimeoff";
	/*	else
			var action = "updateTimeoff";*/
			/*if (document.getElementById('rdStatus').checked) {
				  var status_value = document.getElementById('rdStatus').value;
				}
				alert(status_value);*/
			var formData = new FormData();
	
	
				formData.append('drpLocation'		 , $("#drpLocation").val());
				formData.append('dpTimeOffDate'		 , $("#dpTimeOffDate").val());
				formData.append('dpTimeOffFromTime'	 ,  $("#dpTimeOffFromTime").val());
				formData.append('dpTimeOffToTime'	 ,  $("#dpTimeOffToTime").val());
				formData.append('rdStatus'          ,  $("input[name=rdStatus]:checked").val());
				formData.append('staffList'		     ,  staffList);
	
	$.ajax({
			url: baseURL+"Timeoffcont/"+action,
			type: "POST",
			data: formData,
			 processData: false,
			 contentType: false,
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
				if (staffList=='')
				staffList=values;
				else
			  staffList=staffList+','+values;
			  //alert("staffList "+staffList);
			},
			afterDeselect: function(values){
				//alert("values is "+values);
			   var staffID =staffList.split(',');
			   var newstafflist="";
			   for ( var i = 0; i < staffID.length; i++ )
				{//alert("i="+i);
					//staffID[i] =staffList.split(',');
					if (staffID[i]==values)
					{
					//	alert("staffID["+i+"]"+staffID[i])
					}
					else
					{
						if (newstafflist=='')
							newstafflist=staffID[i];
						else
							newstafflist=newstafflist+','+staffID[i];
					}
				}
				staffList=newstafflist;
				// alert("new staffList "+staffList);
//			   staffList.split(",");
//				if (staffID=values)
				 
				 

			  //alert(values);
			},
			
			selectableHeader: "<div class='btn-danger' align='center'><b> Available </b></div>",
  			selectionHeader: "<div class='btn-success' align='center'><b> Selected </b></div>"
        });
	
    }
	
	return {
        //main function to initiate the module
        init: function () {            
           handleMultiSelect();
        }
    };

}();
