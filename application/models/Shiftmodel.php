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
		$data['Special_shift'] = $chbxIsspecial;
		$data['Notification_req'] = $ckbNotification;
		
		$data['lunch_break'] = $drplstBreak;
		$data['user_id'] = $element;
		
		$this->db->insert('dusseldorf_v3_shifts',$data);
		}
		
		
	}
function get_all_shifts()
{	
 if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id";
else if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and dusseldorf_users.dept_parent=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='circle_man')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and dusseldorf_users.dep_id=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and dusseldorf_users.id=".$this->session->userdata('user_id');


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
	$data['Special_shift'] = $chbxIsspecial;
	$data['Notification_req'] = $ckbNotification;
	$this->db->where('id',$hdnshiftId);
	$this->db->update('dusseldorf_v3_shifts',$data);
}

function delete_shift()
{
	extract($_POST);
	$this->db->where('id',$shiftId);
	$this->db->delete('dusseldorf_v3_shifts');
}	
	
}

?>
