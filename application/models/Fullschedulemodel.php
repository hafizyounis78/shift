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
		$data['start'] = $txtFrom;
		$data['end'] = $txtTo;
		$data['lunch_break'] = $drpBreak;
		
		$this->db->insert('dusseldorf_v3_shift_templates',$data);
	}
}
?>