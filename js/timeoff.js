// JavaScript Document
var staffList="";

function edittimeoff() {							
		//event.preventDefault();
		var action = $("#hdnaction").val();
		alert(action);
			var formData = new FormData();
	
				formData.append('hdnshiftId'		 , $("#hdnshiftId").val());
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
				alert("success");
				clearfimeoffForm();
				alert("success2");
				//$('#tbLocations').html(returndb);
				var success = $('.alert-success', $("#timeOffForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				
				$("#timeoff_body").html(returndb);
				
			}
		});//END $.ajax
	} // END function edittimeoff
	
function deletetimeoff()
{
}

function updatetimeoff(i)
{
	
	//$("#hdnId").val(i);
	$("#hdnshiftId").val(i);
	$("#hdnaction").val('updateTimeoff');
	var locationId=$("#tdlocation"+i).attr('data-loid');

	$("#drpLocation").val(locationId);
	
	
	$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#txtStart").val($("#tdstart_Time"+i).html());
	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	
	var statusId=$("#tdrdStatus"+i).attr('data-stid');
		//alert(statusId);
	if (statusId==1)
{

		$("#rdStatus1").parent().addClass('checked');
		$("#rdStatus2").parent().removeClass('checked');
}
	 else
{

			$("#rdStatus2").parent().addClass('checked');
		$("#rdStatus1").parent().removeClass('checked');
}

            //alert("shift");
$("#txtstaffName").val($("#tdstaff"+i).html());
			document.getElementById("divUser").style.display = "None";	
			document.getElementById("dvstaffname").style.display = "block";	
				
	//$("#tdstaff").val($("#tdstaff"+i).html());
	//$("#my_multi_select2").html(returndb);
	//$("#my_multi_select2").multiSelect('refresh');
	 Metronic.scrollTo($('#timeOffForm'), -100);
}

function clearfimeoffForm()
{
	alert("clear");
	
	$("#hdnshiftId").val("");
	$("#hdnaction").val('addtimeoff');
	$("#drpLocation").val("");
	
	
	$("#drpFromdate").val("");
	$("#txtStart").val("");
	$("#txtEnd").val("");
	

	//	$("#rdStatus1").parent().addClass('checked');
	//	$("#rdStatus2").parent().removeClass('checked');
            //alert("shift");
	$("#txtstaffName").val("");
	document.getElementById("divUser").style.display = "block";
	document.getElementById("dvstaffname").style.display = "None";		
				
	 //Metronic.scrollTo($('#timeOffForm'), +1000);
}

//****************timeoff Validation
var TimeOffFormValidation = function () {
 var handleValidation = function() {
        
            var form = $('#timeOffForm');
            var errormsg = $('.alert-danger', form);
            var successmsg = $('.alert-success', form);
			
            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
					
					drpLocation: {
                        required: true
                    },
	                drpFromdate: {
                        required: true
                    },
					txtStart: {
                        required: true
                    },
	                txtEnd: {
                        required: true
                    },
				/*	my_multi_select1: {
                        required: true,
						//greaterThanSixty : true
                    }*/
				},

               messages: { // custom messages for radio buttons and checkboxes
                drpLocation: {
                        required: "Please enter the location"
                    },
                    drpFromdate: {
                        required: "Please enter timeoff date"
                    }
					,
                    txtStart: {
                        required: "Please enter start time of timeoff"
                    }
					,
                    txtEnd: {
                        required: "Please enter start time of timeoff"
                    },
					/*my_multi_select1: {
                        required: "Please select at least one staff"
						
                    }*/
				},
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    successmsg.hide();
                    errormsg.show();
					$('#spnMsg').text('Please check the entered fields ,there is some errors');
                    Metronic.scrollTo(errormsg, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    errormsg.hide();
					edittimeoff();
                    //form[0].submit(); // submit the form
                }

            });
    }
return {
        //main function to initiate the module
        init: function () {
            handleValidation();

        }

    };

}();


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
