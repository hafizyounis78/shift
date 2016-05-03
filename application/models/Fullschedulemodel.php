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
	
	public function get_my_shift()//user shift
	{
		
					 
				extract($_POST);
				if($dept_id!='')
		{
			 
		 $myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color, loc.id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
					  FROM    dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users b
					  where   sft.location_id = loc.id
					  AND     start_date >2016 -04 -01 
					  and     b.id = sft.user_id
					  and     sft.user_id=".$segment_4."
					  AND     dep_id=".$dept_id;
		}
		else
		{
			$myquery = " SELECT  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color, loc.id,CONCAT( b.first_name, ' ', b.last_name ) as emp_name
					  FROM    dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users b
					  where   sft.location_id = loc.id
					  AND     start_date >2016 -04 -01 
					  and     b.id = sft.user_id
					  and     sft.user_id=".$segment_4;
		}
        return $this->db->query($myquery);
	}
	public function get_all_shift()//,$cut_id)
	{
		/* $myquery = "SELECT    sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color, loc.id
					 FROM      dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc
					 GROUP BY  sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color
					 HAVING    sft.location_id = loc.id
					 AND       start_date >2016 -04 -01";*/
		extract($_POST);
		if($dept_id!='')
		{
		$myquery = " SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color, loc.id, (

						SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
						SEPARATOR ', ' )
						FROM dusseldorf_users b, dusseldorf_v3_shifts c
						WHERE b.id = c.user_id
						AND location_id = sft.location_id
						AND start_date = sft.start_date
						AND end_date = sft.end_date
						AND start_time = sft.start_time
						AND end_time = sft.end_time
						AND dep_id=".$dept_id."
						) AS emp_name
						FROM dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc,dusseldorf_users u
						where sft.user_id = u.id
						AND dep_id=".$dept_id."
						GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color
						HAVING sft.location_id = loc.id
						AND start_date >2016 -04 -01";			 
		}
		else
		{
		 $myquery = " SELECT sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color, loc.id, (

						SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name )
						SEPARATOR ', ' )
						FROM dusseldorf_users b, dusseldorf_v3_shifts c
						WHERE b.id = c.user_id
						AND location_id = sft.location_id
						AND start_date = sft.start_date
						AND end_date = sft.end_date
						AND start_time = sft.start_time
						AND end_time = sft.end_time
						) AS emp_name
						FROM dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc
						GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.name, loc.color
						HAVING sft.location_id = loc.id
						AND start_date >2016 -04 -01 ";
		}
        return $this->db->query($myquery);

	}
}
?>