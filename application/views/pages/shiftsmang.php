<!--<script src="<?php echo base_url();?>js/shift.js"></script>
<script>
      jQuery(document).ready(function() {    
         
		ShiftComponentsDropdowns.init();
		 ShiftFormValidation.init();
		 ShiftModalFormValidation.init();
		 
      });
   </script>-->

<?php
$action ="addshift";

$readonly = '';
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-clock-o"></i><?php echo $this->lang->line('Managing Shifts');  ?>
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="shiftForm" class="form-horizontal">
                  <div class="form-body">
                       <div id="dvStaffMsg" class="alert alert-danger display-none">
                         <button class="close" data-dismiss="alert"></button>
                        <?php echo $this->lang->line('Select one Stuff at least');?>
                      </div>
                      <div id="dvDeptMsg" class="alert alert-danger display-none">
                         <button class="close" data-dismiss="alert"></button>
                         You should select Location ,date ,start time and end time before selecting department. Please check below.
                      </div>
                      <div class="alert alert-danger display-hide">
                          <button class="close" data-close="alert"></button>
                          You have some form errors. Please check below.
                      </div>
                      <div class="alert alert-success display-hide">
                          <button class="close" data-close="alert"></button>
                          Your form validation is successful!
                      </div>
                      <input type="hidden" name="hdnaction" id="hdnaction" value="<?php echo $action; ?>" />
                      <input type="hidden" name="hdnshiftId" id="hdnshiftId" value="<?php echo $action; ?>" />
                      <div class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Is special Shift');  ?>
                          </label>
                          <div class="col-md-4">
                              <div class="checkbox-list" data-error-container="#form_2_services_error">
                                  <label>
                                  <input type="checkbox" value="1" id="chbxIsspecial" name="chbxIsspecial" onclick="change_special_shift()"/></label>
                              </div>
                              <div id="form_2_services_error">
                              </div>
                          </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Date');  ?><span class="required">
                          * </span></label>
                        <div id="dvdate" class="col-md-6">
                            <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                <input type="text" id="drpFromdate" class="form-control " name="drpFromdate" >
                                <span class="input-group-addon">
                                bis </span>
                                <input type="text" id="drpTodate" class="form-control " name="drpTodate" >
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                      <div class="form-group">
                            <label class="control-label col-md-3"><?php echo $this->lang->line('Time');  ?><span class="required">
                          * </span></label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24 " id="txtStart"  name="txtStart" >
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24 " id="txtEnd" name="txtEnd" >
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Break');?><span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select class="form-control"  name="drplstBreak" id="drplstBreak">
                                  <?php
									  for($i=0; $i<=240; $i=$i+5)
									  	echo '<option value="'.$i.'">'.$i.' min</option>';
								  ?>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Status<span class="required">
                          * </span></label>
                        <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus1" value="1" disabled="disabled"  ><?php echo $this->lang->line('Draft');  ?></label>
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus2" value="2" checked><?php echo $this->lang->line('Active');  ?></label>
                              
                          </div>
                        </div>
                    </div>
                   <div class="form-group" id="divSelect">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Filter staff by');  ?><span class="required">
                          * </span></label>
                        <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection1" value="1"  checked><?php echo $this->lang->line('Department');  ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="rdSelection" id="rdSelection2" value="2"  ><?php echo $this->lang->line('Job Title');  ?></label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group" id="divDept">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Department');  ?>  <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstDept" class="form-control" name="drplstDept" onchange="drpdeptChange();">
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
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Job Title');  ?><span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstJobtitle" class="form-control" name="drplstJobtitle" onchange="drpJobtitleChange();">
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
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Specialization');  ?>  <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstSpec" class="form-control" name="drplstSpec" onchange="drpSpecChange();">
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
                            <label class="control-label col-md-3"><?php echo $this->lang->line('Locatios'); ?><span class="required">
                          * </span></label>
                            <div class="col-md-4">
                                <select class="form-control input-large " data-placeholder="<?php echo $this->lang->line('select');  ?>..." id="drpLocation" name="drpLocation">
                                  <option value=""><?php echo $this->lang->line('select');  ?>..</option>
                                     <?php 
								  foreach ($location as $location_row)
								  {
									  $selected = '';
									  
									 // if ($patient_row->status_id == $location_row->sub_constant_id)
									  //	$selected = 'selected="selected"';
									  
									 echo ' <option value="'.$location_row->id.'" '.$selected.'>'
									  						 .$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
								  }
								  ?>

                                </select>
                                
                            </div>
                        </div>
                    <div class="form-group" id="divUser">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Staff');?><span class="required">
                          * </span></label>
                        <div class="col-md-9">
                        <span class="help-block">
                                   <?php echo $this->lang->line('Select one Stuff at least');?></span>
                            <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                            
                            <?php /*?>   <?php
                                 foreach($staffList as $staff_row)
								  {
									 
									  echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
									  
								  }
								  
								?><?php */?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group" id="dvstaffname" style="display:none">
                            <label class="control-label col-md-3"><?php echo $this->lang->line('Staff');?></label>
                            <div class="col-md-4">
                                <input id="txtstaffName" name="txtstaffName" type="text" class="form-control form-filter input-sm"  disabled="disabled">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="icheck-inline">
                                    <label>
                                    <input type="checkbox" class="icheck" id="ckbNotification" name="ckbNotification"><?php echo $this->lang->line('Skip Notification Email');?></label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green"><?php echo $this->lang->line('Save'); ?></button>
                              <button type="button" class="btn default" onclick="clearShiftForm();"><?php echo $this->lang->line('Cancel'); ?></button>
                          </div>
                      </div>
                  </div>
              </form>
              <!-- END FORM-->
          </div>
          <!-- END VALIDATION STATES-->
          
      </div>
  </div>
