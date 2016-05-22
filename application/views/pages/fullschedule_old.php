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
</style>



<div class="row">
  <div class="col-md-12">
      <div class="portlet box green-meadow calendar">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i>Full Schedule
              </div>
          </div>
          <div class="portlet-body">
              <div class="row">
                  <div class="col-md-3 col-sm-12">
                      <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                      <div class="panel-group accordion" id="accordion1">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
                                  Shfit Template </a>
                                  </h4>
                              </div>
                              <div id="collapse_1" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      
                                   <div id="external-events">
                
                              <form id="shiftttemplateForm" class="inline-form">
                                     
                                  <input id="txtName" name="txtName" type="text" value="" class="form-control" placeholder="Name..." /><br/>
                                  <label class="control-label">Time</label>
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
                                      <option value="">Select Break Time...</option>
                                      <?php
									  for($i=0; $i<=240; $i=$i+5)
									  	echo '<option value="'.$i.'">'.$i.' min</option>';
									  ?>
                                  </select> 
                                  <br/>
                                  <a href="javascript:;" id="event_add" class="btn default" onclick="addShiftTemplate()">
                                  Add Shift Template </a>
                                  
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
            <h3 class="event-form-title">Department</h3>
            <div id="external-events">
                <form class="inline-form">
                    <select  class="form-control select2me" id="drplstfilterByDept" name="drplstfilterByDept" >
                             
                                   <?php 
							if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	   
							 echo '<option value="0">All departments...</option>';
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
                  <div class="col-md-9 col-sm-12">
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
                <h4 class="modal-title">Add Shift</h4>
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
                        <label class="control-label col-md-3">Shift type</label>
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
                          <label class="control-label col-md-3">Is special Shift
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
                        <label class="control-label col-md-3">Location</label>
                        <div class="col-md-4">
                            <select id="drpLocation" name="drpLocation" class="form-control input-large select2me" data-placeholder="Select..." required>
                                <option value="">Select..</option>
                                <?php 
								foreach ($location as $location_row)
								{
									
									echo ' <option value="'.$location_row->id.'" '.$selected.'>'
														   .$location_row->name.'</option>';
								}
								?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date</label>
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
                        <label class="control-label col-md-3">Time</label>
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
                          <label class="control-label col-md-3">Break <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstBreak" class="form-control" name="drplstBreak">
                                  <option value="">Select...</option>
                                  <?php
									  for($i=0; $i<=240; $i=$i+5)
									  	echo '<option value="'.$i.'">'.$i.' min</option>';
								  ?>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus1" value="1" checked>Draft</label>
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus2" value="2">Active</label>
                              
                          </div>
                        </div>
                    </div>
					<div class="form-group" id="divSelect">
                        <label class="control-label col-md-3">Filter staff by<span class="required">
                          * </span></label>
                        <div class="col-md-6">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection1" value="1" checked>Department</label>
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection2" value="2">Job title</label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group" id="divDept">
                          <label class="control-label col-md-3">Department <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstDept" class="form-control" name="drplstDept" onchange="drpdeptFullChange();">
                              <option value="">select...</option>
                              
                                   <?php 
								   if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	   
									 echo '<option value="0">All departments...</option>';
							
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
                          <label class="control-label col-md-3">Job title <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstJobtitle" class="form-control" name="drplstJobtitle" onchange="drpJobtitleFullChange();">
                                  <option value="">select...</option>
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
                          <label class="control-label col-md-3">Specialization <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstSpec" class="form-control" name="drplstSpec" onchange="drpSpecFullChange();">
                                  <option value="">select...</option>
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
                        <label class="control-label col-md-3">Staff</label>
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
                                    <input type="checkbox" class="icheck" id="ckbNotification" name="ckbNotification"> Skip Notification Email</label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
            <div class="modal-footer bg-info">
                <button   type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button  type="submit" class="btn btn-primary" >Save </button>
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
</div>
<!-- END PAGE CONTENT-->