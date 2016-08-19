
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-clock-o"></i><?php echo $this->lang->line('Time Coloring'); ?> 
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="SettingColorForm" class="form-horizontal">
                  <div class="form-body">
                      
                      <div class="alert alert-danger display-hide">
                          <button class="close" data-close="alert"></button>
                          You have some form errors. Please check below.
                      </div>
                      <div class="alert alert-success display-hide">
                          <button class="close" data-close="alert"></button>
                          Ihre Einstellung war erfolgreich!
                      </div>
                      
                      
                      <div class="form-group">
                            <label class="control-label col-md-3">Slider Start<?php echo $this->lang->line('Time');?><span class="required">
                          * </span></label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-24" data-minute-step="30" id="txtStartSldr"  name="txtStartSldr"  >
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                      
                      <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo $this->lang->line('Time Range');  ?></label>
                            <div class="col-md-6">
                                <div id="slider-range" class="slider">
                                </div>
                                <div>
                                     <?php echo $this->lang->line('Open/Close');?>:
                                     <br/>
                                     <span id="spnClose" style="background-color: #FF6F6F" data-starttime="" data-endtime="">
                                     
                                    </span>
                                    <br/>
                                    <span id="spnEmp" style="background-color: #FFFF62" data-starttime="" data-endtime="">
                                     
                                    </span>
                                    <br/>
                                    <span id="spnOpen" style="background-color: #A3EE57" data-starttime="" data-endtime="">
                                     
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="button" class="btn green" onclick="editColorSetting()"><?php echo $this->lang->line('Save');  ?></button>
                              <button type="button" class="btn default" ><?php echo $this->lang->line('Cancel');?></button>
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
