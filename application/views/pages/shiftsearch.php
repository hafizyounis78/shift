<div class="row">
				<div class="col-md-12">
					<!--<div class="note note-danger">
						
					</div>-->
					<!-- Begin: life time stats -->
					<div class="portlet">
						<!--<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-shopping-cart"></i>Order Listing
							</div>
							<div class="actions">
								<a href="#" class="btn default yellow-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								New Order </span>
								</a>
								<div class="btn-group">
									<a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
									<i class="fa fa-share"></i>
									<span class="hidden-480">
									Tools </span>
									<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">
											Export to Excel </a>
										</li>
										<li>
											<a href="#">
											Export to CSV </a>
										</li>
										<li>
											<a href="#">
											Export to XML </a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											Print Invoices </a>
										</li>
									</ul>
								</div>
							</div>
						</div>-->
						<div class="portlet-body">
							<div class="table-container">
								<!--<div class="table-actions-wrapper">
									<span>
									</span>
									<select class="table-group-action-input form-control input-inline input-small input-sm">
										<option value="">Select...</option>
										<option value="Cancel">Cancel</option>
										<option value="Cancel">Hold</option>
										<option value="Cancel">On Hold</option>
										<option value="Close">Close</option>
									</select>
									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
								</div>-->
								<table class="table table-striped table-bordered table-hover" id="shiftdatatable_ajax">
								<thead>
								<tr role="row" class="heading">
									<th width="2%">
										<input type="checkbox" class="group-checkable">
									</th>
									<th width="18%">
									</th>
									<th width="15%">
									</th>
                                    <th width="15%">
									</th>
									<th width="12%">
									</th>
                                    <th width="12%">
									</th>
									<th width="10%">
									</th>
									<th width="12%">
										 Status
									</th>
                                    <th width="5%">
									</th>
									
									
									<th width="10%">
									</th>
								</tr>
								<tr role="row" class="filter">
									<td>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="txtName">
									</td>
									<td>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy/mm/dd">
											<input type="text" class="form-control form-filter input-sm" readonly name="dtstartDate" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
                                    </td>
                                    <td>
										<div class="input-group date date-picker" data-date-format="yyyy/mm/dd">
											<input type="text" class="form-control form-filter input-sm" readonly name="dtendDate" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</td>
									<td>
										
                                  
                                    
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker timepicker-24 form-filter input-sm" id="txtStart"  name="txtStart" >
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button"><i class="fa fa-clock-o"></i></button>
                                            </span>
                                        </div>
                                  	</td>
                                    <td>
                                   
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button"><i class="fa fa-clock-o"></i></button>
                                            </span>
                                        </div>
                                    
                                    
                          
									</td>
									<td>
									<select id="drpType" name="drpType" class="form-control form-filter input-sm">
											<option value="1">Shift</option>
											<option value="2">Timeoff</option>
										
										</select>
									</td>
                                    	<td>
										<select name="drpStatus" class="form-control form-filter input-sm">
											<option value="">Select...</option>
											<option value="1">Pending</option>
											<option value="2">Active</option>
											
										</select>
									</td>
									<td>
										<select class="form-control form-filter input-sm " data-placeholder="<?php echo $this->lang->line('select');  ?>..." id="drpLocation" name="drpLocation">
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
									</td>
									
								
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> </button>
										</div>
										<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> </button>
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
