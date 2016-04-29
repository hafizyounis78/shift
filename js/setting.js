// JavaScript Document

var ComponentsTimeSliders = function () {

    return {
        //main function to initiate the module
        init: function () {
            // basic
            $(".slider-basic").slider(); // basic sliders

            // range slider
            $("#slider-range").slider({
                isRTL: Metronic.isRTL(),
                range: true,
                min: -1,
                max: 1380,
                values: [75, 300],
                slide: function (event, ui) {
                    $("#slider-range-amount").text("" + ui.values[0] + " - " + ui.values[1]);
					//alert(ui.values[0]+ ui.values[1]);
                }
            });

            $("#slider-range-amount").text("" + $("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
        }

    };

}();