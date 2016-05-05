// JavaScript Document

var staffList="";
$(document).ready(function () {
	var slectionId='';
    $("input[name=rdSelection]:radio").change(function () {
        $("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
	
		if ($("#rdSelection1").attr("checked")) {
			slectionId=$("#rdSelection1").val();
			document.getElementById("divDept").style.display = "block";	
			document.getElementById("divJobtitle").style.display = "None";	
			document.getElementById("divSpec").style.display = "None";	
		
        }
        else {
            slectionId=$("#rdSelection2").val();
			document.getElementById("divDept").style.display = "None";	
			document.getElementById("divJobtitle").style.display = "block";	
			document.getElementById("divSpec").style.display = "block";	
		
        }
       
    })
	//*****************change date or time*************//
	$(".classConflict").change(function () {
	
		clearStaffSelect();
	})	
/*	$('#timeoffTable').dataTable( {
		"bPaginate": true,
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "{{=URL('MIS','get_serverside')}}",
	} )  */  	
		/*.columnFilter({sPlaceHolder: "head:before",
      	aoColumns: [{type: "text" },{type: "text" },{type: "text" },{type: "text" },{type: "text" },{type: "text" }]
    });	*/
		
	 /*$('#timeoffTable').dataTable({
		 "bPaginate": true,
      	"sPaginationType": "full_numbers"
      })
    	.columnFilter({sPlaceHolder: "head:before",
      	aoColumns: [{type: "text" },{type: "text" },{type: "text" },{type: "text" },{type: "text" },{type: "text" }]
    });*/
});
function edittimeoff() {							
		
		var action = $("#hdnaction").val();
	if (action!="updateTimeoff")	
		if (!validateStaffselect())
		 return;
		
			var formData = new FormData();
	
				formData.append('hdnshiftId'		 , $("#hdnshiftId").val());
				formData.append('drpLocation'		 , $("#drpLocation").val());
				formData.append('drpFromdate'		 , $("#drpFromdate").val());
				formData.append('drpTodate'		, $("#drpTodate").val());
				formData.append('txtStart'	    ,  $("#txtStart").val());
				formData.append('txtEnd'	        ,  $("#txtEnd").val());
				formData.append('rdStatus'          ,  $("input[name=rdStatus]:checked").val());
				formData.append('staffList'		     ,  staffList);
	
	$.ajax({
			url: baseURL+"Timeoffcont/"+action,
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
				clearfimeoffForm();
				var success = $('.alert-success', $("#timeOffForm"));
				success.show();
				Metronic.scrollTo(success, -200);
				
				$("#timeoff_body").html(returndb);
				
			}
		});//END $.ajax
	} // END function edittimeoff
	
function deletetimeoff(i)
{
	var x='';
	var r = confirm('This record will be deleted. Do you want to continue?');
	
	
	if (r == true) {
		x =1;
	} else {
		x = 0;
	}
	if(x==1)
	{
	var timeoffId=i;
	$.ajax({
			url: baseURL+"Timeoffcont/deletetimeoff",
			type: "POST",
			data: {timeoffId:timeoffId},
			error: function(xhr, status, error) {
  				//var err = eval("(" + xhr.responseText + ")");
  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				clearfimeoffForm();
				var success = $('.alert-success', $("#timeOffForm"));
				success.show();
				$("#timeoff_body").html(returndb);
				
			}
		});//END $.ajax
	}
}

