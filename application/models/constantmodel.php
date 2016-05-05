<?php
class Constantmodel extends CI_Model
{
	//**********time color setting
	function get_ColorSetting()
	{	
	
		$query = $this->db->get('dusseldorf_v3_colortime_setting');
		return $query->result();
		
	}
	function update_ColorSetting()
	{	
		extract($_POST);
		$data['close_from'] = $txtclose_from;
		$data['close_to'] = $txtclose_to;
		$data['open_emp_from'] = $txtopen_emp_from;
		$data['open_emp_to'] = $txtopen_emp_to;
		$data['open_from'] = $txtopen_from;
		$data['open_to'] = $txtopen_to;
	
		
		$this->db->update('dusseldorf_v3_colortime_setting',$data);
		
	}	
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
		$query = $this->db->where("parent_id",315);
		$query = $this->db->get('departments');
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

//***************shift conflict******//
function getAvailUser_byDept()
{
	extract($_POST);
	if ($deptNo!=0)
	{
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

	}
	else
	{
		   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2
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

	}
		$res = $this->db->query($myquery);
		return $res->result();
}

function getAvailUser_Jobtitel()
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
function getAvailUser_specialization()
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
function getNotAvailUser_byDept()
{
	extract($_POST);
	if ($deptNo!=0)
	{
	
	   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2 
					and dep_id=".$deptNo."
					and id in (select user_id 
								   from   dusseldorf_v3_shifts
								   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
								   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
								   
								   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
								   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
	}
	else
	{
		$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2 
					and id in (select user_id 
								   from   dusseldorf_v3_shifts
								   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
								   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
								   
								   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
								   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
	}

		$res = $this->db->query($myquery);
		return $res->result();
}

function getNotAvailUser_Jobtitel()
{
extract($_POST);
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and jobtitle_id=".$JobTitelId."
				and id in (select user_id 
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
function getNotAvailUser_specialization()
{
extract($_POST);
   $myquery = "SELECT u.id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users u ,dusseldorf_specialization_users sp
				where type=2 
				and   u.id=sp.users_id
				and   jobtitle_id=".$JobTitelId."
				and   specialization_id=".$specId."
				and   u.id in (select user_id 
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
//**************timeOff Shift conflict*****//
function getAvailUser_byDeptTimeoff()
{
	extract($_POST);
	if ($deptNo!=0)
	{

	   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2 
					and dep_id=".$deptNo."
					and id not in (select user_id 
								   from   dusseldorf_v3_shifts
								   where  type=2
								   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
								   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
								   
								   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
								   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";

	}
	else
	{
		  $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
						FROM dusseldorf_users 
						where type=2 
						and id not in (select user_id 
									   from   dusseldorf_v3_shifts
									   where  type=2
									   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
									   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
									   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
									   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
									   
									   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
									   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
									   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
									   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
		
	}
	
		$res = $this->db->query($myquery);
		return $res->result();
}
function getNotAvailUser_byDeptTimeoff()
{
	extract($_POST);
	if ($deptNo!=0)
	{


	   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2 
					and dep_id=".$deptNo."
					and id in (select user_id 
								   from   dusseldorf_v3_shifts
								   where  type=2
								   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
								   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
								   
								   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
								   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
	}
	else
	{
		$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
					FROM dusseldorf_users 
					where type=2 
					and id in (select user_id 
								   from   dusseldorf_v3_shifts
								   where  type=2
								   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
								   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
								   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
								   
								   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
								   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
								   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
	}

		$res = $this->db->query($myquery);
		return $res->result();
}

function getAvailUser_JobtitelTimeoff()
{
extract($_POST);
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and jobtitle_id=".$JobTitelId."
				and id not in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  type=2
							   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
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
function getNotAvailUser_JobtitelTimeoff()
{
extract($_POST);
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and jobtitle_id=".$JobTitelId."
				and id in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  type=2
							   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
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
function getAvailUser_specializationTimeoff()
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
							   where  type=2
							   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
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
function getNotAvailUser_specializationTimeoff()
{
extract($_POST);
   $myquery = "SELECT u.id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users u ,dusseldorf_specialization_users sp
				where type=2 
				and   u.id=sp.users_id
				and   jobtitle_id=".$JobTitelId."
				and   specialization_id=".$specId."
				and   u.id in (select user_id 
				               from   dusseldorf_v3_shifts
							   where  type=2
							   and     ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
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