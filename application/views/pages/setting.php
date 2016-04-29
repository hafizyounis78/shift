<?php
$action ="addtimeoff";

$readonly = '';
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-clock-o"></i>Time coloring 
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
                      <input type="hidden" name="hdnaction" id="hdnaction" value="<?php echo $action; ?>" />
                      <input type="hidden" name="hdnshiftId" id="hdnshiftId" value="<?php echo $action; ?>" />
                      
                      
                      <div class="form-group">
                            <label class="col-md-3 control-label">Time Range</label>
                            <div class="col-md-4">
                                <div id="slider-range" class="slider  bg-red">
                                </div>
                                <div>
                                     Value: <span id="slider-range-amount">
                                    </span>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Save</button>
                              <button type="button" class="btn default" onclick="clearfimeoffForm()">Cancel</button>
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
