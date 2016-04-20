// JavaScript Document

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
				var html = $('<div class="external-event label label-default">' + $("#txtName").val() + 
							'<br/>' + $("#txtFrom").val() + ' - '+ $("#txtTo").val() +
							' <i class="fa fa-coffee" aria-hidden="true"></i>' + $("#drpBreak option:selected").text() +'</div>');
				jQuery('#event_box').append(html);
                initDrag(html);
				
				/*var success = $('.alert-success', $("#locationForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				clearForm();*/
				//success.hide();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	
}
