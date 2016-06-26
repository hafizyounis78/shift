function get_lastschedual()
{
	var startDate=$('#lastMondy').val();
		//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),

	$.ajax({
	url: baseURL+"Reportscont/getcalendar",
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
//alert(startDate);
	var formData = new FormData();
		formData.append('drpFromdate', startDate),
	//	formData.append('drpFromdate', startDate),

	$.ajax({
	url: baseURL+"Reportscont/getcalendar",
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