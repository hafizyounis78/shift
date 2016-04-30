// JavaScript Document
var staffList="";
$(document).ready(function () {
	var slectionId='';
    $("input[name=rdSelection]:radio").change(function () {
        if ($("#rdSelection1").attr("checked")) {
			slectionId=$("#rdSelection1").val();
			//alert(slectionId);
        //document.getElementById("divUser").style.display = "None";	
		document.getElementById("divDept").style.display = "block";	
		//document.getElementById("dvstaffname").style.display = "block";	
        document.getElementById("divJobtitle").style.display = "None";	
		document.getElementById("divSpec").style.display = "None";	
		//document.getElementById("dvstaffname").style.display = "block";	
        }
        else {
            slectionId=$("#rdSelection2").val();
			//alert(slectionId);
			document.getElementById("divDept").style.display = "None";	
		//document.getElementById("dvstaffname").style.display = "block";	
        document.getElementById("divJobtitle").style.display = "block";	
		document.getElementById("divSpec").style.display = "block";	
        }
        //$('#log').val($('#log').val()+ $(this).val() + '|');
    })
});
function selectionchange()
{
	
	/*var slectionId=$(this).val();
		alert(slectionId);*/
/*	if (statusId==1)
	{

		$("#rdStatus1").parent().addClass('checked');
		$("#rdStatus2").parent().removeClass('checked');
	}
	 else
	 {

		$("#rdStatus2").parent().addClass('checked');
		$("#rdStatus1").parent().removeClass('checked');
     }*/
}
function editshift(){
	$
			var action = $("#hdnaction").val();
		//alert(action);
	if (!validateStaffselect())
	 return;
		 
	
			var formData = new FormData();
	
				formData.append('hdnshiftId'		 , $("#hdnshiftId").val());
				formData.append('drpLocation'		, $("#drpLocation").val());
				formData.append('drpFromdate'		, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    ,  $("#txtStart").val());
				formData.append('txtEnd'	        ,  $("#txtEnd").val());
				formData.append('rdStatus'          ,  $("input[name=rdStatus]:checked").val());
				formData.append('drplstBreak'		, $("#drplstBreak").val());
				formData.append('chbxIsspecial'		, $("#chbxIsspecial").val());
				formData.append('staffList'		    ,  staffList);
	
	$.ajax({
		url: baseURL+"Shiftscont/"+action ,
			//url: baseURL+"Shiftcont/"+action,
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
				
			
				var success = $('.alert-success', $("#shiftForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				clearShiftForm();
				$("#shift_body").html(returndb);
				
			}
		});//END $.ajax

}


function deleteShift(i)
{
	var x='';
	var r = confirm('This record will be deleted. Do you want to continue?');
	
	
	if (r == true) {
		x =1;
	} else {
		x = 0;
	}
	if(x==1)
	{
	var shiftId=i;
	$.ajax({
			url: baseURL+"Shiftscont/deleteShift",
			type: "POST",
			data: {shiftId:shiftId},
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
			
				clearShiftForm();
			
				//$('#tbLocations').html(returndb);
				var success = $('.alert-success', $("#shiftForm"));
				success.show();
			//	Metronic.scrollTo(success, -200);
				
				$("#shift_body").html(returndb);
				
			}
		});//END $.ajax
	}
}

function updateShift(i)
{
	
	//$("#hdnId").val(i);
	$("#hdnshiftId").val(i);
	$("#hdnaction").val('updateShift');
	var locationId=$("#tdlocation"+i).attr('data-loid');

	$("#drpLocation").val(locationId);
	
	
	$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#drpTodate").val($("#tdend_date"+i).html());
	$("#txtStart").val($("#tdstart_Time"+i).html());
	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	
	var statusId=$("#tdrdStatus"+i).attr('data-stid');
	var Isspecial=$("#tdSpecial_shift"+i).html();
//		alert(Isspecial);
	if 	(Isspecial==1)
 	  //$("#chbxIsspecial").prop('checked', true);
{
	  $('#chbxIsspecial').attr('checked', true); 
	  $("#chbxIsspecial").parent().addClass('checked');
}
	else
	{ $('#chbxIsspecial').attr('checked', false); 
	  $("#chbxIsspecial").parent().removeClass('checked');
	}
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
			document.getElementById("divSelect").style.display = "None";	
		document.getElementById("divUser").style.display = "None";	
		document.getElementById("divDept").style.display = "None";	
        document.getElementById("divJobtitle").style.display = "None";	
		document.getElementById("divSpec").style.display = "None";	

		document.getElementById("dvstaffname").style.display = "block";	
		
				
	//$("#tdstaff").val($("#tdstaff"+i).html());
	//$("#my_multi_select2").html(returndb);
	//$("#my_multi_select2").multiSelect('refresh');
	 Metronic.scrollTo($('#shiftForm'), -100);
}
function clearStaffSelect()
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

function clearShiftForm()
{
	
	
	$("#hdnshiftId").val("");
	$("#hdnaction").val('addshift');
	$("#drpLocation").val("");
	$("#drplstBreak").val("");
	
	$("#drpFromdate").val("");
	$("#drpTodate").val("");
	$("#txtStart").val("");
	$("#txtEnd").val("");
	

	//	$("#rdStatus1").parent().addClass('checked');
	//	$("#rdStatus2").parent().removeClass('checked');
            //alert("shift");
	$("#txtstaffName").val("");
	document.getElementById("divUser").style.display = "block";
	document.getElementById("divDept").style.display = "block";	
	document.getElementById("divSelect").style.display = "block";	
	document.getElementById("dvstaffname").style.display = "None";		
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
function drpdeptChange()
{
	    	$("#my_multi_select1").html('');
			$("#my_multi_select1").multiSelect('refresh');
		
		if (!validateShift())
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
			url: baseURL+"Shiftscont/getUserByDept",
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
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
		 }
}
function drpJobtitleChange()
{
	    
		
		if (!validateShift())
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
			url: baseURL+"Shiftscont/getUserByJobtitle",
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
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
}
}
function drpSpecChange()
{
	    
		
		if (!validateShift())
		 return;
	if ($("#drplstSpec").val()!='' ||$("#drplstJobtitle").val()!='' )
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
			url: baseURL+"Shiftscont/getUserBySpec",
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
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
}
}
//****************timeoff Validation
var ShiftFormValidation = function () {
 var handleValidation = function() {
        
            var form = $('#shiftForm');
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
                        required: "Please select break time of shift"
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
					editshift();
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
function validateStaffselect()
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
function validateShift()
{
	/*var form = $('#submit_form');
    var error = $('.alert-danger', form);*/

			
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
var ShiftComponentsDropdowns = function () {

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
