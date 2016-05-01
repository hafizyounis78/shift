
var str = '';
var val0='';
var val1='';
var end='';

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
				//alert('hi');
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
				
               /* title = title.length === 0 ? "Untitled Event" : title;
                var html = $('<div class="external-event label label-default">' + title + '</div>');
                jQuery('#event_box').append(html);
                initDrag(html);*/
				
				
				
            };

            $('#external-events div.external-event').each(function() {
                initDrag($(this));
            });

            $('#event_add').unbind('click').click(function() {
                var title = $('#event_title').val();
                addEvent(title);
            });
			
			var i =0;
					$('.fc-slats > table > tbody  > tr').each(function() {
							
							alert(i++);
							//alert($('.fc-slats > table > tbody  > tr').closest('td').html());
															 
					});
					

            //predefined events
            $('#event_box').html("");
            
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
						  
						  for(var a=0; a< returndb.length; a++){
							  
							  var html = $('<div class="external-event label label-default col-md-12"><span id="dvName">' 
										    + returndb[a]['txtName'] + 
										   '</span><br/><span id="dvStart">' + returndb[a]['txtStart'] + '</span> - <span id="dvEnd">'
										    + returndb[a]['txtEnd'] +
											'</span><i class="fa fa-coffee" aria-hidden="true"></i> <span id="dvBreak">' 
											+ returndb[a]['txtBreak'] +'</span> min</div>');
							jQuery('#event_box').append(html);
							initDrag(html);
							  
						 }//END FOR
						  
						 
					  }
				});//END $.ajax
			
			addEvent("My Event 1");
           /* addEvent("My Event 2");
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
				//alert(dateParts[2]);
				if (dateParts[2].length>2)
				{	dateParts[2]=dateParts[2].substring(0, 2)
				
				 	var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
				 	var endDay = dateOfEnd.getDate();
				}
				 else
				 {
					 var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
					 var endDay = dateOfEnd.getDate() - 1;
				 }
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
					
					// Open Modal
					$("#form_modal2").modal();
					var d = new Date(date);
					
					var day = d.getDate();
					var month = d.getMonth()+1;
					var year = d.getFullYear();
					
					$( "#txtStart" ).timepicker( "setTime", $(this).find("#dvStart").text() );
					$( "#txtEnd" ).timepicker( "setTime", $(this).find("#dvEnd").text() );
					$( "#drplstBreak" ).val( $(this).find("#dvBreak").text() );
					$( "#drpFromdate" ).datepicker( "setDate", year+"-"+month+"-"+day );
					$( "#drpTodate" ).datepicker( "setDate", year+"-"+month+"-"+day );
					
                },
				dayClick: function(date, jsEvent, view, resourceObj) {
					alert('Date: ' + date.format());
					alert('Resource ID: ' + resourceObj.id);
			
				},
				eventRender: function (event, element) {
					/*element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px;background-color: red">'+event.description+'</span></div>');
					element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px;background-color: red">'+event.description+'</span></div>');*/
					$('.popover').popover('hide');
					element.popover({
				            title: "Employee",
				            placement:'left',
							container:'body',
				            html:true,
				            content: event.msg
                        });
				},
				viewRender: function(view, element) 
				{
					
					if(view.name === 'agendaWeek' || view.name === 'agendaDay')
					{
						$.ajax({
							url: baseURL+"Settingcont/get_colorsetting" ,
							type: "POST",
							error: function(xhr, status, error) {
							//var err = eval("(" + xhr.responseText + ")");
							alert(xhr.responseText);
							},
							beforeSend: function(){},
							complete: function(){},
							success: function(returndb){
								str=parseInt(returndb[0]['close_from'].split(':')[0]);
								val0 =parseInt( returndb[0]['close_to'].split(':')[0]) ;
								val1= parseInt(returndb[0]['open_emp_to'].split(':')[0]);
								end=parseInt(returndb[0]['open_to'].split(':')[0]); 
							}
						});//END $.ajax
			
						var masterrec='';
						setTimeout(function(){ 
						$('.fc-slats > table > tbody  > tr').each(function() {
							
						
								if(convertTime($(this).children().text())!=0)
									masterrec=convertTime($(this).children().text());
								else	
								 {
								 }

								if(masterrec>= str || masterrec<= val0)
									$(this).css('background-color', '#e6ffcc');
								else if(masterrec > val0 && masterrec<= val1)
									$(this).css('background-color', '#ffffcc');
								else if(masterrec >val1 && masterrec <= end)
									$(this).css('background-color', '#ffe6e6');
																					 
						});
					 }, 200);
					}
					
					
				},
				/*eventClick: function(event, jsEvent, view) {
					$this = $(this);
					$this.popover({
				            title: "My Title",
				            placement:'top',
							container:'body',
							html:true,
				            content: event.msg
                        });
					return false;            
				}, */
                events: function(start, end, timezone, callback){
						//var hall = document.getElementById('w_code').value;
//						var baseurl = "<?php echo base_url(); ?>";
						$.ajax({
    						url: baseURL+"Fullschedulecont/getall_Shift_calender",
    						type: "POST",
							data:{ },
//							data: {hall:hall},
    						success:function(retrieved_data){
         					// Your code here.. use something like this
							//alert(retrieved_data.length);
         					//var Obj = JSON.parse(retrieved_data);
//							alert(retrieved_data[0]['start_time']);
							var arr = [{title: 'All Day Event',
                    		 start: new Date(y, m, 1),
                    			backgroundColor: Metronic.getBrandColor('yellow')
                			}];
							//alert(arr[0]['start']);
							
         					// Since your controller produce array of object you can access the value by using this one :
         					var events = [];
							for(var a=0; a< retrieved_data.length; a++)
								{
									//alert(retrieved_data[a]['start_date'])
									var startdateParts = retrieved_data[a]['start_date'].split("-");
									var enddateParts = retrieved_data[a]['end_date'].split("-");
									var starttimeParts = retrieved_data[a]['start_time'].split(":");
									var endtimeParts = retrieved_data[a]['end_time'].split(":");
									
									
         						events.push({
											title:retrieved_data[a]['title'],
											msg: retrieved_data[a]['event_details'],
											start:new Date(startdateParts[0], parseInt(startdateParts[1] - 1), startdateParts[2], starttimeParts[0], starttimeParts[1]),//:retrieved_data[a]['start_date'],
											end: new Date(enddateParts[0], parseInt(enddateParts[1] - 1), enddateParts[2],  endtimeParts[0], endtimeParts[1]),
											backgroundColor: retrieved_data[a]['color'],
											allDay: false
											
											});
							}//END FOR
							
							callback(events);
    					} //END SUCCESS
						
					});//END AJAX
						
					
					
				},//END FUN EVENT
            });

        }

    };

}();
function convertTime(timeParam)
{
	var time = timeParam;
	var hours='';
	var AMPM='';
	if (time.length==4)
	{	 AMPM = time.substring(2, 4);
	//alert("time.length= " + time.length);
		hours =time.substring(0, 2);
	}
	else if (time.length==3)
	{	AMPM = time.substring(1, 3);
	//alert("time.length= " + time.length);
		hours =time.substring(0, 1);
	}
//alert("hours  "+hours);
//var minutes = Number(time.match(/:(\d+)/)[1]);
//;2var AMPM = time.match(/\s(.*)$/)[1];


//alert(AMPM);
if(AMPM == "pm" && hours<12) hours =  parseInt(hours)+12;
if(AMPM == "am" && hours==12) hours = parseInt(hours)-12;
var sHours = hours.toString();
//var sMinutes = minutes.toString();
if(hours<10) sHours = "0" + sHours;
//if(minutes<10) sMinutes = "0" + sMinutes;
//alert(sHours);
return parseInt(sHours);
}