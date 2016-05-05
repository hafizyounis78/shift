  </div>
      </div>
      <!-- END CONTENT -->
      <!-- BEGIN QUICK SIDEBAR -->
      <!--Cooming Soon...-->
      <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			 
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url();?>assets/global/plugins/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>



<!-- CORE SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<!-- END CORE SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPS -->
<script src="<?php echo base_url();?>assets/admin/pages/scripts/calendar.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/table-managed.js"></script>
<script src="<?php echo base_url();?>assets/global/scripts/datatable.js"></script>
<!-- END PAGE LEVEL SCRIPS -->

<!-- OUR SCRIPTS -->
<script src="<?php echo base_url();?>js/locations.js"></script>
<script src="<?php echo base_url();?>js/timeoff.js"></script>
<script src="<?php echo base_url();?>js/fullschedule.js"></script>
<script src="<?php echo base_url();?>js/shift.js"></script>
<!--<script src="<?php echo base_url();?>js/setting.js"></script>-->
<!-- END OUR SCRIPTS -->

<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
		 Layout.init(); // init current layout
		
		 Demo.init(); // init demo features
		
		ShiftComponentsDropdowns.init();
		 TimeoffComponentsDropdowns.init();
		  /*******Forms Validation *******************/
		  
		 TimeOffFormValidation.init();
		 ShiftFormValidation.init();
		 ShiftModalFormValidation.init();
		// FullSchedulFormValidation.init();
		 //***********component intialization*******//

		 Calendar.init();
		 
		 ComponentsPickers.init();
		 TimeOffTableManaged.init();
			var newURL = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;
			var pathArray = window.location.pathname.split( '/' );
			// alert(pathArray[3]);
		
			if (pathArray[3]=="setting")
				ComponentsTimeSliders.init();
			else if(pathArray[3]=="fullschedule")
			   Calendar.init();
		
      });
   </script>
<script src="<?php echo base_url();?>js/setting.js"></script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>