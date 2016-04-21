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
	
	
}

?>
