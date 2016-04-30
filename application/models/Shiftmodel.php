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
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_locations.id as locationId,Special_shift,name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
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