</div>
<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box purple">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-clock-o"></i><?php echo $this->lang->line('Shifts');?>
								</div>
								
							</div>
							<div class="portlet-body">
								<!--<div class="table-scrollable">
-->									<table class="table table-striped table-bordered table-hover" id="ShiftDatatable">
									<thead>
									<tr>
											
                                        <th>
											 <?php echo $this->lang->line('Locatios'); ?>
										</th>
										<th>
											 <?php echo $this->lang->line('Start Date');?>
										</th>
                                        <th>
											<?php echo $this->lang->line('End Date');?> 
										</th>
										<th>
											<?php echo $this->lang->line('Start Time');?>
										</th>
										<th>
											<?php echo $this->lang->line('End Time');?> 
										</th>
										                   
                                        <th>
											 Status
										</th>
                                         <th>
											 <?php echo $this->lang->line('Is special Shift'); ?>
										</th>
                                        <th>
											 <?php echo $this->lang->line('No. of Employee'); ?>
										</th>
                                        <th>
											 <?php echo $this->lang->line('Action'); ?>
										</th>
									</tr>
									</thead>
									<tbody id="shift_body">
			
						            <?php
									$i=1;
									$statusrow='';
									$specialrow='';
										foreach($shiftrec as $row)
											{
												if($row->status==1)
												 $statusrow='Entwurf';
												 else
												 $statusrow='Aktiviert';
												 if($row->Special_shift==1)
												 $specialrow='Yes';
												 else
												 $specialrow='No';
												 echo '<tr>';		
												
												 echo '<td id="tdlocation'.$i.'" data-loid="'.$row->map_id.'">'. $row->loc_name.'</td>';
												 echo '<td id="tdstart_date'.$i.'">'. $row->start_date.'</td>';
												 echo '<td id="tdend_date'.$i.'">'. $row->end_date.'</td>';
												 echo '<td id="tdstart_Time'.$i.'">'. $row->start_time.'</td>';
												 echo '<td id="tdend_Time'.$i.'">'. $row->end_time.'</td>';
												 
												if ($row->status == 1)
												 echo '<td id="tdrdStatus'.$i.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
 												else
												 echo '<td id="tdrdStatus'.$i.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 
												 echo '<td id="tdSpecial_shift'.$i.'" data-stid="'.$row->Special_shift.'">'.$specialrow.'</td>';
 												 echo '<td id="tdemployees'.$i.'">'.$row->emp_name.'</td>';
												 echo '<td>
													  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateAllshift('.$i.')">
													  <i class="fa fa-edit"></i>  </button>
													  <button id="btnduplicatShift" name="btnduplicatShift" type="button" class="btn default btn-xs green" onclick="duplicatShift('.$i.')">
													  <i class="fa fa-copy"></i>  </button>';
													  
												 echo '</td>';  
												
												 echo '</tr>';
											$i++;
											}
											
									?>
									</tbody>
									</table>
							<!--	</div>-->
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
					
				</div>
                
                