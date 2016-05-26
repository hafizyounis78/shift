<div class="clearfix">
</div>
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="start <?php if($title == 'home') echo 'active';?> ">
<!--						<a href="<?php echo base_url();?>home">-->
						<a href="http://hireit4u.com/supermarket/index.php/dashboard/#">
						<i class="icon-home"></i>
						<span class="title">Home</span>
						</a>
					</li>
					<li <?php if($title == 'fullschedule') echo 'class="active open"';?> >
						<a href="<?php echo base_url()."fullschedulecont/fullschedule/".$this->session->userdata('user_id');?>">
						<i class="icon-calendar"></i>
						<span class="title"><?php echo $this->lang->line('Full Schedule');  ?></span>
						</a>
					</li>
                   <!-- <li <?php if($title == 'locations') echo 'class="active open"';?>>
						<a href="<?php echo base_url();?>locationscont/locations">
						<i class="icon-pointer"></i>
						<span class="title"><?php echo $this->lang->line('Locatios');?></span>
						</a>
					</li>-->
                    <?php if ($this->session->userdata('itemname') != "emp")
					{
						?>
                    <li <?php if($title == 'shifts') echo 'class="active open"';?>>
						<a href="<?php echo base_url();?>shiftscont/shifts">
						<i class="icon-list"></i>
						<span class="title">Shifts</span>
						</a>
					</li>
                   <?php  }?>

                    <!--<li <?php if($title == 'shifttemplate') echo 'class="active open"';?>>
						<a href="<?php echo base_url();?>shifttemplatecont/shifttemplate">
						<i class="icon-clock"></i>
						<span class="title">Shift Template</span>
						</a>
					</li>-->
                    <li  <?php if($title == 'timeoff') echo 'class="active open"';?>>
						<a href="<?php echo base_url();?>timeoffcont/timeoff">
						<i class="icon-speedometer"></i>
						<span class="title">Timeoff Request</span>
						</a>
					</li>
                    <li class="last " <?php if($title == 'setting') echo 'class="active open"';?>>
						<a href="<?php echo base_url();?>settingcont/setting">
						<i class="icon-settings"></i>
						<span class="title">Setting</span>
						</a>
					</li>
					<!--<li class="active open">
						<a href="javascript:;">
						<i class="icon-rocket"></i>
						<span class="title">Page Layouts</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="layout_fontawesome_icons.html">
								<span class="badge badge-roundless badge-danger">new</span>Layout with Fontawesome Icons</a>
							</li>
							<li>
								<a href="layout_glyphicons.html">
								Layout with Glyphicon</a>
							</li>
							<li>
								<a href="layout_full_height_content.html">
								<span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
							</li>
							<li>
								<a href="layout_sidebar_reversed.html">
								<span class="badge badge-roundless badge-warning">new</span>Right Sidebar Page</a>
							</li>
							<li>
								<a href="layout_sidebar_fixed.html">
								Sidebar Fixed Page</a>
							</li>
							<li>
								<a href="layout_sidebar_closed.html">
								Sidebar Closed Page</a>
							</li>
							<li>
								<a href="layout_ajax.html">
								Content Loading via Ajax</a>
							</li>
							<li>
								<a href="layout_disabled_menu.html">
								Disabled Menu Links</a>
							</li>
							<li class="active">
								<a href="layout_blank_page.html">
								Blank Page</a>
							</li>
							<li>
								<a href="layout_fluid_page.html">
								Fluid Page</a>
							</li>
							<li>
								<a href="layout_language_bar.html">
								Language Switch Bar</a>
							</li>
						</ul>
					</li>-->
			
					
					
					<!--<li class="last ">
						<a href="javascript:;">
						<i class="icon-pointer"></i>
						<span class="title">Maps</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="maps_google.html">
								Google Maps</a>
							</li>
							<li>
								<a href="maps_vector.html">
								Vector Maps</a>
							</li>
						</ul>
					</li>-->
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
