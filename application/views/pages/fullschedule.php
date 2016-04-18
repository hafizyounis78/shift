<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <div class="col-md-12">
      <div class="portlet box green-meadow calendar">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i>Calendar
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
                
                          <form class="inline-form">
                              <input type="text" value="" class="form-control" placeholder="Name..." id="event_title"/><br/>
                              <label class="control-label">Time</label>
                              <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                                <br/>
                              <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                                <br/>
                                
                                <select class="form-control" name="select">
                                  <option value="">Select Break Time...</option>
                                  <option value="Category 1">Category 1</option>
                                  <option value="Category 2">Category 2</option>
                                  <option value="Category 3">Category 5</option>
                                  <option value="Category 4">Category 4</option>
                              </select> 
                              <br/>
                              <a href="javascript:;" id="event_add" class="btn default">
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
          <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h4 class="modal-title">Add Shift</h4>
											</div>
											<div class="modal-body">
												<form action="#" class="form-horizontal">
													<div class="form-group">
                                                        <label class="control-label col-md-3">Location</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-large select2me" data-placeholder="Select...">
                                                                <option value=""></option>
                                                                <option value="AL">EDEKA</option>
                                                                <option value="WY">Our Location</option>
                                                                <option value="AL">EDEKA1</option>
                                                                <option value="WY">EDEKA2</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="control-label col-md-3">Date</label>
                                                        <div class="col-md-6">
                                                            <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                                                <input type="text" id="drpFromdate" class="form-control" name="from">
                                                                <span class="input-group-addon">
                                                                to </span>
                                                                <input type="text" id="drpTodate" class="form-control" name="to">
                                                            </div>
                                                            <!-- /input-group -->
                                                        </div>
                                                    </div>
									
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Time</label>
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control timepicker timepicker-24">
                                                                <span class="input-group-btn">
                                                                <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control timepicker timepicker-24">
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
                                                              <select class="form-control" name="select">
                                                                  <option value="">Select...</option>
                                                                  <option value="Category 1">Category 1</option>
                                                                  <option value="Category 2">Category 2</option>
                                                                  <option value="Category 3">Category 5</option>
                                                                  <option value="Category 4">Category 4</option>
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
               
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Staff</label>
                                                        <div class="col-md-9">
                                                            <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                                                                <option>Dallas Cowboys</option>
                                                                <option>New York Giants</option>
                                                                <option selected>Philadelphia Eagles</option>
                                                                <option selected>Washington Redskins</option>
                                                                <option>Chicago Bears</option>
                                                                <option>Detroit Lions</option>
                                                                <option>Green Bay Packers</option>
                                                                <option>Minnesota Vikings</option>
                                                                <option selected>Atlanta Falcons</option>
                                                                <option>Carolina Panthers</option>
                                                                <option>New Orleans Saints</option>
                                                                <option>Tampa Bay Buccaneers</option>
                                                                <option>Arizona Cardinals</option>
                                                                <option>St. Louis Rams</option>
                                                                <option>San Francisco 49ers</option>
                                                                <option>Seattle Seahawks</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</form>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
												<button class="btn green" data-dismiss="modal">Save changes</button>
											</div>
										</div>
									</div>
								</div>
      </div>
  </div>
</div>
<!-- END PAGE CONTENT-->