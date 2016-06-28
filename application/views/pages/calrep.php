<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #999999;
	padding: 5px
}
</style>
</head>

<body>
<?php 


date_default_timezone_set('Asia/Gaza');   
	$today_date = date('y-m-d');
		//echo $today_date;
		$last_monday=date($this->session->userdata('startDate'),strtotime('last monday'));  // for first day of this week
		$next_monday=date($this->session->userdata('startDate'),strtotime('next monday'));  // for first day of this week
		$parts = explode('-', $last_monday);
		//echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime('2016-07-04')));
		//echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($today_date)));
?>
<table id="calenderTable" >
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
</body>
</html>
