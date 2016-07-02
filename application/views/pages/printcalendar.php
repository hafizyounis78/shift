<style>


</style>
<!-- BEGIN PAGE CONTENT-->
<?php 


date_default_timezone_set('Asia/Gaza');   
	$today_date = date('y-m-d');
		//echo $today_date;
		$last_monday=date('Y-m-d',strtotime('last monday'));  // for first day of this week
		$next_monday=date('Y-m-d',strtotime('next monday'));  // for first day of this week
		$parts = explode('-', $last_monday);
		//echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime('2016-07-04')));
		//echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($today_date)));
?>

<!--search form-->
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box green">
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-clock-o"></i>Print Plan
                  <input type="button" id="btnprint" name="btnprint"  onclick="printcal();"  value="Print" />
                   <input type="button" id="btnpdf" name="btnpdf"  onclick="creatreport();"  value="Pdf" />
              </div>
              
          </div>
          <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form action="#" id="searchForm" class="form-horizontal">
                  <div class="form-body">
                       <div id="dvStaffMsg" class="alert alert-danger display-none">
                         <button class="close" data-dismiss="alert"></button>
                         You should select at least one staff.
                      </div>
                      <div id="dvDeptMsg" class="alert alert-danger display-none">
                         <button class="close" data-dismiss="alert"></button>
                         You should select Location ,date ,start time and end time before selecting department. Please check below.
                      </div>
                      <div class="alert alert-danger display-hide">
                          <button class="close" data-close="alert"></button>
                          You have some form errors. Please check below.
                      </div>
                      <div class="alert alert-success display-hide">
                          <button class="close" data-close="alert"></button>
                          Your form validation is successful!
                      </div>
                      
                      
                      <!--<div class="form-group">
                        <label class="control-label col-md-3"><?php echo $this->lang->line('Date');  ?><span class="required">
                          * </span></label>
                        <div class="col-md-6">
                            <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                <input type="text" id="drpFromdate" class="form-control shiftclassConflict" name="drpFromdate" >
                                <span class="input-group-addon">
                                to </span>
                                <input type="text" id="drpTodate" class="form-control shiftclassConflict" name="drpTodate" >
                            </div>
                          
                        </div>
                    </div>-->
                      
                        
                      
                   
                    <!--<div class="form-group" id="divDept">
                          <label class="control-label col-md-3"><?php echo $this->lang->line('Department');  ?>  <span class="required">
                          * </span>
                          </label>
                          <div class="col-md-4">
                              <select id="drplstDept" class="form-control" name="drplstDept" onchange="drpdeptChange();">
                              <option value=""><?php echo $this->lang->line('select');  ?>...</option>
                                <?php/* 
								   if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	   
							 		echo '<option value="0">'.$this->lang->line('All Department').'</option>';
							
								  foreach ($deptList as $dept_row)
								  {
									  $selected = '';
									  
									  echo ' <option value="'.$dept_row->dep_id.'" '.$selected.'>'
									  						 .$dept_row->dep_name.'</option>';
								  }*/
								  ?>

                              </select>
                          </div>
                      </div>-->
                    <div class="clearfix">
													

                        <div class="btn-group btn-group-circle btn-group-solid">
                            <button type="button" class="btn red" id="lastMondy" value="<?php echo $last_monday ?>"  onclick="get_lastschedual()">&lt;</button>
                            <button type="button" class="btn green" id="nextMondy" value="<?php echo $next_monday ?>" onclick="get_nextschedual()">&gt;</button>
                        </div>
                    </div>
                  </div>
                  <!--<div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green"><?php echo $this->lang->line('Save'); ?></button>
                              <button type="button" class="btn default" onclick="clearShiftForm();"><?php echo $this->lang->line('Cancel'); ?></button>
                          </div>
                      </div>
                  </div>-->
              </form>
              <!-- END FORM-->
          </div>
          <!-- END VALIDATION STATES-->
          
      </div>
  </div>
</div>
<!--end search form-->
<div class="row">
<div id="dvTable" class="col-md-12"> 
<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>PLAN
							</div>
							<div class="tools">
							</div>
						</div>
   <div class="portlet-body"> 
	  <table class="table table-striped table-bordered table-hover" id="calenderTable">
        <thead>
          <tr>
            <th scope="col"><?php echo date('D',strtotime($last_monday)).' '.$last_monday; ?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+1,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+1,$parts[0]));?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+2,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+2,$parts[0]));?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+3,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+3,$parts[0]));?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+4,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+4,$parts[0]));?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+5,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+5,$parts[0]));?></th>
            <th scope="col"><?php echo date('D',mktime(0, 0, 0, $parts[1], $parts[2]+6,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+6,$parts[0]));?></th>            
          </tr>
          </thead>
          <tbody id="shedul_body">
<?php       
			$max_row = count($day1);
			if (count($day2) > $max_row)
				$max_row = count($day2);
			if (count($day3) > $max_row)
				$max_row = count($day3);
			if (count($day4) > $max_row)
				$max_row = count($day4);
			if (count($day5) > $max_row)
				$max_row = count($day5);
			if (count($day6) > $max_row)
				$max_row = count($day6);
			if (count($day7) > $max_row)
				$max_row = count($day7);
				
			
			$i=0;	
			while($max_row != 0)
			{
				echo '<tr>';
				if(isset($day1[$i]->name))
					echo "<td style='background-color:".$day1[$i]->color."'>".$day1[$i]->start_time." - ".$day1[$i]->end_time."<br/> Location : ".$day1[$i]->name."<br/> Employees : ".$day1[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day2[$i]->name))
					echo "<td style='background-color:".$day2[$i]->color."'>".$day2[$i]->start_time." - ".$day2[$i]->end_time."<br/> Location : ".$day2[$i]->name."<br/> Employees : ".$day2[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day3[$i]->name))
					echo "<td style='background-color:".$day3[$i]->color."'>".$day3[$i]->start_time." - ".$day3[$i]->end_time."<br/> Location : ".$day3[$i]->name."<br/> Employees : ".$day3[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day4[$i]->name))
					echo "<td style='background-color:".$day4[$i]->color."'>".$day4[$i]->start_time." - ".$day4[$i]->end_time."<br/> Location : ".$day4[$i]->name."<br/> Employees : ".$day4[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day5[$i]->name))
					echo "<td style='background-color:".$day5[$i]->color."'>".$day5[$i]->start_time." - ".$day5[$i]->end_time."<br/> Location : ".$day5[$i]->name."<br/> Employees : ".$day5[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
					
				if(isset($day6[$i]->name))
					echo "<td style='background-color:".$day6[$i]->color."'>".$day6[$i]->start_time." - ".$day6[$i]->end_time."<br/> Location : ".$day6[$i]->name."<br/> Employees : ".$day6[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';	
				if(isset($day7[$i]->name))
					echo "<td style='background-color:".$day7[$i]->color."'>".$day7[$i]->start_time." - ".$day7[$i]->end_time."<br/> Location : ".$day7[$i]->name."<br/> Employees : ".$day7[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';	
					
				
				echo '</tr>';
				
				$i++;
				$max_row--;	
			}
			
				?>
		           </tbody>
        </table>

    </div>
</div>
</div>
</div>
<!-- END PAGE CONTENT-->
