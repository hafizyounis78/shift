<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-home"></i>Add New Locations
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="form_sample_3" class="form-horizontal">
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
                                <select class="form-control input-large select2me" data-placeholder="Select...">
                                    <option value=""></option>
                                    <option value="AL">EDEKA</option>
                                    <option value="WY">Our Location</option>
                                    <option value="AL">EDEKA1</option>
                                    <option value="WY">EDEKA2</option>
                                </select>
                                <span class="help-block">
                                .Select Location</span>
                            </div>
                        </div>
                      
                      <div class="form-group">
                          <label class="control-label col-md-3">Description</label>
                          <div class="col-md-9">
                              <textarea class="form-control" name="markdown" data-provide="markdown" rows="10" data-error-container="#editor_error"></textarea>
                              <div id="editor_error">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">As Component</label>
                          <div class="col-md-3">
                              <div class="input-group color colorpicker-default" data-color="#3865a8" data-color-format="rgba">
                                  <input type="text" class="form-control" value="#3865a8" readonly>
                                  <span class="input-group-btn">
                                  <button class="btn default" type="button"><i style="background-color: #3865a8;"></i>&nbsp;</button>
                                  </span>
                              </div>
                              <!-- /input-group -->
                          </div>
                      </div>
                      
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Save</button>
                              <!--<button type="button" class="btn default">Cancel</button>-->
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
      <div class="portlet box blue">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-home"></i>Locations
              </div>
              
          </div>
          <div class="portlet-body">
              <div class="table-scrollable">
                  <table class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th width="10%">
                           #
                      </th>
                      <th width="20%"> 
                          Location Name
                      </th>
                      <th width="60%">
                           Description
                      </th>
                     
                      <th width="10%">
                           
                      </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="active">
                      <td>
                           1
                      </td>
                      <td>
                           active
                      </td>
                      <td>
                           Column heading
                      </td>
                      <td>
                           Column heading
                      </td>
                      
                  </tr>
                  <tr class="success">
                      <td>
                           2
                      </td>
                      <td>
                           success
                      </td>
                      <td>
                           Column heading
                      </td>
                      <td>
                           Column heading
                      </td>
                      
                  </tr>
                  <tr class="warning">
                      <td>
                           3
                      </td>
                      <td>
                           warning
                      </td>
                      <td>
                           Column heading
                      </td>
                      <td>
                           Column heading
                      </td>
                      
                  </tr>
                  <tr class="danger">
                      <td>
                           4
                      </td>
                      <td>
                           danger
                      </td>
                      <td>
                           Column heading
                      </td>
                      <td>
                           Column heading
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
<!-- END PAGE CONTENT-->