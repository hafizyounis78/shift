<?php

class Weektempmodel extends CI_Model
{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Gaza');   
	}
	public function copyshift()
	{
		$dept_id='';
		extract($_POST);
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		
		 $drptodate = date('Y-m-d', strtotime($drpFromdate . ' +6 day'));
		 if ($this->session->userdata('itemname')=='gm')
		 
			$myquery ="insert into dusseldorf_v3_shifts(start_date,start_time,end_date,end_time,status,group_id,user_id,location_id,has_trade,type,lunch_break,Special_shift,Notification_req,leavereason)
								SELECT DATE_ADD(start_date,INTERVAL ".$interval." DAY),start_time,DATE_ADD(end_date,INTERVAL ".$interval." DAY),end_time,status,group_id,user_id,location_id,has_trade,type,lunch_break,Special_shift,Notification_req,leavereason
								FROM dusseldorf_v3_shifts sft,task_map_dep loc
								WHERE start_date >= '".$drpFromdate."'
								AND end_date <= '".$drptodate."'
								AND sft.location_id=loc.map_id
								".$dep_filter."							
								AND TYPE !=2";		
		
				
		return $this->db->query($myquery);				
	
	}

	public function get_shift_day1()//Calender View
	{
		$dept_id='';
		extract($_POST);
		
		
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND loc.dep_child_id=".$dept_id;
				}

								
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c,task_map_dep loc
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   sft.location_id = loc.map_id	
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		
		return $this->db->query($myquery);

	}	
	
	// Secand Day
	public function get_shift_day2()//Calender View
	{
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate . ' +1 day'));
	
		
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND loc.dep_child_id=".$dept_id;
				}
		
								
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
								  
		
		return $this->db->query($myquery);

	}	
	// THIRD Day
	public function get_shift_day3()//Calender View
	{
		
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate . ' +2 day'));
		
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		return $this->db->query($myquery);

	}	
	// FOUR Day
	public function get_shift_day4()//Calender View
	{
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate . ' +3 day'));
		
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
								  
		
		return $this->db->query($myquery);

	}	
	// FIVE Day
	public function get_shift_day5()//Calender View
	{	
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate . ' +4 day'));
		
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
								  
		
		return $this->db->query($myquery);

	}	
	// SEX Day
	public function get_shift_day6()//Calender View
	{
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate .'+5 day'));
		
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
								  
		
		return $this->db->query($myquery);

	}
	// SIVEN Day	
	public function get_shift_day7()//Calender View
	{
		$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate .'+6 day'));
		
		$dep_filter = '';		
		if($dept_id!= 0 && $dept_id!='')
		{
			$dep_filter = "AND loc.dep_child_id=".$dept_id;
		}
		
		 if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								AND   sft.TYPE !=2
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		
		return $this->db->query($myquery);

	}
}
?>