function updatetimeoff(i)
{
	$("#hdnshiftId").val(i);
	$("#hdnaction").val('updateTimeoff');
	var locationId=$("#tdlocation"+i).attr('data-loid');
	$("#drpLocation").val(locationId);
	$("#drpFromdate").val($("#tdstart_date"+i).html());
	$("#drpTodate").val($("#tdend_date"+i).html());
	$("#txtStart").val($("#tdstart_Time"+i).html());
	$("#txtEnd").val($("#tdend_Time"+i).html());
	$("#rdStatus").val($("#tdlocation"+i).html());
	
	var statusId=$("#tdrdStatus"+i).attr('data-stid');
	
	if (statusId==1)
	{

		$("#rdStatus1").parent().addClass('checked');
		$("#rdStatus2").parent().removeClass('checked');
	}
	else
	{

		$("#rdStatus2").parent().addClass('checked');
		$("#rdStatus1").parent().removeClass('checked');
	}

    
		$("#txtstaffName").val($("#tdstaff"+i).html());
		document.getElementById("divSelect").style.display = "None";	
		document.getElementById("divUser").style.display = "None";	
		document.getElementById("divDept").style.display = "None";	
        document.getElementById("divJobtitle").style.display = "None";	
		document.getElementById("divSpec").style.display = "None";	
		document.getElementById("dvstaffname").style.display = "block";	
		Metronic.scrollTo($('#timeOffForm'), -100);
}
function clearStaffSelect()
{
		$("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		staffList="";
		var ddldept=document.getElementById('drplstDept');
		 ddldept.options[0].selected = true;
		var ddlJobtitle=document.getElementById('drplstJobtitle');
		 ddlJobtitle.options[0].selected = true; 
		 var ddlSpec=document.getElementById('drplstSpec');
		 ddlSpec.options[0].selected = true; 
}
function clearfimeoffForm()
{
	$("#hdnshiftId").val("");
	$("#hdnaction").val('addtimeoff');
	$("#drpLocation").val("");
	$("#drpFromdate").val("");
	$("#drpTodate").val("");
	$("#txtStart").val("");
	$("#txtEnd").val("");
	$("#txtstaffName").val("");
	document.getElementById("divUser").style.display = "block";
	document.getElementById("divDept").style.display = "block";	
	document.getElementById("divSelect").style.display = "block";	
	document.getElementById("dvstaffname").style.display = "None";		
    document.getElementById("divJobtitle").style.display = "None";	
	document.getElementById("divSpec").style.display = "None";	
	clearStaffSelect();

}


//****************List change
function drptimeoffdeptChange()
{
	    $("#my_multi_select1").html('');
		$("#my_multi_select1").multiSelect('refresh');
		
		
		if (!validateShift())
		{
			clearStaffSelect()
			return;
		}
		 if ($("#drplstDept").val()!='')
		 {
		var formData = new FormData();
			formData.append('drpFromdate'	, $("#drpFromdate").val());
			formData.append('drpTodate'		, $("#drpTodate").val());
			formData.append('txtStart'	    , $("#txtStart").val());
			formData.append('txtEnd'	    , $("#txtEnd").val());
			formData.append('deptNo'        , $("#drplstDept").val()),
	
		$.ajax({
			url: baseURL+"Timeoffcont/getUserByDept",
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
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
		 }
}
function drpJobtitleChange()
{
	    
		
		if (!validateShift())
		{
			clearStaffSelect()
			return;
		}
		 if ($("#drplstJobtitle").val()!='')
		 {
		var formData = new FormData();
			formData.append('drpFromdate'	, $("#drpFromdate").val());
			formData.append('drpTodate'		, $("#drpTodate").val());
			formData.append('txtStart'	    , $("#txtStart").val());
			formData.append('txtEnd'	    , $("#txtEnd").val());
			formData.append('JobTitelId'        , $("#drplstJobtitle").val());
	
		$.ajax({
			url: baseURL+"Timeoffcont/getUserByJobtitle",
			type: "POST",
			data: formData,
			 processData: false,
			 contentType: false,
			error: function(xhr, status, error) {

  				alert(xhr.responseText);
			},
			beforeSend: function(){},
			complete: function(){},
			success: function(returndb){
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
	}
}
function drpSpecChange()
{
	    
		
		if (!validateShift())
		 {
			clearStaffSelect()
			return;
		}
		 if ($("#drplstSpec").val()!='' && $("#drplstJobtitle").val()!='' )
		 {
		var formData = new FormData();
			formData.append('drpFromdate'	, $("#drpFromdate").val());
			formData.append('drpTodate'		, $("#drpTodate").val());
			formData.append('txtStart'	    , $("#txtStart").val());
			formData.append('txtEnd'	    , $("#txtEnd").val());
			formData.append('JobTitelId'        , $("#drplstJobtitle").val());
			formData.append('specId'        , $("#drplstSpec").val());
		
		$.ajax({
			url: baseURL+"Timeoffcont/getUserBySpec",
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
				
				document.getElementById("divUser").style.display = "block";
				document.getElementById("dvstaffname").style.display = "None";
				$("#my_multi_select1").html(returndb);
				$("#my_multi_select1").multiSelect('refresh');
			}
		});//END $.ajax
	}
}
//****************timeoff Validation
function validateStaffselect()
{
	var error = $('#dvStaffMsg');
	var valid = true;
	if ( staffList=='' )
	 valid = false;
	
	else
	 valid = true;
	
	if(!valid)
	{
		
		error.show();
        Metronic.scrollTo(error, -200);
	}
	else
	{
		error.hide();
	}
	return valid;
}
function validateShift()
{		
	var error = $('#dvDeptMsg');
	var valid = true;
	if ( !$("#drpFromdate").valid() )
		valid = false;
		if ( !$("#drpTodate").valid() )
		valid = false;
	if ( !$("#txtStart").valid() )
		valid = false;
	if ( !$("#txtEnd").valid() )
		valid = false;

	if ( !$("#drpLocation").valid() )
		valid = false;
	
	if(!valid)
	{
		
		error.show();
        Metronic.scrollTo(error, -200);
	}
	else
	{
		error.hide();
	}
		
	return valid;
}
var TimeOffFormValidation = function () {
 var handleValidation = function() {
        
            var form = $('#timeOffForm');
            var errormsg = $('.alert-danger', form);
            var successmsg = $('.alert-success', form);
			jQuery.validator.addMethod("greaterThanStartdate", function(value, element) {
    			return Date.parse($('#drpTodate').val())>=Date.parse($('#drpFromdate').val()) ;
			}, "* End date must be greater than Start date");
			jQuery.validator.addMethod("greaterThanStarttime", function(value, element) {
				var start_time = $("#txtStart").val();
				var end_time = $("#txtEnd").val();
				//convert both time into timestamp
				var stt = new Date("November 13, 2015 " + start_time);
				stt = stt.getTime();
				var endt = new Date("November 13, 2015 " + end_time);
				endt = endt.getTime();
					
				return endt>stt ;
			}, "* End time must be greater than Start time");
			
            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
					
					drpLocation: {
                        required: true
                    },
	                drpFromdate: {
                        required: true
                    },
	                drpTodate: {
                        required:true,
						greaterThanStartdate:true
                    
					},
					txtStart: {
                        required: true
                    },
	                txtEnd: {
                        required: true,
						greaterThanStarttime:true
                    }
				},

               messages: { // custom messages for radio buttons and checkboxes
                drpLocation: {
                        required: "Please enter the location"
                    },
                    drpFromdate: {
                        required: "Please enter timeoff date"
                    },
					drpTodate: {
						required: "Please enter valid end date",
						greaterThanStartdate:"Please enter valid end date"
                    },
                    txtStart: {
                        required: "Please enter start time of timeoff"
                    }
					,
                    txtEnd: {
                        required: "Please enter start time of timeoff",
						greaterThanStarttime:"Please enter valid end time"
                    }
				},
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    successmsg.hide();
                    errormsg.show();
					$('#spnMsg').text('Please check the entered fields ,there is some errors');
                    Metronic.scrollTo(errormsg, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    errormsg.hide();
					edittimeoff();

                }

            });
    }
return {
        //main function to initiate the module
        init: function () {
            handleValidation();

        }

    };

}();


var TimeoffComponentsDropdowns = function () {

 var handleMultiSelect = function () {
        $('#my_multi_select1').multiSelect({
            selectableOptgroup: true,
			
			afterSelect: function(values){
				if (staffList=='')
				staffList=values;
				else
			  staffList=staffList+','+values;
			  //alert("staffList "+staffList);
			},
			afterDeselect: function(values){
				//alert("values is "+values);
			   var staffID =staffList.split(',');
			   var newstafflist="";
			   for ( var i = 0; i < staffID.length; i++ )
				{
					if (staffID[i]==values)
					{
					//	alert("staffID["+i+"]"+staffID[i])
					}
					else
					{
						if (newstafflist=='')
							newstafflist=staffID[i];
						else
							newstafflist=newstafflist+','+staffID[i];
					}
				}
				staffList=newstafflist;
				
			},
			
			selectableHeader: "<div class='btn-danger' align='center'><b> Available </b></div>",
  			selectionHeader: "<div class='btn-success' align='center'><b> Selected </b></div>"
        });
	
    }
	
	return {
        //main function to initiate the module
        init: function () {            
           handleMultiSelect();
        }
    };

}();
var TimeOffTableManaged = function () {

    var initTable1 = function () {

        var table = $('#timeOffTable');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "My search: ",
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }

   /* var initTable2 = function () {

        var table = $('#sample_2');

        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "language": {
                "lengthMenu": " _MENU_ records",
                "paging": {
                    "previous": "Prev",
                    "next": "Next"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_2_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }

    var initTable3 = function () {

        var table = $('#sample_3');

        // begin: third table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_3_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }
*/
    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
    //        initTable2();
     //       initTable3();
        }

    };

}();