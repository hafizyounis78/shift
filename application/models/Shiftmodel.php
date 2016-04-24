<?php

class Shiftmodel extends CI_Model
{
	
	
	function insert_shift()
	{
		extract($_POST);
		print_r($_POST);
		$staffid = explode(",", $staffList);
		if (!isset($rdShifttype))
		   $shftype=1;
		else
		     $shftype=$rdShifttype;
		foreach($staffid as $element)
		{
		
		$data['type'] = $shftype;
		$data['location_id'] = $drpLocation;
		$data['start_date'] = $drpFromdate;
		$data['end_date'] = $drpTodate;
		$data['start_time'] = $txtStart;
		$data['end_time'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['lunch_break'] = $drplstBreak;
		$data['user_id'] = $element;
		
		$this->db->insert('dusseldorf_v3_shifts',$data);
		}
		
		
	}
function get_all_shifts()
	{	
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_locations.id as locationId,name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,dusseldorf_v3_locations,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=dusseldorf_v3_locations.id
					AND      user_id=dusseldorf_users.id";
        $rec=$this->db->query($myquery);
		return $rec->result();


	}	
function update_shift()
{	
	extract($_POST);
	$data['location_id'] = $drpLocation;
	$data['start_date'] = $drpFromdate;
	$data['end_date'] = $drpTodate;
	$data['start_time'] = $txtStart;
	$data['end_time'] = $txtEnd;
	$data['status'] = $rdStatus;
	//$data['type'] = 2;
	$this->db->where('id',$hdnshiftId);
	$this->db->update('dusseldorf_v3_shifts',$data);
}
function getUser_byDept()
{
	extract($_POST);

	$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and depart_id=".$deptNo."
				and id not in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  start_date=".$drpFromdate."
							   and    end_date=".$drpTodate."
							   and    start_time=".txtStart." 
							   and    end_time=".txtEnd.")";
		
		$res = $this->db->query($myquery);
		return $res->result();
}
function delete_shift()
{
	extract($_POST);
	$this->db->where('id',$shiftId);
	$this->db->delete('dusseldorf_v3_shifts');
}	
	
}

?>
