<script type="text/javascript">

var sessionPerm = "<?php echo $this->session->userdata('itemname'); ?>";

</script>
<?php

$action ="addtimeoff";

$readonly = '';
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
           <div id="timeoffNewModal" class="modal fade">
          			
    <div class="modal-dialog">
     <form action="#" class="form-horizontal" id="timeOffForm" method="post" >
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> <?php echo $this->lang->line('Add Shifts');  ?></h4>
                
                 <div id="dvDeptMsg" class="alert alert-danger display-hide">
                      <button class="close" data-close="alert"></button>
                      You have some form errors. Please check below.
                  </div>
                  <div class="alert alert-success display-hide">
                      <button class="close" data-close="alert"></button>
                      Your form validation is successful!
                  </div>
            </div>
             <input type="hidden" name="hdnaction" id="hdnaction" value="<?php echo $action; ?>" />
             <input type="hidden" name="hdnshiftId" id="hdnshiftId" value="<?php echo $action; ?>" />
                                          
            <div class="modal-body bgColorWhite">
              
               <div class="form-group">
                    <label class="control-label col-md-3"><?php echo $this->lang->line('Date');  ?><span class="required">
                      * </span></label>
                    <div class="col-md-4">
                        <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                            <input type="text" id="drpFromdate" class="form-control timeoffclassConflict" name="drpFromdate" >
                            <span class="input-group-addon">
                            to </span>
                            <input type="text" id="drpTodate" class="form-control timeoffclassConflict" name="drpTodate">
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Time');  ?><span class="required">
                      * </span></label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker timepicker-24 timeoffclassConflict" id="txtStart" name="txtStart" >
                                <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker timepicker-24 timeoffclassConflict" id="txtEnd" name="txtEnd" >
                                <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group" >
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Reason');  ?> Reason <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drpLeavereason" class="form-control" name="drpLeavereason" >
                              	  <option value="0"><?php echo $this->lang->line('select');  ?>...</option>
                            
                                  <option value="1">Annual leave</option>
                                  <option value="2">Sicke leave</option>
                                  <option value="3">emergency leave</option>
                              </select>
                          </div>
                      </div>
                    
                     <?php $disabled='style="display:none"';
                                               // if ($this->session->userdata('itemname') == "gm")
												/*if ($this->itemname == "emp")*/
												
												/*
												 || $this->session->userdata('itemname') == "circle_man"||$this->session->userdata('itemname') == "admin") 
                                                  *///  $disabled='style="display:block"';  
                                                    ?>
                                          <div class="form-group" id="gmDiv"  <?php echo $disabled ?>>
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-6">
                                              <div class="radio-list">
                                                  <label class="radio-inline">
                                                  <input type="radio" name="rdStatus" id="rdStatus1" value="1" checked><?php echo $this->lang->line('Pending');  ?></label>
                                                  <label class="radio-inline">
                                                  <input type="radio" name="rdStatus" id="rdStatus2" value="2"><?php echo $this->lang->line('Active');  ?></label>
                                                  
                                              </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" id="dvstaffname">
                                                <label class="control-label col-md-3"><?php echo $this->lang->line('Staff');  ?> name</label>
                                                <div class="col-md-4">
                                                    <input id="txtstaffName" name="txtstaffName" type="text" class="form-control form-filter input-sm"  disabled="disabled" value="<?php echo $this->session->userdata('staffName') ?>">
                                                     <input id="hdnstaffId" name="hdnstaffId" type="hidden"  value="<?php echo $this->session->userdata('user_id') ?>">
                                                     
                                                </div>
                                            </div>   
                                        </div>
                      
               
                    <div class="modal-footer bg-info">
                <button   type="button" class="btn btn-default" data-dismiss="modal" onclick="clearfimeoffForm();" ><?php echo $this->lang->line('Cancel'); ?></button>
                <button  type="submit" class="btn btn-primary" ><?php echo $this->lang->line('Save');  ?> </button>
            </div>
        </div>
        <!-- /.modal-content -->
         </form>
    </div>
    <!-- /.modal-dialog -->
</div>
          
      </div>
  </div>

<!--<div class="row">
    <div class="col-md-12">-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-clock-o"></i><?php echo $this->lang->line('Timeoff Table'); ?>
                    <button id="btnNewtimeoff" name="btnNewtimeoff" type="submit" value="New" class="btn default btn-xs green" onclick="Newtimeoff('<?php echo $this->session->userdata('user_id') ?>')"><i class="fa fa-plus"></i> </button>
                </div>
                
                
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-hover" id="ShiftDatatable">
                    <thead>
                    <tr>
                        <th>
                             #
                        </th>
                        <th>
                             <?php echo $this->lang->line('Staff');  ?>
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
                             <?php echo $this->lang->line('Locatios'); ?>
                        </th>
                        <th>
                              <?php echo $this->lang->line('Action'); ?>
                        </th>
                         <th>
                             Status
                        </th>
                    </tr>
                    </thead>
                    <tbody id="timeoff_body">

                    <?php
                    $i=1;
                    $statusrow='';
                        foreach($timeoffrec as $row)
                            {
                                if($row->status==1)
                                 $statusrow='anstehend';
                                 else
                                 $statusrow='Aktiviert';
                                 echo '<tr>';		
                                 echo '<td>'.$i++.'</td>';
                                 echo '<td id="tdstaff'.$row->id.'" data-auth="'.$row->itemname.'" data-staffId="'.$row->staffId.'" data-status="'.$row->leavereason.'">'.$row->Staff_name.'</td>';
                                 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
                                 echo '<td id="tdend_date'.$row->id.'">'. $row->end_date.'</td>';
                                 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
                                 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
                                 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
                                 if ($row->status == 1)
                                    echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
                                 else
                                    echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 
                                    
                                 echo '<td>
								 	  
                                      <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updatetimeoff('.$row->id.')">
                                      <i class="fa fa-edit"></i>  </button>
                                      <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deletetimeoff('.$row->id.')"><i class="fa fa-trash-o"></i> </button>';
                                 echo '</td>';  
                                
                                 echo '</tr>';
                            }
                    ?>
                    </tbody>
                    </table>
<!--                    <button id="btnNewtimeoff" name="btnNewtimeoff" type="submit" value="New" class="btn default btn-xs green" onclick="Newtimeoff('.$row->id.')"><i class="fa fa-plus"></i> </button>-->
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
   <!-- </div>
    
</div>-->
<script>
var sessionUserId= "<?php echo $this->session->userdata('user_id'); ?>";
var sessionEmpName= "<?php echo $this->session->userdata('staffName'); ?>";
</script>