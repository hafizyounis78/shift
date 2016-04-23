<?php

class Timeoffmodel extends CI_Model
{
	// Get Locations
	
	function insert_timeoff()
	{
		extract($_POST);
	//	print_r($_POST);
		$staffid = explode(",", $staffList);
		foreach($staffid as $element)
		{
		
		
		$data['location_id'] = $drpLocation;
		$data['start_date'] = $drpFromdate;
		$data['end_date'] = $drpTodate;
		$data['start_time'] = $txtStart;
		$data['end_time'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['user_id'] = $element;
		$data['type'] = 2;
		$this->db->insert('dusseldorf_v3_shifts',$data);
		}
	}
	function get_all_timeoff()
	{	
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_locations.id as locationId,name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,dusseldorf_v3_locations,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=dusseldorf_v3_locations.id
					AND      user_id=dusseldorf_users.id";
        $rec=$this->db->query($myquery);
		return $rec->result();


	}
	function update_timeoff()
	{	
		extract($_POST);
		$data['location_id'] = $drpLocation;
		$data['start_date'] = $drpFromdate;
		$data['end_date'] = $drpTodate;
		$data['start_time'] = $txtStart;
		$data['end_time'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['type'] = 2;
		$this->db->where('id',$hdnshiftId);
		$this->db->update('dusseldorf_v3_shifts',$data);
	}
	
}

?>
