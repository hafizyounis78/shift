
var str = '';
var val0='';
var val1='';
var end='';
var img='';

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
						  jQuery('#event_box').html('');
						  for(var a=0; a< returndb.length; a++){
							  
							  var html = $('<div class="external-event label label-default col-md-10" style=" background-color:#069" ondblclick="delShiftTemp(' + returndb[a]['id'] + ');"><span id="dvName">' 
										    + returndb[a]['txtName'] + 
										   '</span><br/><span id="dvStart">' + returndb[a]['txtStart'] + '</span> - <span id="dvEnd">'
										    + returndb[a]['txtEnd'] +
											'</span><i style="font-size:12px" class="fa fa-coffee" aria-hidden="true"></i> <span id="dvBreak">' 
											+ returndb[a]['txtBreak'] +'</span> min</div>');
							jQuery('#event_box').append(html);
							initDrag(html);
							  
						 }//END FOR
						  
						 
					  }
				});//END $.ajax
			
			addEvent("My Event 1");

			
           $('#calendar').fullCalendar('destroy'); // destroy the calendar
		   /**************************************/
		   /*
		   var w = $('#calendar').css('width');
			var renderEvent = function() {
				// prepare calendar for printing
				$('#calendar').css('width', w);
				$('#calendar').fullCalendar('render');
			};
			if (window.matchMedia) {
				var mediaQueryList = window.matchMedia('print');
				mediaQueryList.addListener(function(mql) {
					if (mql.matches) {
						renderEvent();
					} else {
						renderEvent();
					}
				});
			}
			window.onbeforeprint = renderEvent;
			window.onafterprint = renderEvent;
			$(window).resize(function(){$('#calendar').css('width', '100%');});*/
