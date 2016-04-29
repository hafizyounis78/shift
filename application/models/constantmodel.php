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
function get_dept_list()
	{	
	
		$query = $this->db->get('dusseldorf_departments');
		return $query->result();
		
	}
function get_jobtitle_list()
{	

	$query = $this->db->get('dusseldorf_jobtitle');
	return $query->result();
	
}
function get_spec_list()
	{	
	
		$query = $this->db->get('dusseldorf_specialization');
		return $query->result();
		
	}

function getUser_byDept()
{
extract($_POST);
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and dep_id=".$deptNo."
				and id not in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
							   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
							   
							   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
							   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";


		$res = $this->db->query($myquery);
		return $res->result();
}

function getUser_Jobtitel()
{
extract($_POST);
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and jobtitle_id=".$JobTitelId."
				and id not in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
							   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
							   
							   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
							   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";


		$res = $this->db->query($myquery);
		return $res->result();
}
function getUser_specialization()
{
extract($_POST);
   $myquery = "SELECT u.id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users u ,dusseldorf_specialization_users sp
				where type=2 
				and   u.id=sp.users_id
				and   jobtitle_id=".$JobTitelId."
				and   specialization_id=".$specId."
				and   u.id not in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
							   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
							   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
							   
							   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
							   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
							   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";


		$res = $this->db->query($myquery);
		return $res->result();
}

}
?>