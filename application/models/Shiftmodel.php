<?php

class Shiftmodel extends CI_Model
{
	
	
	function insert_shift()
	{
		extract($_POST);
		print_r($_POST);
		$staffid = explode(",", $staffList);
		foreach($staffid as $element)
		{
		
		$data['type'] = $rdShifttype;
		$data['location_id'] = $drpLocation;
		$data['date'] = $drpFromdate;
		$data['date_end'] = $drpTodate;
		$data['start'] = $txtStart;
		$data['end'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['lunch_break'] = $drplstBreak;
		$data['user_id'] = $element;
		
		$this->db->insert('dusseldorf_shifts',$data);
		}
		
		
	}
	
	
}

?>
