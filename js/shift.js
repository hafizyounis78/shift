// JavaScript Document
var staffList="";
$(document).ready(function () {
	var slectionId='';
    $("input[name=rdSelection]:radio").change(function () {
        if ($("#rdSelection1").attr("checked")) {
			slectionId=$("#rdSelection1").val();
			document.getElementById("divDept").style.display = "block";	
			document.getElementById("divJobtitle").style.display = "None";	
			document.getElementById("divSpec").style.display = "None";	
        }
        else {
            slectionId=$("#rdSelection2").val();
			document.getElementById("divDept").style.display = "None";	
			document.getElementById("divJobtitle").style.display = "block";	
			document.getElementById("divSpec").style.display = "block";	
        }

    })

//*****************change date or time*************//
	$(".classConflict").change(function () {
	
		clearStaffSelect();
	})		
});

function editshift(){

			var action = $("#hdnaction").val();
		if (action!="updateShift")
			if (!validateStaffselect())
			 return;
				 
	
			var formData = new FormData();
				formData.append('rdShifttype'        , 1);
				formData.append('hdnshiftId'		 , $("#hdnshiftId").val());
				formData.append('drpLocation'		, $("#drpLocation").val());
				formData.append('drpFromdate'		, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    ,  $("#txtStart").val());
				formData.append('txtEnd'	        ,  $("#txtEnd").val());
				formData.append('rdStatus'          ,  $("input[name=rdStatus]:checked").val());
				formData.append('drplstBreak'		, $("#drplstBreak").val());
				formData.append('chbxIsspecial'		, $("#chbxIsspecial").val());
				formData.append('ckbNotification'		, $("#ckbNotification").val());
				formData.append('staffList'		    ,  staffList);
	
	$.ajax({
		url: baseURL+"Shiftscont/"+action ,
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
				var success = $('.alert-success', $("#shiftForm"));
				success.show();
				$("#shift_body").html(returndb);
				
			}
		});//END $.ajax
	}
}

function updateShift(i)
{
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

	if 	(Isspecial==1)
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

 
	$("#txtstaffName").val($("#tdstaff"+i).html());
	document.getElementById("divSelect").style.display = "None";	
	document.getElementById("divUser").style.display = "None";	
	document.getElementById("divDept").style.display = "None";	
	document.getElementById("divJobtitle").style.display = "None";	
	document.getElementById("divSpec").style.display = "None";	
	document.getElementById("dvstaffname").style.display = "block";	
	 Metronic.scrollTo($('#shiftForm'), -100);
}
function clearStaffSelect()
{
		$("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		staffList="";
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
	$("#txtstaffName").val("");
	document.getElementById("divUser").style.display = "block";
	document.getElementById("divDept").style.display = "block";	
	document.getElementById("divSelect").style.display = "block";	
	document.getElementById("dvstaffname").style.display = "None";		
    document.getElementById("divJobtitle").style.display = "None";	
	document.getElementById("divSpec").style.display = "None";	
	var ddlbreak=document.getElementById('drplstBreak');
	ddlbreak.options[0].selected = true;
	 clearStaffSelect();
}
function drpdeptChange()
{
		$("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		
		if (!validateShift())
		 {
			 clearStaffSelect()
			 return;
		 }
		if ($("#drplstDept").val()!='')
		 {
			var formData = new FormData();
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
		{
			 clearStaffSelect()
			 return;
		 }
		if ($("#drplstJobtitle").val()!='')
		 {
		var formData = new FormData();
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
	 {
		 clearStaffSelect()
		 return;
	 }
	if ($("#drplstSpec").val()!='' && $("#drplstJobtitle").val()!='' )
	 {
		var formData = new FormData();
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
//**********Get week number************//
function y2k(number) { return (number < 1000) ? number + 1900 : number; }
function getweekNumber(stratdate,enddate) {
	
	var date1 = new Date(stratdate);
	var date2 = new Date(enddate);
	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) +1; 
	//alert("diffDays "+diffDays);
	if (diffDays > 7)
		return false;
	else
	{
		if (date1.getDay() == 2 && diffDays > 6) 	// Tuseday
			return false;
		else if (date1.getDay() == 3 && diffDays > 5)	// Wednesday
			return false;
		else if (date1.getDay() == 4 && diffDays > 4)	// Thersday
			return false;
		else if (date1.getDay() == 5 && diffDays > 3)	// Friday
			return false;
		else if (date1.getDay() == 6 && diffDays > 2)	// Saterday
			return false;
		else if (date1.getDay() == 0 && diffDays > 1)	// Sunday
			return false;	
			
	}
		return true;
	/*var dateParts = date.split("-");
	 var year=	dateParts[0];
	 var month=dateParts[1] ;
	 var day=dateParts[2];
alert("day :"+day+"  month: "+month+ "  year :"+year); 
*/
/*	 var when = new Date(year,month,day);
    var newYear = new Date(year,0,1);
    var offset = 7 + 1 - newYear.getDay();
    if (offset == 8) offset = 1;
    var daynum = ((Date.UTC(y2k(year),when.getMonth(),when.getDate(),0,0,0) - Date.UTC(y2k(year),0,1,0,0,0)) /1000/60/60/24) + 1;
    var weeknum = Math.floor((daynum-offset+7)/7);
    if (weeknum == 0) {
        year--;
        var prevNewYear = new Date(year,0,1);
        var prevOffset = 7 + 1 - prevNewYear.getDay();
        if (prevOffset == 2 || prevOffset == 8) weeknum = 53; else weeknum = 52;
    }
*/    //return weeknum;
	/* var dateParts = date.split("-");
	 var year=	dateParts[0];
	 var month=dateParts[1] ;
	 var day=dateParts[2];
	 //var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
	alert("day :"+day+"  month: "+month+ "  year :"+year);
    function serial(days) { return 86400000*days; }
    function dateserial(year,month,day) { return (new Date(year,month-1,day).valueOf()); }
    function weekday(date) { return (new Date(date)).getDay()+1; }
    function yearserial(date) { return (new Date(date)).getFullYear(); }
    var date = year instanceof Date ? year.valueOf() : typeof year === "string" ? new Date(year).valueOf() : dateserial(year,month,day), 
        date2 = dateserial(yearserial(date - serial(weekday(date-serial(1))) + serial(4)),1,3);
    return ~~((date - date2 + serial(weekday(date2) + 5))/ serial(7));*/
}
//**********/getweek number************//
//****************timeoff Validation
var ShiftFormValidation = function () {
 var handleValidation = function() {
        
            var form = $('#shiftForm');
            var errormsg = $('.alert-danger', form);
            var successmsg = $('.alert-success', form);
			
			jQuery.validator.addMethod("checkWeekNumber", function(value, element) {
				
    			return getweekNumber($("#drpFromdate").val(),$("#drpTodate").val());
			}, "* must select one week duration ");
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
						greaterThanStartdate:true,
						checkWeekNumber:true
                    
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
						greaterThanStartdate:"Please enter valid end date",
						checkWeekNumber:"End date should be at same week duration"
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
			 },
			afterDeselect: function(values){
				//alert("values is "+values);
			   var staffID =staffList.split(',');
			   var newstafflist="";
			   for ( var i = 0; i < staffID.length; i++ )
				{
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
