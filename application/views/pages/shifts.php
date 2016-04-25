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
                  <i class="fa fa-clock-o"></i>Add new Shift
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="shiftForm" class="form-horizontal">
                  <div class="form-body">
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
                            <label class="control-label col-md-3">Location<span class="required">
                          * </span></label>
                            <div class="col-md-4">
                                <select class="form-control input-large " data-placeholder="Select..." id="drpLocation" name="drpLocation">
                                  <option value="">Select..</option>
                                     <?php 
								  foreach ($location as $location_row)
								  {
									  $selected = '';
									  /*
									  if ($patient_row->status_id == $location_row->sub_constant_id)
									  	$selected = 'selected="selected"';
									  */
									  echo ' <option value="'.$location_row->id.'" '.$selected.'>'
									  						 .$location_row->name.'</option>';
								  }
								  ?>

                                </select>
                                <span class="help-block">
                                .Select Location</span>
                            </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Date<span class="required">
                          * </span></label>
                        <div class="col-md-6">
                            <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                <input type="text" id="drpFromdate" class="form-control" name="drpFromdate">
                                <span class="input-group-addon">
                                to </span>
                                <input type="text" id="drpTodate" class="form-control" name="drpTodate">
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                      <div class="form-group">
                            <label class="control-label col-md-3">Time<span class="required">
                          * </span></label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24" id="txtStart"  name="txtStart" >
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24" id="txtEnd" name="txtEnd">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Break <span class="required">
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
                              <input type="radio" name="rdStatus" id="rdStatus1" value="1" checked>Draft</label>
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus2" value="2">Active</label>
                              
                          </div>
                        </div>
                    </div>
                    <div class="form-group" id="divDept">
                          <label class="control-label col-md-3">Department <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstDept" class="form-control" name="drplstDept" onchange="drpdeptChange();">
                                  <option value="">Select...</option>
                                  <option value="1">Dept 1</option>
                                  <option value="2">Dept 2</option>
                                  <option value="3">Dept 5</option>
                                  <option value="4">Dept 4</option>
                                  <option value="5">Dept 2</option>
                                  <option value="6">Dept 5</option>
                                  <option value="7">Dept 4</option>
                                  <option value="8">Dept 5</option>
                                  <option value="9">Dept 4</option>
                              </select>
                          </div>
                      </div>
                    <div class="form-group" id="divUser">
                        <label class="control-label col-md-3">Staff<span class="required">
                          * </span></label>
                        <div class="col-md-9">
                        <span class="help-block">
                                    Select one staff  at least </span>
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
                            <label class="control-label col-md-3">Staff name</label>
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
                                    <input type="checkbox" class="icheck"> Skip Notification Email</label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Save</button>
                              <button type="button" class="btn default" onclick="clearShiftForm();">Cancel</button>
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
									<i class="fa fa-clock-o"></i>Shift
								</div>
								
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-striped table-hover">
									<thead>
									<tr>
										<th>
											 #
										</th>
                                        <th>
											 Staff
										</th>
										<th>
											 Start Date
										</th>
                                        <th>
											 End Date
										</th>
										<th>
											Start Time
										</th>
										<th>
											 End Time
										</th>
										<th>
											 Location
										</th>
                                        <th>
											 Status
										</th>
                                        <th>
											 Action
										</th>
									</tr>
									</thead>
									<tbody id="shift_body">
			
						            <?php
									$i=1;
									$statusrow='';
										foreach($shiftrec as $row)
											{
												if($row->status==1)
												 $statusrow='Draft';
												 else
												 $statusrow='Active';
												 echo '<tr>';		
												 echo '<td>'.$i++.'</td>';
												 echo '<td id="tdstaff'.$row->id.'">'.$row->Staff_name.'</td>';
												 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
												 echo '<td id="tdend_date'.$row->id.'">'. $row->end_date.'</td>';
												 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
												 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
												 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
												// echo '<td id="tdrdStatus'.$row->id.'">'. $statusrow.'</td>';
												 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'">'.$statusrow.'</td>';		 
												 echo '<td>
													  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateShift('.$row->id.')">
													  <i class="fa fa-edit"></i> Update </button>
													  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deleteShift('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
												 echo '</td>';  
												
												 echo '<tr/>';
											}
									?>
									</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
					
				</div>