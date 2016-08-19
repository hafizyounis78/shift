// JavaScript Document

  $(document).ready(function(){
     $.fn.datepicker.defaults.language = 'de';
});

$(document).ready(function(){
     $('.datepicker').datepicker();
});

var staffList="";
var allEmpList='';
var employees='';
$(document).ready(function () {
//$('#txtEnd').timepicker('setTime',"05:00:00");
//	$('#txtEnd').val(null);
/*$('#txtStart').timepicker('setTime', new Date());
	$('#txtEnd').timepicker('setTime', new Date());*/
	var slectionId='';
    $("input[name=rdSelection]:radio").change(function () {
        if ($("#rdSelection1").attr("checked")) {
			slectionId=$("#rdSelection1").val();
			document.getElementById("divDept").style.display = "block";	
			document.getElementById("divJobtitle").style.display = "None";	
			document.getElementById("divSpec").style.display = "None";	
			
		//	$('#drpLocation').empty();
		//	$('#drpLocation').val("");
        }
        else {
            slectionId=$("#rdSelection2").val();
			document.getElementById("divDept").style.display = "None";	
			document.getElementById("divJobtitle").style.display = "block";	
			document.getElementById("divSpec").style.display = "block";	
			getAlllocation();
		}
/*$(function() {
    $( "#dvdate" ).datepicker({ 
	
	firstDay: 1 });
});*/
    })

//*****************change date or time*************//
	$(".shiftclassConflict").change(function () {
	
		clearStaffSelect();
	})		
});
function showshiftDetails()
{
	alert('details');
}

function updateshiftstatus(id)
{
	var isactive = '';
	var newclass = '';
	var itemid = '#i'+id;
	var active_class = 'fa fa-user font-green';
	var unactive_class = 'fa fa-user font-red-sunglo';
	
	if($('#i'+id).attr("class") == active_class)
	{
		isactive = 1;
		newclass = unactive_class;
	}
	else
	{
		isactive = 2;
		newclass = active_class;
	}
	
	$.ajax({
			url: baseURL+"Shiftscont/updateShiftStatus",
			type: "POST",
			data:  {shiftId : id,
					isactive : isactive},
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				if (returndb == '')	//Success
				{
					$('#i'+id).removeClass( $('#i'+id).attr("class") ).addClass(newclass);
				}
			}
		});//END $.ajax
	
}
function getAlllocation()
{
				var formData = new FormData();
			 	    formData.append('deptNo'        , 0),
	
				$.ajax({
				url: baseURL+"Shiftscont/getallLocation",
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
					
				//	$('#drpLocation').empty();
				//	$("#drpLocation").html(returndb);
	
					}
				});//END $.ajax
				
			}
