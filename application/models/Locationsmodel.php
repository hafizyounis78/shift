<?php

class Locationsmodel extends CI_Model
{
	// Get Locations
	function get_locations()
	{
		$this->db->from('dusseldorf_v3_locations');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function insert_locations()
	{
		extract($_POST);

		$data['name'] = $txtName;
		$data['description'] = $txtDescription;
		$data['color'] = $txtColor;
		
		$this->db->insert('dusseldorf_v3_locations',$data);
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
	
}

?>
