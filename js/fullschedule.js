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
				
                var el = $('<div class="external-event label label-default col-md-12">' + $("#txtName").val() + 
							' <br/>' + $("#txtFrom").val() + ' - '+ $("#txtTo").val() +
							' <i class="fa fa-coffee" aria-hidden="true"></i> ' + $("#drpBreak option:selected").text() +' min</div>');
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
