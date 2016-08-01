<!-- BEGIN PAGE CONTENT-->

<script type="text/javascript">

var sessionValue = "<?php echo $this->session->userdata('itemname'); ?>";

</script>

<style>

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
/*.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #F90;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
*/
@media print {
   #nonprintable, #btnprint
    {    
     display: none !important;
    }

  #printable
    {
     display: block !important;
    }
}
</style>



<div id="nonprintable" class="row">
  <div class="col-md-12">
  <!--<span id="widget" class="widget" >-->
      <div  class="portlet box green-meadow calendar ">
      
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i><?php echo $this->lang->line('Schedule');  ?>
                 
              </div>
          </div>
        
          <div  class="portlet-body">
              <div class="row">
              <?php if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	{ ?>
                  <div class="col-md-3 col-sm-12" >
                      <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                      <div class="panel-group accordion" id="accordion1">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                 
                                  <h4 class="panel-title">
                                 
                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
                                  <?php echo $this->lang->line('Shift Template');  ?> </a>
                                  </h4>
                              </div>
                              <div id="collapse_1" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      
                                   <div id="external-events">
                
                              <form id="shiftttemplateForm" class="inline-form">
                                     
                                  <input id="txtName" name="txtName" type="text" value="" class="form-control" placeholder="Name..." /><br/>
                                  <label class="control-label"><?php echo $this->lang->line('Time');  ?></label>
                                  <div class="input-group">
                                        <input id="txtFrom" name="txtFrom" type="text" class="form-control timepicker timepicker-24" >
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                    <br/>
                                  <div class="input-group">
                                        <input id="txtTo" name="txtTo" type="text" class="form-control timepicker timepicker-24">
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                    <br/>
                                    
                                    <select id="drpBreak" name="drpBreak" class="form-control" >
                                      <option value=""><?php echo $this->lang->line('select');echo ' '; echo $this->lang->line('Break');  ?>...</option>
                                      <?php
									  for($i=0; $i<=240; $i=$i+5)
									  	echo '<option value="'.$i.'">'.$i.' min</option>';
									  ?>
                                  </select> 
                                  <br/>
                                  <a href="javascript:;" id="event_add" class="btn default" onclick="addShiftTemplate()">
                                   <?php echo $this->lang->line('Add Shift Template');  ?> </a>
                                  
                              </form>
                              
                          <hr/>
                          <div id="event_box">
                          </div>
                          
                          <!--<label for="drop-remove">
                          <input type="checkbox" id="drop-remove"/>remove after drop </label>
                          <hr class="visible-xs"/>
-->                      </div>   
                    </div>
                </div>
			</div>
         </div>
         <div class="col-md-14">
									<!-- BEGIN DRAGGABLE EVENTS PORTLET-->
            <label id="errLable" style="color:#F00;display:none"></label>
            <h3 class="event-form-title"> <?php echo $this->lang->line('Department');  ?> </h3>
            <div id="external-events">
                <form class="inline-form">
                    <select  class="form-control " id="drplstfilterByDept" name="drplstfilterByDept" >
                             
                                   <?php 
							if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	   
							 echo '<option value="0">'.$this->lang->line('All Department').'</option>';
								  foreach ($deptList as $dept_row)
								  {
									  $selected = '';
									  /*
									  if ($patient_row->status_id == $location_row->sub_constant_id)
									  	$selected = 'selected="selected"';
									  */
									  echo ' <option value="'.$dept_row->dep_id.'" '.$selected.'>'
									  						 .$dept_row->dep_name.'</option>';
								  }
								  ?>

                              </select>
                </form>
                <hr/>
                <div id="event_box">
                </div>
                <hr class="visible-xs"/>
            </div>
            <!-- END DRAGGABLE EVENTS PORTLET-->
        </div>
<!--                      <h3 class="event-form-title">Shift Template</h3>-->
  						
                      <!-- END DRAGGABLE EVENTS PORTLET-->
                  </div>
                  <!--Calender-->
                  
                  <div id="widget" class="col-md-9 col-sm-12">
                   <?php } else {?>
                      <div id="widget" class="col-md-12 col-sm-12">
                       <?php } ?>
                  
                      <div id="calendar" class="has-toolbar">
                      </div>
                  </div>
              </div>
              <!-- END CALENDAR PORTLET-->
          </div>
          <!--<div id="responsive" class="modal fade in" aria-hidden="false" tabindex="-1" style="display: block;">-->
          <div id="form_modal2" class="modal fade">
          			
    <div class="modal-dialog">
     <form action="#" class="form-horizontal" id="shiftModalform" method="post" >
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> <?php echo $this->lang->line('Add Shifts');  ?></h4>
                <div id="dvStaffMsg" class="alert alert-danger display-none">
                     <button class="close" data-dismiss="alert"></button>
                     You should select at least one staff.
                  </div>
                  <div id="dvDeptMsg" class="alert alert-danger display-none">
                     <button class="close" data-dismiss="alert"></button>
                     You should select Location ,date ,start time and end time. Please check below.
                  </div>
                 <div class="alert alert-danger display-hide">
                      <button class="close" data-close="alert"></button>
                      You have some form errors. Please check below.
                  </div>
                  <div class="alert alert-success display-hide">
                      <button class="close" data-close="alert"></button>
                      Your form validation is successful!
                  </div>
            </div>
            <div class="modal-body bgColorWhite">
              
               <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Shift type');?></label>
                        <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input class ="classConflict" type="radio" name="rdShifttype" id="rdShifttype1" value="1" checked>Shift</label>
                              <label class="radio-inline">
                              <input class ="classConflict" type="radio" name="rdShifttype" id="rdShifttype2" value="2">Time Off</label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Is special Shift');?>
                          </label>
                          <div class="col-md-4">
                              <div class="checkbox-list" data-error-container="#form_2_services_error">
                                  <label>
                                  <input type="checkbox" value="1" id="chbxIsspecial" name="chbxIsspecial"/></label>
                              </div>
                              <div id="form_2_services_error">
                              </div>
                          </div>
                      </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Date');  ?></label>
                        <div class="col-md-6">
                            <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                <input type="text" id="drpFromdate" class="form-control classConflict" name="drpFromdate" required>
                                <span class="input-group-addon">
                                to </span>
                                <input type="text" id="drpTodate" class="form-control classConflict" name="drpTodate" required>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Time');  ?></label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input id="txtStart" name="txtStart" type="text" class="form-control timepicker timepicker-24 classConflict" required>
                                <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                </span>
                            </div>
                        </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input id="txtEnd" name="txtEnd" type="text" class="form-control timepicker timepicker-24 classConflict" required>
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    
                    </div>
                                                                        
                     <div id="divBreak" class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Break');  ?> <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstBreak" class="form-control" name="drplstBreak">
                                  <option value=""><?php echo $this->lang->line('select');  ?>...</option>
                                  <?php
								  $selected='';
									  for($i=0; $i<=240; $i=$i+5)
									  { $selected='';
										  if ($i==0)
										  $selected = 'selected="selected"';
									  	echo '<option  value="'.$i.'" '.$selected.' >'.$i.' min</option>';
									  }
								  ?>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-6">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus1" value="1" checked><?php echo $this->lang->line('Draft');  ?></label>
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus2" value="2"><?php echo $this->lang->line('Active');  ?></label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Locatios');  ?><span class="required">
                          * </span></label>
                        <div class="col-md-4">
                            <select id="drpLocation" name="drpLocation" class="form-control input-large " data-placeholder="Select..." required>
                               <!-- <option value=""><?php echo $this->lang->line('select');  ?>..</option>-->
                                <?php 
								foreach ($location as $location_row)
								{
									
									 echo ' <option value="'.$location_row->id.'" '.$selected.'>'
									  						 .$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
								}
								?>
                            </select>
                            
                        </div>
                    </div>
					<div class="form-group" id="divSelect">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Filter staff by');  ?><span class="required">
                          * </span></label>
                        <div class="col-md-8">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection1" value="1" checked><?php echo $this->lang->line('Department');  ?></label>
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection2" value="2"><?php echo $this->lang->line('Job Title');  ?></label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group" id="divDept">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Department');  ?> <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstDept" class="form-control" name="drplstDept" onchange="drpdeptFullChange();">
                              <option value=""><?php echo $this->lang->line('select');  ?>...</option>
                              
                                   <?php 
								   if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	   
									 echo '<option value="0">'.$this->lang->line('All Department').'</option>';
							
								  foreach ($deptList as $dept_row)
								  {
									  $selected = '';
									  /*
									  if ($patient_row->status_id == $location_row->sub_constant_id)
									  	$selected = 'selected="selected"';
									  */
									  echo ' <option value="'.$dept_row->dep_id.'" '.$selected.'>'
									  						 .$dept_row->dep_name.'</option>';
								  }
								  ?>

                              </select>
                          </div>
                      </div>
                      <div class="form-group" id="divJobtitle"  style="display:none">
                          <label class="control-label col-md-4"><?php echo $this->lang->line('Job Title');  ?><span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstJobtitle" class="form-control" name="drplstJobtitle" onchange="drpJobtitleFullChange();">
                                  <option value=""><?php echo $this->lang->line('select');  ?>...</option>
								   <?php 
								  foreach ($jobtitleList as $jobtitle_row)
								  {
									  $selected = '';
									  /*
									  if ($patient_row->status_id == $location_row->sub_constant_id)
									  	$selected = 'selected="selected"';
									  */
									  echo ' <option value="'.$jobtitle_row->id.'" '.$selected.'>'
									  						 .$jobtitle_row->name.'</option>';
								  }
								  ?>

                              </select>
                          </div>
                      </div>
                      <div class="form-group" id="divSpec" style="display:none">
                          <label class="control-label col-md-4"><?php echo $this->lang->line('Specialization');  ?> <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstSpec" class="form-control" name="drplstSpec" onchange="drpSpecFullChange();">
                                  <option value=""><?php echo $this->lang->line('select');  ?>...</option>
                                   <?php 
								  foreach ($specList as $spec_row)
								  {
									  $selected = '';
									  /*
									  if ($patient_row->status_id == $location_row->sub_constant_id)
									  	$selected = 'selected="selected"';
									  */
									  echo ' <option value="'.$spec_row->id.'" '.$selected.'>'
									  						 .$spec_row->name.'</option>';
								  }
								  ?>

                              </select>
                          </div>
                      </div>
                      
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Staff');?></label>
                        <div class="col-md-9">
                            <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                                <?php
                                foreach($staffList as $staff_row)
								{
								   
									echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
									
								}
								  
								?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="icheck-inline">
                                    <label>
                                    <input type="checkbox" class="icheck" id="ckbNotification" name="ckbNotification"><?php echo $this->lang->line('Skip Notification Email');  ?> </label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
            <div class="modal-footer bg-info">
                <button   type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelShift();" ><?php echo $this->lang->line('Cancel'); ?></button>
                <button  type="submit" class="btn btn-primary" ><?php echo $this->lang->line('Save');  ?> </button>
            </div>
        </div>
        <!-- /.modal-content -->
         </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
          
      </div>
  </div>
<!--  </span>-->
</div>
<!-- END PAGE CONTENT-->
<div id="printable" style="display:none"></div>
