// JavaScript Document
var closestarttime='';
var closeendtime='';
var empstarttime='';
var empendtime='';
var openstarttime='';
var openendtime='';
var loaded=false;


var str = '';
var val0='';
var val1='';
var end='';

var ComponentsTimeSliders = function () {

    return {
        //main function to initiate the module
        init: function () {
            // basic
            $(".slider-basic").slider(); // basic sliders
			 var leftWidth =  Math.floor(((1440 - 600) / 1440) *100);
			 
			 
			 
            // range slider
            $("#slider-range").slider({
					
					
                isRTL: Metronic.isRTL(),
                range: true,
                min: ($('#txtStartSldr').val().split(":")[0] * 60),
                max:  (($('#txtStartSldr').val().split(":")[0] * 60) + 1440),
                values: [($('#txtStartSldr').val().split(":")[0] * 60) + 300, ($('#txtStartSldr').val().split(":")[0] * 60) +600],
				step: 30,
                slide: function (event, ui) {
					var minStart = parseInt($("#slider-range").slider('option', 'min') % 60);
					var hoursStart = parseInt($("#slider-range").slider('option', 'min') / 60 % 24);
					
					var minutes0 = parseInt(ui.values[0] % 60);
					var hours0 = parseInt(ui.values[0] / 60 % 24);
					var minutes1 = parseInt(ui.values[1] % 60);
					var hours1 = parseInt(ui.values[1] / 60 % 24);
					
					var minEnd = parseInt($("#slider-range").slider('option', 'max') % 60);
					var hoursEnd = parseInt($("#slider-range").slider('option', 'max') / 60 % 24);
					
					$("#spnClose").text(" Geschlossen (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
                    $("#spnEmp").text(" Offen für Mitarbeiter (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
					$("#spnOpen").text(" Offen für Kunden (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
					$("#spnClose").attr("data-starttime", hoursStart  + ':' + minStart);
					$("#spnClose").attr("data-endtime", hours0 + ':' + minutes0);
					
					$("#spnEmp").attr("data-starttime",  hours0 + ':' + minutes0);
					$("#spnEmp").attr("data-endtime", hours1 + ':' + minutes1);
					
					$("#spnOpen").attr("data-starttime",hours1 + ':' + minutes1);
					$("#spnOpen").attr("data-endtime", hoursEnd + ':' + minEnd);		
				
					leftWidth = Math.floor((((($('#txtStartSldr').val().split(":")[0] * 60) + 1440) - ui.values[1]) / 1440) * 100)
					$('#YourDiv').css('width', leftWidth +'%');
                }
            }).append('<div id="YourDiv" style="width: '+leftWidth+'%"></div>');
			
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
				
					
					str=returndb[0]['close_from'].split(':')[0] *60;
					val0 = returndb[0]['close_to'].split(':')[0] *60 ;
					if (str > val0)
					{
						
						val0= val0 + str + (1440-str);
					}
					
					val1= returndb[0]['open_emp_to'].split(':')[0] *60 ;
					if (str > val1)
					{
						//alert('hi2');
						val1= val1 + str + (1440-str);
					}
					
					end=str+ 1440; 
					$('#txtStartSldr').timepicker('setTime', new Date(00,00,00,returndb[0]['close_from'].split(':')[0],returndb[0]['close_from'].split(':')[1],00));
					
				
				
								
			}
		});//END $.ajax
			
			var minStart = parseInt($("#slider-range").slider('option', 'min') % 60);
			var hoursStart = parseInt($("#slider-range").slider('option', 'min') / 60 % 24);
			
			var minutes0 = parseInt($("#slider-range").slider("values", 0) % 60);
			var hours0 = parseInt($("#slider-range").slider("values", 0) / 60 % 24);
			var minutes1 = parseInt($("#slider-range").slider("values", 1) % 60);
			var hours1 = parseInt($("#slider-range").slider("values", 1) / 60 % 24);
			
			var minEnd = parseInt($("#slider-range").slider('option', 'max') % 60);
			var hoursEnd = parseInt($("#slider-range").slider('option', 'max') / 60 % 24);
					
			$("#spnClose").text(" Geschlossen  (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
            $("#spnEmp").text(" Offen für Mitarbeiter (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
			$("#spnOpen").text(" Offen für Kunden (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
			
			$("#spnClose").attr("data-starttime", hoursStart  + ':' + minStart);
			$("#spnClose").attr("data-endtime", hours0 + ':' + minutes0);
			
			$("#spnEmp").attr("data-starttime",  hours0 + ':' + minutes0);
			$("#spnEmp").attr("data-endtime", hours1 + ':' + minutes1);
			
			$("#spnOpen").attr("data-starttime",hours1 + ':' + minutes1);
			$("#spnOpen").attr("data-endtime", hoursEnd + ':' + minEnd);
        }

    };

}();
$(document).ready(function(){
							
    $('#txtStartSldr').change(function() {
						
	  		$("#slider-range").slider('option', 'min', ($('#txtStartSldr').val().split(":")[0] * 60))
               .slider('option', 'max', (($('#txtStartSldr').val().split(":")[0] * 60) + 1440));
			if(!loaded)
			{
			$("#slider-range").slider("values", 0, val0);
			$("#slider-range").slider("values", 1, val1);
			loaded=true;
			}
					
			var leftWidth = Math.floor( ( ( (($('#txtStartSldr').val().split(":")[0] * 60) + 1440) - $("#slider-range").slider("values", 1)) / 1440)* 100);
			
			$('#YourDiv').css('width', leftWidth +'%');
			
			var minStart = parseInt($("#slider-range").slider('option', 'min') % 60);
			var hoursStart = parseInt($("#slider-range").slider('option', 'min') / 60 % 24);
					
			var minutes0 = parseInt($("#slider-range").slider("values", 0) % 60);
			var hours0 = parseInt($("#slider-range").slider("values", 0) / 60 % 24);
			var minutes1 = parseInt($("#slider-range").slider("values", 1) % 60);
			var hours1 = parseInt($("#slider-range").slider("values", 1) / 60 % 24);
			
			var minEnd = parseInt($("#slider-range").slider('option', 'max') % 60);
			var hoursEnd = parseInt($("#slider-range").slider('option', 'max') / 60 % 24);
			
			$("#spnClose").text(" Geschlossen  (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
            $("#spnEmp").text(" Offen für Mitarbeiter (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
			$("#spnOpen").text(" Offen für Kunden(" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
			/*alert("spnClose : "+hoursStart  + ':' + minStart)
			alert("spnClose : "+hours0  + ':' + minutes0)*/
			$("#spnClose").attr("data-starttime", hoursStart  + ':' + minStart);
			$("#spnClose").attr("data-endtime", hours0 + ':' + minutes0);
			
			$("#spnEmp").attr("data-starttime",  hours0 + ':' + minutes0);
			$("#spnEmp").attr("data-endtime", hours1 + ':' + minutes1);
			
			$("#spnOpen").attr("data-starttime",hours1 + ':' + minutes1);
			$("#spnOpen").attr("data-endtime", hoursEnd + ':' + minEnd);
			
			
			
	});
});
function editColorSetting()
{


	closestarttime=$("#spnClose").attr("data-starttime");
	closeendtime=$("#spnClose").attr("data-endtime");
	empstarttime=$("#spnEmp").attr("data-starttime");
	empendtime=$("#spnEmp").attr("data-endtime");
	openstarttime=$("#spnOpen").attr("data-starttime");
	openendtime=$("#spnOpen").attr("data-endtime");

	endtime1=$("#spnEmp").attr("data-endtime");
	
	
	endtime=$("#spnOpen").attr("data-endtime");
			
var formData = new FormData();
				formData.append('txtclose_from'        , closestarttime);
				formData.append('txtclose_to'		 , closeendtime);
				formData.append('txtopen_emp_from'		,empstarttime);
				formData.append('txtopen_emp_to'		, empendtime);
				formData.append('txtopen_from'		, openstarttime);
				formData.append('txtopen_to'	    ,  openendtime);
				
	
	$.ajax({
		url: baseURL+"Settingcont/update_colorsetting" ,
			//url: baseURL+"Shiftcont/"+action,
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
				
			
				var success = $('.alert-success', $("#SettingColorForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				
								
			}
		});//END $.ajax

}