function editshift(){
//alert("staffList insert"+staffList)
			var action = $("#hdnaction").val();
			//alert(action);
		if (action!="updateShift")
			if (!validateStaffselect())
			 return;
		if ( !$("#drpLocation").valid() )
		  valid = false;
		 
	
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
			//alert(action)
			if (action=="duplicatShift")
			{
				//alert(returndb);
				var returndata=returndb.split('@@')	
				if (returndata[0]==1)
				{
					//var danger = $('.alert-danger', $("#shiftForm"));
					//danger.show();
					alert("Shift Conflict Please check the selected employees");
					//clearShiftForm();
				}
				else
				{			
					var success = $('.alert-success', $("#shiftForm"));
					success.show();
				}
				$("#shift_body").html(returndata[1]);	
			}
			else if(action=="updateAllshift")
			{
				alert('Update Shift success');
				location.reload(); 
			}
			else
			{
				var success = $('.alert-success', $("#shiftForm"));
				success.show();
				$("#shift_body").html(returndb);
				clearShiftForm();
			}
			Metronic.scrollTo(success, -200);
			
			
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
function duplicatShift(i)
{
	getAlllocation();
	$("#drplstDept").val(0);
	
	 Metronic.scrollTo($('#shiftForm'), -100);

	$("#hdnshiftId").val(i);
	var shiftid=$("#hdnshiftId").val();
	//alert(shiftid);
	$("#hdnaction").val('duplicatShift');
	var locationId=$("#tdlocation"+i).attr('data-loid');
	//alert(locationId);
	var deptId=$("#tdDepartment"+i).attr('data-loid');
	//alert(deptId);
	//$("#drpLocation")='';
	$("#drpLocation").val(locationId);
	$('#drpFromdate').datepicker('setDate', $("#tdstart_date"+i).html());
	//$("#drpFromdate").val($("#tdstart_date"+i).html());
	$('#drpTodate').datepicker('setDate', $("#tdend_date"+i).html());
	/*$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#drpTodate").val($("#tdend_date"+i).html());*/
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
//	$("#txtStart").val($("#tdstart_Time"+i).html());
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
	$('#txtEnd').timepicker('setTime',$("#tdend_Time"+i).html());
//	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	employees=$("#tdemployees"+i).html();
		//alert(employees);
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

 getemployee();
 		 		 Metronic.scrollTo($('#shiftForm'), -100);
}
function updateAllshift(i)
{
	getAlllocation();
	$("#drplstDept").val(0);
	
	 Metronic.scrollTo($('#shiftForm'), -100);

	$("#hdnshiftId").val(i);
	var shiftid=$("#hdnshiftId").val();
	//alert(shiftid);
	$("#hdnaction").val('updateAllshift');
	var locationId=$("#tdlocation"+i).attr('data-loid');
	//alert(locationId);
	var deptId=$("#tdDepartment"+i).attr('data-loid');
	//alert(deptId);
	//$("#drpLocation")='';
	$("#drpLocation").val(locationId);
	$('#drpFromdate').datepicker('setDate', $("#tdstart_date"+i).html());
	//$("#drpFromdate").val($("#tdstart_date"+i).html());
	$('#drpTodate').datepicker('setDate', $("#tdend_date"+i).html());
	/*$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#drpTodate").val($("#tdend_date"+i).html());*/
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
//	$("#txtStart").val($("#tdstart_Time"+i).html());
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
	$('#txtEnd').timepicker('setTime',$("#tdend_Time"+i).html());
//	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	employees=$("#tdemployees"+i).html();
		//alert(employees);
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

 getemployee();
 		 		 Metronic.scrollTo($('#shiftForm'), -100);
}
function updateShift(i)
{
	getAlllocation();
	
	$("#hdnshiftId").val(i);
	var shiftid=$("#hdnshiftId").val();
	//alert(shiftid);
	$("#hdnaction").val('updateShift');
	var locationId=$("#tdlocation"+i).attr('data-loid');
	//alert(locationId);
	var deptId=$("#tdDepartment"+i).attr('data-loid');
	//alert(deptId);
	//$("#drpLocation")='';
	$("#drpLocation").val(locationId);
	$('#drpFromdate').datepicker('setDate', $("#tdstart_date"+i).html());
	//$("#drpFromdate").val($("#tdstart_date"+i).html());
	$('#drpTodate').datepicker('setDate', $("#tdend_date"+i).html());
	/*$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#drpTodate").val($("#tdend_date"+i).html());*/
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
//	$("#txtStart").val($("#tdstart_Time"+i).html());
	$('#txtStart').timepicker('setTime',$("#tdstart_Time"+i).html());
	$('#txtEnd').timepicker('setTime',$("#tdend_Time"+i).html());
//	$("#txtEnd").val($("#tdend_Time"+i).html());
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
		if ($("#rdSelection1").attr("checked")) {
		/*$('#drpLocation').empty();
		$('#drpLocation').val("");
		*///alert('shift');
		}
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
	//$('#drpLocation').empty();
	$('#drpLocation').val("");
	$("#drplstBreak").val("");
	
	$("#drpFromdate").datepicker("setDate", new Date());
	$("#drpTodate").datepicker("setDate", new Date());

	$('#txtStart').timepicker('setTime', new Date());
	$('#txtEnd').timepicker('setTime', new Date());

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
		//$('#drpLocation').empty();
		//$('#drpLocation').val("");
	
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
				var retdb=returndb.split('@@');
				var stafflist=retdb[0];
				var location=retdb[1];
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				/*alert(stafflist);
				alert(location);
				*/
				$("#my_multi_select1").html(stafflist);
				$("#my_multi_select1").multiSelect('refresh');
			//	$('#drpLocation').empty();
			//	$("#drpLocation").html(location);

			}
		});//END $.ajax
		 }
}
function getemployee()
{
		$("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		$("#drplstDept").val(0);
			var formData = new FormData();
				formData.append('drpFromdate'	, $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    , $("#txtStart").val());
				formData.append('txtEnd'	    , $("#txtEnd").val());
				formData.append('deptNo'        , $("#drplstDept").val()),
		
		$.ajax({
			url: baseURL+"Shiftscont/getAllEmp",
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
				//initChart2(returndb.result1,returndb.result2);
				 data21 = returndb.result1;
         		data22 = returndb.result2;
			/*	 
			$.each(returndb, function(i, item){
               data21 = item.data21;
               data22 = item.data22;
            });*/
          //  initChart2(data21,data22);
			//alert(data21);
			var emplist='';

			//alert(availbleEmp);
			staffList='';
				for(i=0;i<data21.length;i++)
				{
					
					if (employees.search(data21[i].stffId)!= -1)
					
					emplist=emplist+'<option selected value='+data21[i].stffId+'>'+data21[i].totalTime+'|'+data21[i].staffName+'|'+data21[i].hoursPerWeek+'</option>';	
					
					else
					emplist=emplist+'<option value='+data21[i].stffId+'>'+data21[i].totalTime+'|'+data21[i].staffName+'|'+data21[i].hoursPerWeek+'</option>';	
					
				}
				for(i=0;i<data22.length;i++)
				{
					
					if (employees.search(data22[i].stffId)!= -1)
					{
						if (staffList=='')
							staffList=data22[i].stffId;
						else
							staffList=staffList+','+data22[i].stffId;
						emplist=emplist+'<option selected value='+data22[i].stffId+'>'+data22[i].totalTime+'|'+data22[i].staffName+'|'+data22[i].hoursPerWeek+'</option>';	
					}
					else
					emplist=emplist+'<option title="Unavailable" disabled="disabled" value='+data22[i].stffId+'>'+data22[i].totalTime+'|'+data22[i].staffName+'|'+data22[i].hoursPerWeek+'</option>';	
					
				}
	//alert("getemployee:  "+staffList);
				$("#my_multi_select1").html(emplist);
				$("#my_multi_select1").multiSelect('refresh');
				$("#my_multi_select1").multiSelect('refresh');


			}
		});//END $.ajax
		
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
			/*	$('#drpLocation').empty();
				$("#drpLocation").html(location);*/

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
			/*	$('#drpLocation').empty();
				$("#drpLocation").html(location);*/

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
                        required: "Bitte tragen Sie den station"
                    },
                    drpFromdate: {
                        required: "Bitte tragen Sie eine Startdatum "
                    },
	                drpTodate: {
						required: "Bitte tragen Sie eine Enddatum",
						greaterThanStartdate:"Bitte tragen Sie eine Enddatum",
						checkWeekNumber:"Enddatum in derselben Woche Dauer sein sollte"
                    },
                    txtStart: {
                        required: "Bitte tragen Sie eine Startzeit ein",
						
						
                    }
					,
                    txtEnd: {
                        required: "Bitte tragen Sie eine Endzeit ein",
						greaterThanStarttime:"Bitte tragen Sie eine Endzeit ein"
						
                    },
					drplstBreak: {
                        required: "Bitte wählen Sie Pausenzeit der Verschiebung"
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

	/*if ( !$("#drpLocation").valid() )
		valid = false;
	*/
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
				/*alert("values is "+values);
				alert("staffList is "+staffList);*/
				/*var txt = $("#my_multi_select1 option[value='"+values+"']").text();
				$("#my_multi_select1 option[value='"+values+"']").html('6666');

				//var selectedValue=$('#my_multi_select1').multiSelect('select', String);
				alert(txt);
				 var avlHr =txt.split('|');
				 alert(avlHr);*/
				if (staffList=='')
				  	staffList=values;
				else
			  		staffList=staffList+','+values;
			 },
			afterDeselect: function(values){
				//alert("values is "+values);
				//alert("staffList is "+staffList);
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
			
			selectableHeader: "<div class='btn-danger' align='center'><b> Verfügbar </b></div>",
  			selectionHeader: "<div class='btn-success' align='center'><b> Ausgewählt </b></div>"
        });
	
    }
	
	return {
        //main function to initiate the module
        init: function () {            
           handleMultiSelect();
        }
    };

}();

