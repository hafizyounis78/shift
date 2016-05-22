<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-home"></i><?php echo $this->lang->line('Add new locations');  ?>
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="locationForm" class="form-horizontal">
                  <div class="form-body">
                      
                      <div class="alert alert-danger display-hide">
                          <button class="close" data-close="alert"></button>
                          You have some form errors. Please check below.
                      </div>
                      <div class="alert alert-success display-hide">
                          <button class="close" data-close="alert"></button>
                          Your form validation is successful!
                      </div>
                      <input id="hdnId" name="hdnId" type="hidden" value="" />
                      <div class="form-group">
                            <label class="control-label col-md-3"><?php echo $this->lang->line('Location Name');  ?></label>
                            <div class="col-md-4">
                                <input id="txtName" name="txtName" type="text" class="form-control form-filter input-sm" >
                            </div>
                        </div>
                      
                      <div class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Description');  ?></label>
                          <div class="col-md-4">
                              <textarea id="txtDescription" name="txtDescription" class="form-control"  data-provide="markdown" rows="2" data-error-container="#editor_error"></textarea>
                              <div id="editor_error">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Color'); ?></label>
                          <div class="col-md-3"><!--#3865a8-->
                              <div id="dvColor" class="input-group color colorpicker-default" data-color="#ffffff" data-color-format="rgba">
                                  <input id="txtColor" name="txtColor" type="text" class="form-control" value="#ffffff">
                                  <span class="input-group-btn">
                                  <button class="btn default" type="button"><i id="iColor" style="background-color: #ffffff;"></i>&nbsp;</button>
                                  </span>
                              </div>
                              <!-- /input-group -->
                          </div>
                      </div>
                      
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button id="btnSaveLocations" type="button" class="btn green"><?php echo $this->lang->line('Save'); ?></button>
                              <button type="button" class="btn default" onclick="clearForm()"><?php echo $this->lang->line('Cancel'); ?></button>
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
                  <i class="fa fa-home"></i> <?php echo $this->lang->line('Locatios');  ?>
              </div>
              
          </div>
          <div class="portlet-body">
              <div class="table-scrollable">
                  <table class="table table-hover">
                  <thead>
                  <tr>
                      <th width="10%">
                           #
                      </th>
                      <th width="20%"> 
                          <?php echo $this->lang->line('Location Name');  ?>
                      </th>
                      <th width="60%">
                          <?php echo $this->lang->line('Description');  ?>
                      </th>
                     
                      <th width="10%" >
                           
                      </th>
                  </tr>
                  </thead >
                  <tbody id="tbLocations">
                  <?php
				  $i=1;
				  foreach($locations as $row)
				  {
					 if ($row->color == '')
					 	$color = 'style="background-color:#ffffff;cursor:pointer"';
					 else
					 	$color = 'style="background-color:'.$row->color.';cursor:pointer"';
						
					 echo '<tr '.$color.'>';
					 echo '<td id="tdOrder'.$row->id.'"       onclick="selectRow('.$row->id.')">'. $i.	 		'</td>';
					 echo '<td id="tdName' .$row->id.'"       onclick="selectRow('.$row->id.')">'. $row->name.		'</td>';
					 echo '<td id="tdDescription'.$row->id.'" onclick="selectRow('.$row->id.')">'. $row->description.'</td>';
					 echo '<td id="tdColor'.$row->id.'" data-color="'.$row->color.'">';
					 if ($i != 1)
						echo '<i class="fa fa-arrow-up order" aria-hidden="true"  onclick="order('.$row->id.',\'-1\')"></i>';
					 if ($i != count($locations) )
					 	echo '<i class="fa fa-arrow-down order" aria-hidden="true" onclick="order('.$row->id.',\'+1\')"></i>';
					 echo '</td>';
					 echo '<tr/>';
					 
					 $i++;
				  }
				  ?>
                 <!-- <tr class="active" >
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
                      
                  </tr>-->
                  </tbody>
                  </table>
              </div>
          </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
  </div>
  
</div>
<!-- END PAGE CONTENT-->