//***************************//
            $('#calendar').fullCalendar({ //re-initialize the calendar
                header: h,
				 height: 1100,
		        contentHeight: 1100,
                defaultView: 'agendaWeek', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
                slotMinutes: 15,
				minTime: "05:00:00",
				//maxTime: "04:00:00",
                editable: true,
				eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!
                dow: [ 1, 2, 3, 4 ],
				selectable: true,
				selectHelper: true,
				select: function(start, end) {
				  if (sessionValue =='gm')
				   {
				//	alert(222);
					var view = $('#calendar').fullCalendar('getView');
					//alert(view.name);
					  var startdate = start.format().toString();
						 var startdateParts = startdate.split("-");
						
					 var endstr = end.format().toString();
						 var dateParts = endstr.split("-");
						  var Startate = startdateParts[2];
							var Enddate = dateParts[2]-1;
					if (Enddate<=0)
					Enddate=Startate;

					if (view.name =='month')
					{
						if (Startate==Enddate)
						 {
							 $('#calendar').fullCalendar('changeView', 'agendaDay')
							 $('#calendar').fullCalendar('gotoDate', start.format());
							 return;
						 }
					}
						 $("#form_modal2").modal();	
						 $("#drpFromdate").val('');
						 $("#drpTodate").val('');
						
						/*  var startdate = start.format().toString();
						 var startdateParts = startdate.split("-");*/
						
						 if (startdateParts[2].toString().length>2)
						 {	//alert(startdateParts[2].toString());	
							 var strattime=startdateParts[2].substring(3,8);
							//alert(strattime);	
							  startdateParts[2]=startdateParts[2].substring(0, 2);
							 $("#drpFromdate").val(startdateParts[0]+'-'+startdateParts[1]+'-'+startdateParts[2]); 
							 //*****start time*********//
							$('#txtStart').timepicker('setTime', strattime);
							
						 }
						 else
						  $("#drpFromdate").val(start.format());
										 
						/* var endstr = end.format().toString();
						 var dateParts = endstr.split("-");*/
						if (dateParts[2].length>2)
						{	
							
							var enddate=dateParts[2].substring(0, 2)
							var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), enddate);
							var endDay = dateOfEnd.getDate();
							 var endtime=dateParts[2].substring(3,8);
						 
							 $('#txtEnd').timepicker('setTime', endtime);
						
						}
						 else
						 {
							 var dateOfEnd = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
							 var endDay = dateOfEnd.getDate() - 1;
						 }
						
						 if(endDay >=1 && endDay<=9)
							endDay = "0"+endDay;
							
					
						 $("#drpTodate").val(dateParts[0]+'-'+dateParts[1]+'-'+endDay);
						 $("#my_multi_select1").html('');
						 $("#my_multi_select1").multiSelect('refresh');
						 
						 $( "#drplstBreak" ).val(0);			
						
						
						$("#drplstDept").val($("#drplstfilterByDept").val());
						
						drpdeptFullChange();
						 
						$('#calendar').fullCalendar('unselect');
				   }
			},
				drop: function(date, allDay) { // this function is called when something is dropped
				//var sessionValue  =" <?php echo json_encode($this->session->userdata('itemname')); ?>"; 
				//alert(sessionValue);
				if (sessionValue=='gm')
				{
                   /* // retrieve the dropped element's stored Event Object
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
					*/
					// Open Modal
					//alert(555);
					
					/*if(view.name === 'agendaWeek' || view.name === 'agendaDay')
					{
					}*/
					$("#form_modal2").modal();
					var d = new Date(date);
					
					var day = d.getDate();
					var month = d.getMonth()+1;
					var year = d.getFullYear();
					$( "#txtStart" ).timepicker( "setTime", $(this).find("#dvStart").text() );
					$( "#txtEnd" ).timepicker( "setTime", $(this).find("#dvEnd").text() );
					$( "#drplstBreak" ).val( $(this).find("#dvBreak").text() );
//					$( "#drplstBreak" ).val( $(this).find("#dvBreak").text() );

					$( "#drpFromdate" ).datepicker( "setDate", year+"-"+month+"-"+day );
					$( "#drpTodate" ).datepicker( "setDate", year+"-"+month+"-"+day );
					$("#my_multi_select1").html('');
						 $("#my_multi_select1").multiSelect('refresh');
						
						
						
						$("#drplstDept").val($("#drplstfilterByDept").val());
						
						drpdeptFullChange();

					
				}
                },
				dayClick: function(date, jsEvent, view) {
					//alert('Date: ' + date.format());

			
				
				
				  if(view.name != 'month')
					return;
				  else
				   {
				  /* $('#calendar').fullCalendar('changeView', 'agendaDay')
					$('#calendar').fullCalendar('gotoDate', date.format());*/
				   }
				},
				
				eventRender: function (event, element) {
					$('.popover').popover('hide');
					element.popover({
				            title: "Einzelheiten",
				            placement:'left',
							container:'body',
				            html:true,
				            content: event.msg
                        });
				element.find('.fc-time').after('<span style="font-size:12px" class="fa fa-coffee"></span> ');
				//alert(img);
				element.find('.fc-time').after(event.imageurl);
				 element.bind('dblclick', function() {
         				
							//*******************************//
						
				//	alert(event.locationId);
						getmodalemployee(event.locationId,event.txtstart,event.txtend,event.starttime, event.endtime,event.empList);
						$("#hdnaction").val('updateshiftFromCalander');
						
							 
							$("#form_modal2").modal();	
							$('#drpFromdate').datepicker('setDate', event.txtstart );
							 $('#drpTodate').datepicker('setDate', event.txtend );
						   
							$('#txtStart').timepicker('setTime',event.starttime);
							$('#txtEnd').timepicker('setTime',event.endtime);
							$("#drpLocation").val(event.locationId);
							$("#drplstDept").val(0);
							//***********fill hdn field********//
							$('#hdnFromdate').val(event.txtstart );
							$('#hdnTodate').val(event.txtend );
						   	$('#hdnStarttime').val(event.starttime);
							$('#hdnEndtime').val(event.endtime);
							$("#hdnLocation").val(event.locationId);
							
				/*$.ajax({
					url: baseURL+"Fullschedulecont/getshiftdata" ,
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
							$("#hdnaction").val('updateShift');
							$("#form_modal2").modal();	
						    $("#drpFromdate").val(startdate );
						    $("#drpTodate").val(enddate);
							$('#txtStart').timepicker('setTime',event.starttime);
							$('#txtEnd').timepicker('setTime',event.endtime);
							
							
					}*/
					//});//END $.ajax
//****************************************//
						
											
						// change the border color just for fun
						$(this).css('border-color', 'red');
			      });
				},
				/*eventAfterRender: function(event, element, view) 
				  {
					  $(element).css('height','100');
					  $(element).css('width','100');
				  },*/
					eventDrop: function(event, delta, revertFunc) {
				
							revertFunc();
						
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
							
						
//								if(convertTime($(this).children().text())!=0)
								if($(this).children().text()!=0)
									//masterrec=convertTime($(this).children().text());
									masterrec=$(this).children().text();
								else	
								 {
								 }
								
								if(masterrec>= str || masterrec< val0)
									$(this).css('background-color', '#ffe6e6');									
								else if(masterrec >= val0 && masterrec< val1)
									$(this).css('background-color', '#ffffcc');
								else if(masterrec >=val1 && masterrec <= end)
								$(this).css('background-color', '#e6ffcc');

																					 
						});
					 }, 500);
					}
					
					
				},
				
							
                events: function(start, end, timezone, callback){
						
					//************ read segment value *********//
					var segment_4 ='';
					var dept_id=0;
					var action="getall_Shift_calender";
					/*var newURL = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;
					var pathArray = window.location.pathname.split( '/' );
					*/
					dept_id=$("#drplstfilterByDept").val();
					
					/*if (pathArray[4]!=null)
					  {
					  	segment_4 =pathArray[4] ;
						action="getmy_Shift_calender";
					  }
			*/
						$.ajax({
    						url: baseURL+"Fullschedulecont/"+action,
    						type: "POST",
							data:{segment_4:segment_4,dept_id:dept_id },
    						success:function(retrieved_data){
         					// Your code here.. use something like this
							var arr = [{title: 'All Day Event',
                    		 start: new Date(y, m, 1),
                    			backgroundColor: Metronic.getBrandColor('yellow')
                			}];
							/*var style = $('<style>@media print {.fc-event { background: green; }</style>')
							$('html > head').append(style);*/
							// Since your controller produce array of object you can access the value by using this one :
         					var events = [];
							for(var a=0; a< retrieved_data.length; a++)
								{
									img='';
									var startdateParts = retrieved_data[a]['start_date'].split("-");
									var enddateParts = retrieved_data[a]['end_date'].split("-");
									var starttimeParts = retrieved_data[a]['start_time'].split(":");
									var endtimeParts = retrieved_data[a]['end_time'].split(":");
									
									if (retrieved_data[a]['Special_shift']==1)
										img='<span style="font-size:12px" class="fa fa-star"></span>';
									else
										img='';
										
										
         						events.push({
//											title:retrieved_data[a]['title']+retrieved_data[a]['event_details'],
											//title:'<span><i style="font-size:12px" class="fa fa-coffee" aria-hidden="true"></i></span>'+retrieved_data[a]['lunch_break']+'<br/>'+retrieved_data[a]['title'],
											title:retrieved_data[a]['title'],
											msg: retrieved_data[a]['event_details'],
											start:new Date(startdateParts[0], parseInt(startdateParts[1] - 1), startdateParts[2], starttimeParts[0], starttimeParts[1]),//:retrieved_data[a]['start_date'],
											end: new Date(enddateParts[0], parseInt(enddateParts[1] - 1), enddateParts[2],  endtimeParts[0], endtimeParts[1]),
											backgroundColor: retrieved_data[a]['color'],
											txtstart:retrieved_data[a]['start_date'],
											txtend:retrieved_data[a]['end_date'],
											starttime:retrieved_data[a]['start_time'],
											endtime:retrieved_data[a]['end_time'],
											locationId:retrieved_data[a]['location_id'],
											empList:retrieved_data[a]['empList'],
											imageurl:img,
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
	{	 
		AMPM = time.substring(2, 4);
		hours =time.substring(0, 2);
	}
	else if (time.length==3)
	{	
		AMPM = time.substring(1, 3);
		hours =time.substring(0, 1);
	}
	if(AMPM == "pm" && hours<12) hours =  parseInt(hours)+12;
	if(AMPM == "am" && hours==12) hours = parseInt(hours)-12;
	var sHours = hours.toString();
	
	if(hours<10) sHours = "0" + sHours;
	
	return parseInt(sHours);
}
function delShiftTemp(shiftTempId)
{
	var x='';
	var r = confirm('This record will be deleted. Do you want to continue?');
	
	if (r == true) 
		x =1;
	else 
		x = 0;
	
	if(x==1)
	{
		$.ajax({
			  url: baseURL+"Fullschedulecont/deleteShiftTemp",
			  type: "POST",
			  data:  {shiftTempId:shiftTempId},
			  error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				  alert(xhr.responseText);
			  },
			  beforeSend: function(){},
			  complete: function(){},
			  success: function(returndb){
				  /*alert(returndb);
				alert(returndb[0]);
				alert(returndb[0]['txtName']);*/
               jQuery('#event_box').html('');
			   var el='';
			  for(var a=0; a< returndb.length; a++){
							  
				   el = $('<div class="external-event label label-default col-md-10" style=" background-color:#069" ondblclick="delShiftTemp(' + returndb[a]['id'] + ');"><span id="dvName">' 
								+ returndb[a]['txtName'] + 
							   '</span><br/><span id="dvStart">' + returndb[a]['txtStart'] + '</span> - <span id="dvEnd">'
								+ returndb[a]['txtEnd'] +
								'</span><i style="font-size:12px" class="fa fa-coffee" aria-hidden="true"></i> <span id="dvBreak">' 
								+ returndb[a]['txtBreak'] +'</span> min</div>');
				jQuery('#event_box').append(el);
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
				  
						}//END FOR	
				//--initDrag;
				alert('Delete shift Templete success');
				
			}
				 
			  
		});//END $.ajax
	}
}
//----

$(document).ready(function(){
	
	$('#drplstfilterByDept').change(function(event) {							
		event.preventDefault();
		
		Calendar.initCalendar();
	
	}); // END ON CHANGE

})// END DOCUMENT
