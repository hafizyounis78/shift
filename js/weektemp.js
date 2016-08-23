function get_Templastschedual()
{
	var startDate=$('#lastMondy').val();
	//var endDate=$('#nextMondy').val();
	$('#hdncurrStartDate').val(startDate);	
	$('#hdnNoOfDay').val(7);
	var e = document.getElementById("drpWeek");
var weekvalue = e.options[0].value;	
	//$('#hdncurrEndDate').val(endDate);		
	//	alert(weekvalue);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),
		formData.append('NoOfDay', 7),
		formData.append('currWeekValue', weekvalue),
	$.ajax({
	url: baseURL+"Weektemplatecont/getcalendar",
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
		
		var parts=returndb.split('@#@');
		//alert('last'+parts[0]);
		$('#lastMondy').val(parts[0]);
		$('#nextMondy').val(parts[1]);
			$('#drpWeek').empty();
		$("#drpWeek").html(parts[2]);
		//alert("get_Templastschedual :"+parts[2]);
		$('#dvTable').empty();
		$("#dvTable").html(parts[3]);
//		$('#lastMondy').val(startDate);
		}
	});//END $.ajax
}
function get_Tempnextschedual()
{
	var startDate=$('#nextMondy').val();
	//alert(startDate);
	$('#hdnNoOfDay').val(-7);	
	$('#hdncurrStartDate').val(startDate);		
	//$('#hdncurrEndDate').val(endDate);	
//alert(startDate);
var e = document.getElementById("drpWeek");
var weekvalue = e.options[0].value;
//alert(weekvalue);
	//alert(weekvalue);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),
		formData.append('NoOfDay', -7),
		formData.append('currWeekValue', weekvalue),
	//	formData.append('drpFromdate', startDate),

	$.ajax({
	url: baseURL+"Weektemplatecont/getcalendar",
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
		//var interval=$('#drpWeek');
		var parts=returndb.split('@#@');
		$('#lastMondy').val(parts[0]);

		$('#nextMondy').val(parts[1]);
	
		$('#drpWeek').empty();
		$("#drpWeek").html(parts[2]);
			//	alert("get_Tempnextschedual :"+parts[2]);
	
		$('#dvTable').empty();
		$("#dvTable").html(parts[3]);
		
	/*	for (i=1;i<=4;++i)
		{
			
		
		}
*/
		}
	});//END $.ajax
}

function copyshift()
{
	/*var fromDate=$('#lastMondy').val();
	var newDate=$('#nextMondy').val();*/
	var fromDate=$('#hdncurrStartDate').val();
	
	var interval=$('#drpWeek').val();
	//var newDate=$('#nextMondy').val();
//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', fromDate),
		formData.append('interval', interval),
		formData.append('dept_id', $('#drplstDept').val()),
	//	formData.append('drpFromdate', startDate),

	$.ajax({
	url: baseURL+"Weektemplatecont/copyshift",
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
		
		alert('Kopieren Erfolg');

		}
	});//END $.ajax
}
function drpweekdeptChange()
{
	var startDate=$('#hdncurrStartDate').val();
		//alert('hdncurrStartDate :'+startDate);
	
	/*var endDate=$('#nextMondy').val();
		alert('endDate :'+endDate);*/
var e = document.getElementById("drpWeek");
var weekvalue = e.options[0].value;
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),
		formData.append('NoOfDay', $('#hdnNoOfDay').val()),
		formData.append('currWeekValue', weekvalue)

	$.ajax({
	url: baseURL+"Weektemplatecont/getcalendar",
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
		
		var parts=returndb.split('@#@');
		/*$('#lastMondy').val(parts[0]);

		$('#nextMondy').val(parts[1]);*/
	
	/*	$('#drpWeek').empty();
		$("#drpWeek").html(parts[2]);*/
			//	alert("get_Tempnextschedual :"+parts[2]);
	
		$('#dvTable').empty();
		$("#dvTable").html(parts[3]);
		}
	});//END $.ajax
}