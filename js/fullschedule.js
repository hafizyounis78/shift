// JavaScript Document
$(document).ready(function () {
	var slectionId='';
    $("input[name=rdSelection]:radio").change(function () {
        if ($("#rdSelection1").attr("checked")) {
			slectionId=$("#rdSelection1").val();
			document.getElementById("divDept").style.display = "block";	
			document.getElementById("divJobtitle").style.display = "None";	
			document.getElementById("divSpec").style.display = "None";	
			var ddldept=document.getElementById('drplstDept');
			ddldept.options[0].selected = true;

        }
        else {
            slectionId=$("#rdSelection2").val();
			document.getElementById("divDept").style.display = "None";	
		    document.getElementById("divJobtitle").style.display = "block";	
			document.getElementById("divSpec").style.display = "block";	
			var ddlJobtitle=document.getElementById('drplstJobtitle');
			ddlJobtitle.options[0].selected = true; 
			var ddlSpec=document.getElementById('drplstSpec');
			ddlSpec.options[0].selected = true;
        }
		
        //$('#log').val($('#log').val()+ $(this).val() + '|');
    })
});
function addShiftTemplate()
{
	
	$.ajax({
			url: baseURL+"Fullschedulecont/addShiftTemplate",
			type: "POST",
			data:  $("#shiftttemplateForm").serialize(),
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				
                var el = $('<div class="external-event label label-default col-md-12"><span id="dvName">' 
						  + returndb[a]['txtName'] + 
						 '</span><br/><span id="dvStart">' + returndb[a]['txtStart'] + '</span> - <span id="dvEnd">'
						  + returndb[a]['txtEnd'] +
						  '</span><i class="fa fa-coffee" aria-hidden="true"></i> <span id="dvBreak">' 
						  + returndb[a]['txtBreak'] +'</span> min</div>');
                jQuery('#event_box').append(el);
				
				//--initDrag;
				var eventObject = {
                    title: $.trim(el.text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                el.data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                el.draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
				//--
                
			}
		});//END $.ajax
	
}
//********************shift save**************//
function addModalshift(){
	
		
		
			//alert("addModalshift");
			if (!validateShifts())
			 return;
			 if (!validatStaff())
			 return;
		
			var formData = new FormData();
	
				formData.append('rdShifttype'        ,  $("input[name=rdShifttype]:checked").val());
				formData.append('drpLocation'		 ,  $("#drpLocation").val());
				formData.append('drpFromdate'		 ,  $("#drpFromdate").val());
				formData.append('drpTodate'	         ,  $("#drpTodate").val());
				formData.append('txtStart'	         ,  $("#txtStart").val());
				formData.append('txtEnd'	         ,  $("#txtEnd").val());
				formData.append('drplstBreak'	     ,  $("#drplstBreak").val());
				formData.append('rdStatus'           ,  $("input[name=rdStatus]:checked").val());
				formData.append('chbxIsspecial'		, $("#chbxIsspecial").val());
				formData.append('ckbNotification'		, $("#ckbNotification").val());
				formData.append('staffList'		     ,  staffList);
	
	$.ajax({
			url: baseURL+"Fullschedulecont/addShift",
			type: "POST",
			data: formData,
			 processData: false,
			 contentType: false,
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.response	Text + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				
				$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
					$(".alert-success").alert('close');
				});
								//$('#tbLocations').html(returndb);
				/*var success = $('.alert-success');
				success.show();*/
				//Metronic.scrollTo(success, -200);
				clearFullShiftForm();
				 //$('#calendar').fullCalendar('initCalendar');
				 location.reload();
				//success.hide();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
}
	
//****************select shift type*******//
$(document).ready(function() {
    $('input[type=radio][name=rdShifttype]').change(function() {
        if (this.value == '1') {
            //alert("shift");
			document.getElementById("divBreak").style.display = "block";	
			
			/*var input = document.getElementById('rdStatus1');
			alert(input);
			input.innerHTML  = 'New Text';*/
        }
        else if (this.value == '2') {
			document.getElementById("divBreak").style.display = "none";
          //  alert("time off");
        }
    });
});


function clearFullStaffSelect()
{
		$("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		var ddldept=document.getElementById('drplstDept');
		 ddldept.options[0].selected = true;
		var ddlJobtitle=document.getElementById('drplstJobtitle');
		 ddlJobtitle.options[0].selected = true; 
		 var ddlSpec=document.getElementById('drplstSpec');
		 ddlSpec.options[0].selected = true; 
}
function clearFullShiftForm()
{
	
	
	$("#hdnshiftId").val("");
	$("#drpLocation").val("");
	$("#drplstBreak").val("");
	
	$("#drpFromdate").val("");
	$("#drpTodate").val("");
	$("#txtStart").val("");
	$("#txtEnd").val("");
	

	
	$("#txtstaffName").val("");
	//document.getElementById("divUser").style.display = "block";
	document.getElementById("divDept").style.display = "block";	
	document.getElementById("divSelect").style.display = "block";	
    document.getElementById("divJobtitle").style.display = "None";	
	document.getElementById("divSpec").style.display = "None";	
	$("#my_multi_select1").html('');
	$("#my_multi_select1").multiSelect('refresh');
	var ddldept=document.getElementById('drplstDept');
	ddldept.options[0].selected = true;
	var ddlbreak=document.getElementById('drplstBreak');
	ddlbreak.options[0].selected = true;
	var ddlJobtitle=document.getElementById('drplstJobtitle');
	ddlJobtitle.options[0].selected = true; 
	var ddlSpec=document.getElementById('drplstSpec');
	ddlSpec.options[0].selected = true; 
				
	 //Metronic.scrollTo($('#timeOffForm'), +1000);
}
function drpdeptFullChange()
{
	    	$("#my_multi_select1").html('');
			$("#my_multi_select1").multiSelect('refresh');
		var shifttype= $("input[name=rdShifttype]:checked").val();
		var shiftcont='';
		if (shifttype==1)
			shiftcont="Shiftscont";
		else if(shifttype==2)	
			shiftcont="Timeoffcont";
		if (!validateShifts())
		 return;
		if ($("#drplstDept").val()!='')
		 {
		var formData = new FormData();
	
				
				//formData.append('drpLocation'		, $("#drpLocation").val());
				formData.append('drpFromdate'	, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    , $("#txtStart").val());
				formData.append('txtEnd'	    , $("#txtEnd").val());
				formData.append('deptNo'        , $("#drplstDept").val()),
		
		$.ajax({
			url: baseURL+shiftcont+"/getUserByDept",
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
				
				//document.getElementById("divUser").style.display = "block";
				//document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
		 }
}
function drpJobtitleFullChange()
{
	    
		var shifttype= $("input[name=rdShifttype]:checked").val();
		var shiftcont='';
		if (shifttype==1)
			shiftcont="Shiftscont";
		else if(shifttype==2)	
			shiftcont="Timeoffcont";
			
		if (!validateShifts())
		 return;
		if ($("#drplstJobtitle").val()!='')
		 {
		var formData = new FormData();
	
				
				//formData.append('drpLocation'		, $("#drpLocation").val());
				formData.append('drpFromdate'	, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    , $("#txtStart").val());
				formData.append('txtEnd'	    , $("#txtEnd").val());
				formData.append('JobTitelId'        , $("#drplstJobtitle").val());
		
		$.ajax({
			url: baseURL+shiftcont+"/getUserByJobtitle",
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
				
				//document.getElementById("divUser").style.display = "block";
				//document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
}
}
function drpSpecFullChange()
{
	    
		var shifttype= $("input[name=rdShifttype]:checked").val();
		var shiftcont='';
		if (shifttype==1)
			shiftcont="Shiftscont";
		else if(shifttype==2)	
			shiftcont="Timeoffcont";
			
		if (!validateShifts())
		 return;
	if ($("#drplstSpec").val()!='' && $("#drplstJobtitle").val()!='' )
		 {
		var formData = new FormData();
	
				
				//formData.append('drpLocation'		, $("#drpLocation").val());
				formData.append('drpFromdate'	, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    , $("#txtStart").val());
				formData.append('txtEnd'	    , $("#txtEnd").val());
				formData.append('JobTitelId'        , $("#drplstJobtitle").val());
				formData.append('specId'        , $("#drplstSpec").val());
		
		$.ajax({
			url: baseURL+shiftcont+"/getUserBySpec",
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
				
				//document.getElementById("divUser").style.display = "block";
			//	document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
}
}
//****************timeoff Validation
function validatStaff()
{
	var error = $('#dvStaffMsg');
	var valid = true;
	if ( staffList=='' )
	 valid = false;
	
	else
	 valid = true;
	
	if(!valid)
	{
		
		error.show();
        Metronic.scrollTo(error, -200);
	}
	else
	{
		error.hide();
	}
	return valid;
}
function validateShifts()
{
		var error = $('#dvDeptMsg');
	
	var valid = true;
	
	
	
	if ( !$("#drpFromdate").valid() )
		valid = false;
		if ( !$("#drpTodate").valid() )
		valid = false;
	if ( !$("#txtStart").valid() )
		valid = false;
	if ( !$("#txtEnd").valid() )
		valid = false;

	if ( !$("#drpLocation").valid() )
		valid = false;
	
	if(!valid)
	{
		
		error.show();
        Metronic.scrollTo(error, -200);
	}
	else
	{
		error.hide();
	}
		
	return valid;
}
var ShiftModalFormValidation = function () {
 var handleValidation = function() {
        
            var form = $('#shiftModalform');
            var errormsg = $('.alert-danger', form);
            var successmsg = $('.alert-success', form);
			jQuery.validator.addMethod("multiSelectRequired", function(value, element) {
    			  var count = $(element).find('option:selected').length;
                return count > 0;
			}, "* must select at least one staff");
			jQuery.validator.addMethod("greaterThanStartdate", function(value, element) {
    			return Date.parse($('#drpTodate').val())>=Date.parse($('#drpFromdate').val()) ;
			}, "* End date must be greater than Start date");
			jQuery.validator.addMethod("greaterThanStarttime", function(value, element) {
				var start_time = $("#txtStart").val();
				var end_time = $("#txtEnd").val();
				//convert both time into timestamp
				var stt = new Date("November 13, 2015 " + start_time);
				stt = stt.getTime();
				var endt = new Date("November 13, 2015 " + end_time);
				endt = endt.getTime();
					
				return endt>stt ;
			}, "* End time must be greater than Start time");
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
                        required: true,
						date:{
								max: 'drpTodate',
							  }
                    },
	                drpTodate: {
                        required:true,
						greaterThanStartdate:true
                    
					},

					txtStart: {
                        required: true
                    },
	                txtEnd: {
                        required: true,
						greaterThanStarttime:true
                    },
					drplstBreak: {
                        required:true
                    }
					},

               messages: { // custom messages for radio buttons and checkboxes
                drpLocation: {
                        required: "Please enter the location"
                    },
                    drpFromdate: {
                        required: "Please enter valid start date"
                    },
	                drpTodate: {
						required: "Please enter valid end date",
						greaterThanStartdate:"Please enter valid end date"
                    },
                    txtStart: {
                        required: "Please enter valid start time",
						
						
                    }
					,
                    txtEnd: {
                        required: "Please enter valid end time",
						greaterThanStarttime:"Please enter valid end time"
						
                    },
					drplstBreak: {
                        required: "Please select break time"
                    }
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
					addModalshift();
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