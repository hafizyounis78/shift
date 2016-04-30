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
function addshift(){
	
		
		
			var action = "addShift";
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
	//alert("1");
	var error = $('#dvDeptMsg');
	var valid = true;
	var start_time = $("#txtStart").val();
	var end_time = $("#txtEnd").val();
	//convert both time into timestamp
	var stt = new Date("November 13, 2015 " + start_time);
	stt = stt.getTime();
	var endt = new Date("November 13, 2015 " + end_time);
	endt = endt.getTime();
	if( endt<=stt) 
	  valid = false;
	
	if ($('#drpLocation').val()==''||$('#drpTodate').val()=='' ||$('#drpFromdate').val()==''||$('#drpTodate').val()==''||$("#txtEnd").val()==''||$("#txtStart").val()=='')	
		valid = false;
	if( endt<stt) 
	 	valid = false;
		 
	if(Date.parse($('#drpTodate').val())<Date.parse($('#drpFromdate').val()))
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
