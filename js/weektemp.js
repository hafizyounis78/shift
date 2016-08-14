function get_lastschedual()
{
	var startDate=$('#lastMondy').val();
	//var endDate=$('#nextMondy').val();
	$('#hdncurrStartDate').val(startDate);		
	//$('#hdncurrEndDate').val(endDate);		
		//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),
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
		$('#dvTable').empty();
		$("#dvTable").html(parts[2]);
//		$('#lastMondy').val(startDate);
		}
	});//END $.ajax
}
function get_nextschedual()
{
	var startDate=$('#nextMondy').val();
	
	$('#hdncurrStartDate').val(startDate);		
	//$('#hdncurrEndDate').val(endDate);	
//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),
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
		
		var parts=returndb.split('@#@');
		$('#lastMondy').val(parts[0]);
		$('#nextMondy').val(parts[1]);
		$('#dvTable').empty();
		$("#dvTable").html(parts[2]);

		}
	});//END $.ajax
}

function copyshift()
{
	/*var fromDate=$('#lastMondy').val();
	var newDate=$('#nextMondy').val();*/
	var fromDate=$('#hdncurrStartDate').val();
	//var newDate=$('#nextMondy').val();
//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', fromDate),
		//formData.append('drpNewdate', newDate),
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
		
		alert('Copy Success');

		}
	});//END $.ajax
}
function drpweekdeptChange()
{
	var startDate=$('#hdncurrStartDate').val();
		//alert('hdncurrStartDate :'+startDate);
	
	/*var endDate=$('#nextMondy').val();
		alert('endDate :'+endDate);*/

	var formData = new FormData();
		formData.append('drpFromdate', startDate),
		formData.append('dept_id', $('#drplstDept').val()),

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
		//$('#lastMondy').val(parts[0]);
		//$('#nextMondy').val(parts[1]);
		$('#dvTable').empty();
		$("#dvTable").html(parts[2]);
//		$('#lastMondy').val(startDate);
		}
	});//END $.ajax
}