var Calendar = function() {


    return {
        //main function to initiate the module
        init: function() {
            Calendar.initCalendar();
        },

        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};

            if (Metronic.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        right: 'title, prev, next',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        right: 'title',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today, prev,next'
                    };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        left: 'title, prev, next',
                        center: '',
                        right: 'today,month,agendaWeek,agendaDay'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month,agendaWeek,agendaDay'
                    };
                }
            }

            var initDrag = function(el) {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
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
            };

            var addEvent = function(title) {
				
                title = title.length === 0 ? "Untitled Event" : title;
                var html = $('<div class="external-event label label-default">' + title + '</div>');
                jQuery('#event_box').append(html);
                initDrag(html);
				
				
            };

            $('#external-events div.external-event').each(function() {
                initDrag($(this));
            });

            $('#event_add').unbind('click').click(function() {
                var title = $('#event_title').val();
                addEvent(title);
            });

            //predefined events
            $('#event_box').html("");
            
			
			
			/*addEvent("My Event 1");
            addEvent("My Event 2");
            addEvent("My Event 3");
            addEvent("My Event 4");
            addEvent("My Event 5");
            addEvent("My Event 6");*/
			
            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                header: h,
                defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
                slotMinutes: 15,
                editable: true,
				eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!
                dow: [ 1, 2, 3, 4 ],
				selectable: true,
				selectHelper: true,
				select: function(start, end) {
				 $("#form_modal2").modal();	
				 $("#drpFromdate").val('');
 				 $("#drpTodate").val('');
				 var endstr = end.format().toString();
				 var dateParts = endstr.split("-");
				
				 var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
				 var endDay = dateOfEnd.getDate() - 1;
				 if(endDay >=1 && endDay<=9)
				 	endDay = "0"+endDay;
					
				
				 $("#drpTodate").val(dateParts[0]+'-'+dateParts[1]+'-'+endDay);
				 $("#drpFromdate").val(start.format());
				
				/*var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}*/
				$('#calendar').fullCalendar('unselect');
			},
				drop: function(date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.className = $(this).attr("data-class");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
				dayClick: function(date, jsEvent, view, resourceObj) {
					alert('Date: ' + date.format());
					alert('Resource ID: ' + resourceObj.id);
			
				},
                events: function(start, end, timezone, callback){
						/*var hall = document.getElementById('w_code').value;
//						var baseurl = "<?php echo base_url(); ?>";
						$.ajax({
    						url: baseURL+"pages/booking_calender",
    						type: "POST",
							data: {hall:hall},
    						success:function(retrieved_data){
         					// Your code here.. use something like this
							//alert(retrieved_data.length);
         					//var Obj = JSON.parse(retrieved_data);
							
							var arr = [{title: 'All Day Event',
                    		 start: new Date(y, m, 1),
                    			backgroundColor: Metronic.getBrandColor('yellow')
                			}];
							//alert(arr[0]['start']);
							
         					// Since your controller produce array of object you can access the value by using this one :
         					var events = [];
							for(var a=0; a< retrieved_data.length; a++){
              				//	alert("the value with id : " + retrieved_data[a]['title'] + "is " + retrieved_data[a]['start']);
         						events.push({
											title:retrieved_data[a]['title'],
											start:retrieved_data[a]['start'],
											url:retrieved_data[a]['url'],
											textColor:retrieved_data[a]['textColor'],
											backgroundColor:Metronic.getBrandColor(retrieved_data[a]['backgroundColor'])
											});
							}//END FOR
							
							callback(events);
    					} //END SUCCESS
						
					});//END AJAX*/
						
					$.ajax({
					  url: baseURL+"Fullschedulecont/getfullschedule",
					  type: "POST",
					  data:  {},
					  error: function(xhr, status, error) {
						  //var err = eval("(" + xhr.responseText + ")");
						  alert(xhr.responseText);
					  },
					  beforeSend: function(){},
					  complete: function(){},
					  success: function(returndb){
						  jQuery('#event_box').append(returndb);
						  initDrag(returndb);
						  
						 
					  }
					  });//END $.ajax
					
				},//END FUN EVENT
            });

        }

    };

}();