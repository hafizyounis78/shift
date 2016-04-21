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
				formData.append('drpFromdate'		 , $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpFromdate").val());
				formData.append('txtStart'	    ,  $("#txtStart").val());
				formData.append('txtEnd'	        ,  $("#txtEnd").val());
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
				
				//$('#tbLocations').html(returndb);
				var success = $('.alert-success', $("#timeOffForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				clearForm();
				$("#timeoff_body").html(returndb);
				//success.hide();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	}); // END CLICK
	
	
});

function updatetimeoff(i)
{
	/*
	//$("#hdnId").val(i);
	$("#drpLocation").val($("#tdlocation"+i).html());
	
	$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#txtStart").val($("#tdstart_Time"+i).html());
	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	/*if ()
	 	$(":radio[name=rdStatus]", this).attr("checked", true);  
	 else
	 $("input:radio[name=rdStatus]:checked").val(1);
	  $("input:radio[name=active]:not(:checked)").val('no');*/
	//$("#tdstaff").val($("#tdstaff"+i).html());
	 Metronic.scrollTo($('#locationForm'), -100);
}

function clearForm()
{
	/*$("#hdnId").val(i);
	//$("#tdstaff").val($("#tdstaff"+i).html());
	$("#drpFromdate").val('');
	$("#txtStart").val('');
	$("#txtEnd").val('');
	$("#rdStatus").val('');
*/	 Metronic.scrollTo($('#locationForm'), -100);
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
