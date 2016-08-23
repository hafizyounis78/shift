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

		}
	});//END $.ajax
}
function get_nextschedual()
{
	var startDate=$('#nextMondy').val();

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
		$('#lastMondy').val(parts[0]);
		$('#nextMondy').val(parts[1]);
		$('#dvTable').empty();
		$("#dvTable").html(parts[2]);

		}
	});//END $.ajax
}

function printcal()
{
	
	var path=baseURL+'calrepcont/calrep';
	var targetWin = window.open(path,'mypopup','width=400,height=400,scrollbars=yes');
	setTimeout(function(){
	 targetWin.print();
	},500);
}
function creatreport()
{ 

	$.ajax({
		url: baseURL+"Reportscont/creatreport",
		type: "POST",
		error: function(xhr, status, error) {
			alert(xhr.responseText);
		},
		success: function(returndb){
			alert('Done');
			}
		});//END $.ajax

	
	
}