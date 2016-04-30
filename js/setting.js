// JavaScript Document
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
					
					$("#spnClose").text(" Close (" + hoursStart + ':' + minStart+ " - " + hours0 + ':' + minutes0+") ");
                    $("#spnEmp").text(" Open for Employee (" + hours0 + ':' + minutes0+ " - " + hours1 + ':' + minutes1+") ");
					$("#spnOpen").text(" Open for Customers (" + hours1 + ':' + minutes1+ " - " + hoursEnd + ':' + minEnd+") ");
					
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
			
			
	});
});