//************* patient Ajax**************//
function activate_group()
{
	var ids = "";
	$("input:checked").each(function () {
		if ($(this).attr("id") != -1 ) // NOT the Checkbox in the header
		{
			var id = $(this).attr("id");
			if (ids == "")
				ids = ids + id;
			else
				ids = ids + ',' +id;
				
			alert("Do something for: " + ids );
		}
    });
}
function delete_group()
{
	var ids = "";
	$("input:checked").each(function () {
		if ($(this).attr("id") != -1 ) // NOT the Checkbox in the header
		{
			var id = $(this).attr("id");
			if (ids == "")
				ids = ids + id;
			else
				ids = ids + ',' +id;
				
			alert("Do something for: " + ids );
		}
    });
}
var shiftTableAjax = function () {

// I removed Datepicker becuse it is not used here

    var handleRecords = function () {

        var grid = new Datatable();
		
        grid.init({
            src: $("#shiftdatatable_ajax"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
				//alert(grid);
            },
            onError: function(xhr, status, error) {
  				//alert(xhr.responseText);
			},
            loadingMessage: 'Search...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": baseURL+"Shiftscont/shiftgriddata", // ajax source
					"type": "POST"
                },
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
	
    return {

        //main function to initiate the module
        init: function () {

            //initPickers();
            handleRecords();
			
        }

    };

}();