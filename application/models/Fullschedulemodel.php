<?php

class Fullschedulemodel extends CI_Model
{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Gaza');   
	}

	// Get Locations
	function get_shift_templates()
	{
		$this->db->from('dusseldorf_v3_shift_templates');
		//$this->db->order_by("show_order", "asc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function insert_shift_template()
	{
		extract($_POST);

		$data['name'] = $txtName;
		$data['start_time'] = $txtFrom;
		$data['end_time'] = $txtTo;
		$data['lunch_break'] = $drpBreak;
		
		$this->db->insert('dusseldorf_v3_shift_templates',$data);
	}
	
	/*public function get_my_shift()//user shift
	{
		
					 
				extract($_POST);
				if($dept_id!='')
		{
			 
		 $myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.name, loc.color, loc.id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
					  FROM    dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users b
					  where   sft.location_id = loc.id
					  AND     start_date >2016 -04 -01 
					  and     b.id = sft.user_id
					  and     sft.user_id=".$segment_4."
					  AND     dep_id=".$dept_id;
		}
		else
		{
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, sft.type,loc.name, loc.color, loc.id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
					  FROM    dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users b
					  where   sft.location_id = loc.id
					  AND     start_date >2016 -04 -01 
					  and     b.id = sft.user_id
					  and     sft.user_id=".$segment_4;
		}
        return $this->db->query($myquery);
	}*/
	function get_emails($drpFromdate)
	{
		
		$drpTodate = date('Y-m-d', strtotime($drpFromdate .'+6 day'));
		$myquery = "SELECT 	email1
					FROM 	dusseldorf_v3_shifts sft,dusseldorf_users b
					where 	b.id=sft.user_id
					AND     b.id in (select  user_id 
   								     from   dusseldorf_v3_shifts
									 where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
									 OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
									 OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
									 OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."')))";
									 
		return $this->db->query($myquery);


	}
	public function get_all_shift()//Calender View
	{
		
		
		//******************general manager***************//
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
				return;*/
				$dept_id='';
		extract($_POST);
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND b.dep_id=".$dept_id;
				}
		if ($this->session->userdata('itemname')=='admin')
		
		$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
		
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name,'(', dep_name,')' )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c,departments d
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								and b.dep_id=d.dep_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time 
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'";
								
		else if ($this->session->userdata('itemname')=='gm')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
		
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name,'(', dep_name,')' )
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c,departments d
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								and b.dep_id=d.dep_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id').
								" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'";
		else if ($this->session->userdata('itemname')=='circle_man')
			$myquery = "SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.map_id, (
			
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name,'(', dep_name,')' )
									SEPARATOR ', ' )
									FROM dusseldorf_users b, dusseldorf_v3_shifts c,departments d
									WHERE b.id = c.user_id
									AND location_id = sft.location_id
									and b.dep_id=d.dep_id
									AND start_date = sft.start_date
									AND end_date = sft.end_date
									AND start_time = sft.start_time
									AND end_time = sft.end_time
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id									
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
								  and     sft.user_id=".$this->session->userdata('user_id');
								  
		
		return $this->db->query($myquery);

	}
/*public function get_shiftByDate()//Calender View
	{
		
		
		
				$dept_id='';
		extract($_POST);
		$drpFromdate='2016-06-25';
		$drpTodate='2016-06-30';
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND b.dep_id=".$dept_id;
				}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."' and end_date>='".$drpTodate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								and   b.dept_parent=315
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								and start_date>='2016-06-25' and end_date<='2016-06-30'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=315
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."' and end_date>='".$drpTodate."'							
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."' and end_date>='".$drpTodate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
								  order by start_date";
								  
		
		return $this->db->query($myquery);

	}*/
	
	// First Day
	public function get_shift_day1()//Calender View
	{
		$dept_id='';
		extract($_POST);
		
		
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND b.dep_id=".$dept_id;
				}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'							
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
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
					$dep_filter = "AND b.dep_id=".$dept_id;
				}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									".$dep_filter."
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
									".$dep_filter."
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
									and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
								  order by start_date";
								  
		
		return $this->db->query($myquery);

	}	
	// THIRD Day
	public function get_shift_day3()//Calender View
	{
		
		
		//******************general manager***************//
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
				return;*/
				$dept_id='';
		extract($_POST);
		$drpFromdate = date('Y-m-d', strtotime($drpFromdate . ' +2 day'));
		
				$dep_filter = '';		
				if($dept_id!= 0 && $dept_id!='')
				{
					$dep_filter = "AND b.dep_id=".$dept_id;
				}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
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
			$dep_filter = "AND b.dep_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
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
			$dep_filter = "AND b.dep_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
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
			$dep_filter = "AND b.dep_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
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
			$dep_filter = "AND b.dep_id=".$dept_id;
		}
		if ($this->session->userdata('itemname')=='admin')
		
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
								".$dep_filter."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and sft.location_id = loc.map_id
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date ";
								
		else if ($this->session->userdata('itemname')=='gm')
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
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and start_date<='".$drpFromdate."'
								and end_date >= '".$drpFromdate."'
								and   sft.location_id = loc.map_id								
								and   b.dept_parent=".$this->session->userdata('dep_id')."
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'
								order by start_date";
		else if ($this->session->userdata('itemname')=='circle_man')
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
									and   b.dep_id=".$this->session->userdata('dep_id')."
									) AS emp_name
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users users
									where users.id=sft.user_id
   									and sft.location_id = loc.map_id		
									and start_date<='".$drpFromdate."'
								    and end_date >= '".$drpFromdate."'
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING start_date >'2016-04-01'
									order by start_date";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color,loc.map_id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								  where   sft.location_id = loc.map_id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
    							  and start_date<='".$drpFromdate."'
								  and end_date >= '".$drpFromdate."'
								  and     sft.user_id=".$this->session->userdata('user_id')."
								  order by start_date";
								  
		
		return $this->db->query($myquery);

	}
}
?>