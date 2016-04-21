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
	public function get_all_shift()//,$cut_id)
	{
		 $myquery = "SELECT sft.id, sft.start_date, sft.start_time , sft.end_time, sft.end_date,
		 					sft.location_id,loc.name,loc.color 
		 			   FROM dusseldorf_v3_shifts sft, dusseldorf_v3_locations loc 
					   WHERE sft.location_id = loc.id
					   AND start_date > 2016-04-01 ";
        return $this->db->query($myquery);

	}
}
?>