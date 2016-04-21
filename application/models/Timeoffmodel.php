<?php

class Timeoffmodel extends CI_Model
{
	// Get Locations
	function get_locations()
	{
		$this->db->from('dusseldorf_v3_locations');
		$this->db->order_by("show_order", "asc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function insert_timeoff()
	{
		extract($_POST);
		print_r($_POST);
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
	function update_locations()
	{
		extract($_POST);

		$data['name'] = $txtName;
		$data['description'] = $txtDescription;
		$data['color'] = $txtColor;
		
		$this->db->where('id',$hdnId);
		$this->db->update('dusseldorf_v3_locations',$data);
	}
	function updateLocation_order()
	{
		extract($_POST);
		// Move Up
		if ($varOrderOpr == "-1")
		{
			$newOrder = $varOrder - 1;
		}
		// Move Down
		else if ($varOrderOpr == "+1")
		{
			$newOrder = $varOrder + 1;
		}
		
		// Swap
		$data['show_order'] = $varOrder;
		
		$this->db->where('show_order',$newOrder);
		$this->db->update('dusseldorf_v3_locations',$data);	
		
		$data['show_order'] = $newOrder;
		
		$this->db->where('id',$varId);
		$this->db->update('dusseldorf_v3_locations',$data);
		
	}
	
}

?>
