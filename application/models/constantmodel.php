<?php
class Constantmodel extends CI_Model
{
	
	
	//************* get Location*********//
	function get_location_list()
	{	
	
		$query = $this->db->get('dusseldorf_v3_locations');
		return $query->result();
		
	}
	function get_staff_list()
	{
		
		
		$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name FROM dusseldorf_users where type=2";
		
		$res = $this->db->query($myquery);
		return $res->result();
	}
function getUser_byDept()
{
	extract($_POST);
	$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name FROM dusseldorf_users where type=2 and depart_id=".$deptNo;
		
		$res = $this->db->query($myquery);
		return $res->result();
}	
}
?>