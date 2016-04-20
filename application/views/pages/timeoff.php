<?php
$ction ="addtimeoff";
$page_title = "addTimeoff";
$readonly = '';
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-clock-o"></i>Time Off Request
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="timeOffForm" class="form-horizontal">
                  <div class="form-body">
                      
                      <div class="alert alert-danger display-hide">
                          <button class="close" data-close="alert"></button>
                          You have some form errors. Please check below.
                      </div>
                      <div class="alert alert-success display-hide">
                          <button class="close" data-close="alert"></button>
                          Your form validation is successful!
                      </div>
                      <div class="form-group">
                            <label class="control-label col-md-3">Location</label>
                            <div class="col-md-4">
                                <select class="form-control input-large select2me" data-placeholder="Select Location" id="drpLocation" name="drpLocation">
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
                                <label class="control-label col-md-3">Dates</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                        <input type="text" class="form-control" readonly id="dpTimeOffDate" name="dpTimeOffDate">
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block">
                                    Select date </span>
                                </div>
                            </div>
                      <div class="form-group">
                            <label class="control-label col-md-3">Time</label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24" id="dpTimeOffFromTime" name="dpTimeOffFromTime">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24" id="dpTimeOffToTime" name="dpTimeOffToTime">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus1" value="1" checked>Pending</label>
                              <label class="radio-inline">
                              <input type="radio" name="rdStatus" id="rdStatus2" value="2">Active</label>
                              
                          </div>
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
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button id="btnSaveTimeoff" type="button" class="btn green">Save</button>
                              <button type="button" class="btn default" onclick="clearForm()">Cancel</button>
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
									<i class="fa fa-clock-o"></i>Shift Templates
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
											 Name
										</th>
										<th>
											Start Time
										</th>
										<th>
											 End Time
										</th>
										<th>
											 Break
										</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											 1
										</td>
										<td>
											 Mark
										</td>
										<td>
											 Otto
										</td>
										<td>
											 makr124
										</td>
										<td>
											<span class="label label-sm label-success">
											Approved </span>
										</td>
									</tr>
									<tr>
										<td>
											 2
										</td>
										<td>
											 Jacob
										</td>
										<td>
											 Nilson
										</td>
										<td>
											 jac123
										</td>
										<td>
											<span class="label label-sm label-info">
											Pending </span>
										</td>
									</tr>
									<tr>
										<td>
											 3
										</td>
										<td>
											 Larry
										</td>
										<td>
											 Cooper
										</td>
										<td>
											 lar
										</td>
										<td>
											<span class="label label-sm label-warning">
											Suspended </span>
										</td>
									</tr>
									<tr>
										<td>
											 4
										</td>
										<td>
											 Sandy
										</td>
										<td>
											 Lim
										</td>
										<td>
											 sanlim
										</td>
										<td>
											<span class="label label-sm label-danger">
											Blocked </span>
										</td>
									</tr>
									</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
					
				</div>