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
                      <h3 class="event-form-title">Draggable Events</h3>
                      <div id="external-events">
                          <form class="inline-form">
                              <input type="text" value="" class="form-control" placeholder="Event Title..." id="event_title"/><br/>
                              <a href="javascript:;" id="event_add" class="btn default">
                              Add Event </a>
                          </form>
                          <hr/>
                          <div id="event_box">
                          </div>
                          <label for="drop-remove">
                          <input type="checkbox" id="drop-remove"/>remove after drop </label>
                          <hr class="visible-xs"/>
                      </div>
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
												<h4 class="modal-title">Datepickers In Modal</h4>
											</div>
											<div class="modal-body">
												<form action="#" class="form-horizontal">
													<div class="form-group">
														<label class="control-label col-md-4">Default Datepicker</label>
														<div class="col-md-8">
															<input class="form-control input-medium date-picker" size="16" type="text" value=""/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Disable Past Dates</label>
														<div class="col-md-8">
															<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" readonly>
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
														<label class="control-label col-md-4">Start With Years</label>
														<div class="col-md-8">
															<div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
																<input type="text" class="form-control" readonly>
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- /input-group -->
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Months Only</label>
														<div class="col-md-8">
															<div class="input-group input-medium date date-picker" data-date="10/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
																<input type="text" class="form-control" readonly>
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- /input-group -->
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Date Range</label>
														<div class="col-md-8">
															<div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
																<input type="text" id="drpFromdate" class="form-control" name="from">
																<span class="input-group-addon">
																to </span>
																<input type="text" id="drpTodate" class="form-control" name="to">
															</div>
															<!-- /input-group -->
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