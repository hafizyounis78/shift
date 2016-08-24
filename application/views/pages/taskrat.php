<!--
<div class="row">
  <div class="col-md-12">
      
           
          
      </div>
  </div>-->

<!--<div class="row">
    <div class="col-md-12">-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box purple">
            <div class="portlet-title">
              
                <div class="caption">
                    <i class="fa fa-clock-o"></i>Aufgabe Rate
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
                             <?php echo $this->lang->line('Department');?>
                        </th>
                        <th>
                             Aufgabe Rate 
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody id="taskrate_body">

                    <?php
                    $i=1;
                  if (isset($taskraterec))
                        foreach($taskraterec as $row)
                            {
                                
                                 echo '<tr>';		
                                 echo '<td>'.$i++.'</td>';
                                 echo '<td >'.$row->Staff_name.'</td>';
                                 echo '<td >'. $row->dep_name.'</td>';
                                 echo '<td >'. $row->tsk_rate.'</td>';
                                
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
