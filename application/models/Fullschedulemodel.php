<?php

class Fullschedulemodel extends CI_Model
{
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
	public function get_all_shift()//Calender View
	{
		
		
		//******************general manager***************//
		if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
				return;
		extract($_POST);
				$dep_filter = '';		
				if($dept_id!=0)
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
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING sft.location_id = loc.map_id
								AND start_date >'2016-04-01'";
								
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
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dep_man,departments,dusseldorf_users b
								where b.id=sft.user_id
								".$dep_filter."
								and   b.dept_parent=".$this->session->userdata('dep_id').
								" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING sft.location_id = loc.map_id
								AND start_date >'2016-04-01'";
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
									FROM dusseldorf_v3_shifts sft, task_map_dep loc,dep_man,departments,dusseldorf_users users
									where users.id=sft.user_id
									and   users.dep_id=".$this->session->userdata('dep_id').
									" GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
									HAVING sft.location_id = loc.map_id
									AND start_date >'2016-04-01'";
		else if ($this->session->userdata('itemname')=='emp')
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as name, loc.color, loc.id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
								  FROM    dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users b
								  where   sft.location_id = loc.id
								  AND     start_date >2016 -04 -01 
								  and     b.id = sft.user_id
								  and     sft.user_id=".$this->session->userdata('user_id');
								  
		
		return $this->db->query($myquery);

	}
	
}
?>