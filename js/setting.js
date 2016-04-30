// JavaScript Document
var starttime='';
var endtime0='';
var endtime1='';
var endtime='';

var ComponentsTimeSliders = function () {

    return {
        //main function to initiate the module
        init: function () {
            // basic
            $(".slider-basic").slider(); // basic sliders
			 var leftWidth =  Math.floor(((1440 - 600) / 1440) *100);
			 
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
				
//					alert(returndb.length);
					returndb[0].close_from
					returndb[0].close_to
					returndb[0].open_emp_from
					returndb[0].open_emp_to
					returndb[0].open_from
					returndb[0].open_to
				var success = $('.alert-success', $("#SettingColorForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				
								
			}
		});//END $.ajax
			 
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
					
					$("#spnClose").text(" Close (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
                    $("#spnEmp").text(" Open for Employee (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
					$("#spnOpen").text(" Open for Customers (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
					
				/*	$("#spnClose").attr("data-starttime", hoursStart  + ':' + minStart);
					$("#spnClose").attr("data-endtime", hours0 + ':' + minutes0);
					
					$("#spnEmp").attr("data-starttime",  hours0 + ':' + minutes0);
					$("#spnEmp").attr("data-endtime", hours1 + ':' + minutes1);
					
					$("#spnOpen").attr("data-starttime",hours1 + ':' + minutes1);
					$("#spnOpen").attr("data-endtime", hoursEnd + ':' + minEnd);*/
					
					//alert(ui.values[0]+ ui.values[1]);
					leftWidth = Math.floor((((($('#txtStartSldr').val().split(":")[0] * 60) + 1440) - ui.values[1]) / 1440) * 100)
					$('#YourDiv').css('width', leftWidth +'%');
                }
            }).append('<div id="YourDiv" style="width: '+leftWidth+'%"></div>');
			
			var minStart = parseInt($("#slider-range").slider('option', 'min') % 60);
			var hoursStart = parseInt($("#slider-range").slider('option', 'min') / 60 % 24);
			
			var minutes0 = parseInt($("#slider-range").slider("values", 0) % 60);
			var hours0 = parseInt($("#slider-range").slider("values", 0) / 60 % 24);
			var minutes1 = parseInt($("#slider-range").slider("values", 1) % 60);
			var hours1 = parseInt($("#slider-range").slider("values", 1) / 60 % 24);
			
			var minEnd = parseInt($("#slider-range").slider('option', 'max') % 60);
			var hoursEnd = parseInt($("#slider-range").slider('option', 'max') / 60 % 24);
					
			$("#spnClose").text(" Close  (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
            $("#spnEmp").text(" Open for Employee (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
			$("#spnOpen").text(" Open for Customers (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
			
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
			
			$("#spnClose").text(" Close  (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
            $("#spnEmp").text(" Open for Employee (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
			$("#spnOpen").text(" Open for Customers (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
			
			$("#spnClose").attr("data-starttime", hoursStart  + ':' + minStart);
			$("#spnClose").attr("data-endtime", hours0 + ':' + minutes0);
			
			$("#spnEmp").attr("data-starttime",  hours0 + ':' + minutes0);
			$("#spnEmp").attr("data-endtime", hours1 + ':' + minutes1);
			
			$("#spnOpen").attr("data-starttime",hours1 + ':' + minutes1);
			$("#spnOpen").attr("data-endtime", hoursEnd + ':' + minEnd);
			/*starttime=hoursStart+ ':' + minStart;
			endtime0=hours0 + ':' + minutes0;
			endtime1=hours1 + ':' + minutes1;
			endtime=hoursEnd + ':' + minEnd;*/
			
			
	});
});
function editColorSetting()
{
	starttime=$("#spnClose").attr("data-starttime");
	endtime0=$("#spnClose").attr("data-endtime");
	
	//$("#spnEmp").attr("data-starttime");
	endtime1=$("#spnEmp").attr("data-endtime");
	
	//$("#spnOpen").attr("data-starttime");
	endtime=$("#spnOpen").attr("data-endtime");
	
	alert("starttime : "+starttime+" endtime0 : "+endtime0+"\n starttime1 : "+endtime0+" endtime1 : "+endtime1+"\n starttime2 : "+endtime1+" endtime: "+endtime);
			
var formData = new FormData();
				formData.append('txtclose_from'        , starttime);
				formData.append('txtclose_to'		 , endtime0);
				formData.append('txtopen_emp_from'		,endtime0);
				formData.append('txtopen_emp_to'		, endtime1);
				formData.append('txtopen_from'		, endtime1);
				formData.append('txtopen_to'	    ,  endtime);
				
	
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
