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

	$('#btnShiftSave').click(function(event) {							
		event.preventDefault();
		
		//if ($("#hdnId").val() == '')
			var action = "addShift";
	/*	else
			var action = "updateTimeoff";*/
			/*if (document.getElementById('rdStatus').checked) {
				  var status_value = document.getElementById('rdStatus').value;
				}
				alert(status_value);*/
			var formData = new FormData();
	
				formData.append('rdShifttype'        ,  $("input[name=rdShifttype]:checked").val());
				formData.append('drpLocation'		 ,  $("#drpLocation").val());
				formData.append('drpFromdate'		 ,  $("#drpFromdate").val());
				formData.append('drpTodate'	         ,  $("#drpTodate").val());
				formData.append('txtStart'	         ,  $("#txtStart").val());
				formData.append('txtEnd'	         ,  $("#txtEnd").val());
				formData.append('drplstBreak'	     ,  $("#drplstBreak").val());
				formData.append('drplstDept'	     ,  $("#drplstDept").val());
				formData.append('rdStatus'           ,  $("input[name=rdStatus]:checked").val());
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
				clearForm();
				 //$('#calendar').fullCalendar('initCalendar');
				 location.reload();
				//success.hide();
				/*$('#dvConstSuccessMsg').attr('class', 'alert alert-success');
				$('#tbLocations').html(returndb);
				if (action == 'addconstants')
					$('#txtConstantName').val('');*/
			}
		});//END $.ajax
	}); // END CLICK
	
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





