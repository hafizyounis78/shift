<?php
class Constantmodel extends CI_Model
{
	function get_user_permissions()
	{
		
		$myquery ="SELECT itemname,CONCAT( dusseldorf_users.first_name, ' ', dusseldorf_users.last_name ) as name ,IFNULL(dep_man.dep_id,dusseldorf_users.dep_id) as dep_id
									   FROM 	 dusseldorf_users
									   LEFT JOIN dep_man ON dusseldorf_users.id = dep_man.usr_id,
									   users,AuthAssignment 
									   WHERE 	users.usr_id=AuthAssignment.userid
									   and 		users.usr_id=dusseldorf_users.id 
									   and 		users.usr_id=".$this->session->userdata('user_id');//by hafiz
		$res = $this->db->query($myquery);
		return $res->result();
				
	}
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
	function get_timeoffLocation_list()
	{	
		
	
		
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name   
						FROM   task_map_dep,dusseldorf_users,departments
						where  task_map_dep.dep_child_id=dusseldorf_users.dep_id
						and    departments.dep_id=task_map_dep.dep_child_id
						and    dusseldorf_users.id=".$this->session->userdata('user_id');
						
					
			$res = $this->db->query($myquery);
			return $res->result();
		
	/*	$query = $this->db->get('dusseldorf_v3_locations');
		return $query->result();
	*/	
	}
	function get_location_list_old()
	{	
		if ($this->session->userdata('itemname')=="admin")
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name  
						FROM   task_map_dep,departments
						where  departments.dep_id=task_map_dep.dep_child_id";
						
	
		else if ($this->session->userdata('itemname')=="gm")
		
			{
				
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name    
						FROM   task_map_dep,departments
						where  departments.dep_id=task_map_dep.dep_child_id
						and    task_map_dep.dep_id=".$this->session->userdata('dep_id');
					
			}
		else if ($this->session->userdata('itemname')=="circle_man")
		
			{
				
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name    
						FROM   task_map_dep,departments
						where  departments.dep_id=task_map_dep.dep_child_id
						and    task_map_dep.dep_child_id=".$this->session->userdata('dep_id');
					
			}
	
		else if ($this->session->userdata('itemname')=="emp")
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name   
						FROM   task_map_dep,dusseldorf_users,departments
						where  task_map_dep.dep_child_id=dusseldorf_users.dep_id
						and    departments.dep_id=task_map_dep.dep_child_id
						and    dusseldorf_users.id=".$this->session->userdata('user_id');
						
					
			$res = $this->db->query($myquery);
			return $res->result();
		
	/*	$query = $this->db->get('dusseldorf_v3_locations');
		return $query->result();
	*/	
	}
function get_location_list()
	{	
			$myquery = "SELECT map_id as id,map_name as Location_name,dep_name  
						FROM   task_map_dep,departments
						where  departments.dep_id=task_map_dep.dep_child_id";
						
					
			$res = $this->db->query($myquery);
			return $res->result();
		
	}	
function get_locationBydept()
{	
		extract($_POST);
	if ($deptNo == 0)//all department
		$myquery = "SELECT map_id as id,map_name as Location_name,dep_name    
					FROM   task_map_dep,departments
					where  departments.dep_id=task_map_dep.dep_child_id
					and    task_map_dep.dep_id=".$this->session->userdata('dep_id');
					/*UNION
					SELECT map_id as id,map_name as Location_name,'Market' as dep_name    
					FROM   task_map_dep
					where  map_id=400*/

			
		
	else
	$myquery = "SELECT map_id as id,map_name as Location_name,dep_name    
					FROM   task_map_dep,departments
					where  departments.dep_id=task_map_dep.dep_child_id
					and    task_map_dep.dep_child_id=".$deptNo;
					/*UNION
					SELECT map_id as id,map_name as Location_name,'Market' as dep_name    
					FROM   task_map_dep
					where  map_id=400*/
				
		$res = $this->db->query($myquery);
		return $res->result();
	
/*	$query = $this->db->get('dusseldorf_v3_locations');
	return $query->result();
*/	
}
function get_staff_list()
{
	
	
	$myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name FROM dusseldorf_users where type=2";
	
	$res = $this->db->query($myquery);
	return $res->result();
}
function get_dept_list()
	{	
	
	/*echo $this->session->userdata('itemname');
	exit();*/
	if ($this->session->userdata('itemname')=="admin")
		$myquery = "SELECT departments.dep_id,dep_name  
					FROM   departments
					where  parent_id != 0
					and    dep_statues=1";
					

	else if ($this->session->userdata('itemname')=="gm")
	
		{
			
		$myquery = "SELECT departments.dep_id,dep_name  
					FROM   departments,dep_man 
					where  dep_man.dep_id=departments.parent_id
					and    dep_statues=1
					and    dep_man.usr_id=".$this->session->userdata('user_id');
				
		}
	else if ($this->session->userdata('itemname')=="circle_man")
	
		{
			
		$myquery = "SELECT departments.dep_id,dep_name  
					FROM   departments,dep_man 
					where  dep_man.dep_id=departments.dep_id
					and    dep_statues=1
					and    dep_man.usr_id=".$this->session->userdata('user_id');
				
		}

	else if ($this->session->userdata('itemname')=="emp")
		$myquery = "SELECT departments.dep_id,dep_name  
				FROM  departments,dusseldorf_users
				where departments.dep_id=dusseldorf_users.dep_id
				and    dep_statues=1
				and   dusseldorf_users.id=".$this->session->userdata('user_id');
		
		$res = $this->db->query($myquery);
		return $res->result();
		
	}
function get_jobtitle_list()
{	

	$query = $this->db->get('dusseldorf_jobtitle');
	return $query->result();
	
}
function get_spec_list()
{	
		$this->db->from('dusseldorf_specialization');
		$this->db->where('is_deleted',0);
		$this->db->order_by("name", "ASC");
		
		$query = $this->db->get();
		
		return $query->result();
		
	/*	$query = $this->db->get('dusseldorf_specialization');
		return $query->result();*/
		
	}

//***************shift conflict******//
//***************get user by dept************//
function getAvailUser_byDept()
{$dep_filter ="";
	if ($this->session->userdata('itemname')=='gm')
	$dep_filter = "and   outusertb.dept_parent=".$this->session->userdata('dep_id');
	extract($_POST);
	if ($deptNo!=0)//not all department
	{//example:start_date=09-05-2016
	//		   end date=  15-05-2016	
	
	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  ".$dep_filter."
				  AND     dep_id=".$deptNo."
				  AND     outusertb.id not in (select  user_id 
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
	else//not all department
	{
		 $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
						  WHERE   outusertb.type =2
						   ".$dep_filter."
						  AND     outusertb.id not in (select  user_id 
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
function getNotAvailUser_byDept()
{
	$dep_filter ="";
	extract($_POST);
	if ($this->session->userdata('itemname')=='gm')
	$dep_filter = "and   outusertb.dept_parent=".$this->session->userdata('dep_id');
	if ($deptNo!=0)
	{
	

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  ".$dep_filter."
				  AND     dep_id=".$deptNo."
				  AND     outusertb.id in (select  user_id 
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

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  ".$dep_filter."
				  AND     outusertb.id in (select  user_id 
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
//***************/get user by dept************//

//***************get user by job titel************//
function getAvailUser_Jobtitel()
{	
extract($_POST);
  if ($this->session->userdata('itemname')=='admin')

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type=2
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='gm')
	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.dept_parent=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='circle_man')
   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.dep_id=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.id=".$this->session->userdata('user_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id not in (select  user_id 
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
function getNotAvailUser_Jobtitel()
{
extract($_POST);
  if ($this->session->userdata('itemname')=='admin')

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='gm')
	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.dept_parent=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='circle_man')
   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.dep_id=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS staff_name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  and   outusertb.id=".$this->session->userdata('user_id')."
				  and jobtitle_id=".$JobTitelId."
				  AND     outusertb.id in (select  user_id 
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
//***************/get user by job titel************//

//***************get user by specialization ************//
function getAvailUser_specialization()
{
extract($_POST);
if ($this->session->userdata('itemname')=='admin')

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='gm')
	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.dept_parent=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='circle_man')
   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.dep_id=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id not in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.id=".$this->session->userdata('user_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id not in (select  user_id 
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
if ($this->session->userdata('itemname')=='admin')

	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='gm')
	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.dept_parent=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='circle_man')
   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.dep_id=".$this->session->userdata('dep_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
				  WHERE   outusertb.type =2
				  and   outusertb.id=".$this->session->userdata('user_id')."
				  and jobtitle_id=".$JobTitelId."
				  and     spe.users_id=outusertb.id
  				  and     spe.specialization_id=".$specId."
				  AND     outusertb.id in (select  user_id 
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
//***************/get user by specialization ************//


//**************timeOff Shift conflict*****//
//***************get user by dept************//
function getAvailUser_byDeptTimeoff()
{$user_filter ="";
	extract($_POST);
	if ($this->session->userdata('itemname')=="emp")
		$user_filter = "AND user_id=".$this->session->userdata('user_id');
	if ($deptNo!=0)
	{


	   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   ".$user_filter."
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				   ".$user_filter."
				  AND     dep_id=".$deptNo."
				  AND     outusertb.id not in (select  user_id 
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
 $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
	   											   FROM dusseldorf_v3_shifts inshiftstb
												   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
												   AND inshiftstb.user_id = outusertb.id
												   and inshiftstb.type=1
												   GROUP BY user_id) AS worktime, 
						  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
				  FROM    dusseldorf_users outusertb
				  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
				  WHERE   outusertb.type =2
				  AND     outusertb.id not in (select  user_id 
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
function getNotAvailUser_byDeptTimeoff()
{
	extract($_POST);
	if ($deptNo!=0)
	{
		 $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
						  WHERE   outusertb.type =2
						  AND     dep_id=".$deptNo."
						  AND     outusertb.id in (select  user_id 
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
		 $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
						  WHERE   outusertb.type =2
						  AND     outusertb.id not in (select  user_id 
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
//***************/get user by dept************//
//***************get user by job titel************//
function getAvailUser_JobtitelTimeoff()
{
	
extract($_POST);
	 $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
						  WHERE   outusertb.type =2
						  and     jobtitle_id=".$JobTitelId."
						  AND     outusertb.id not in (select  user_id 
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
function getNotAvailUser_JobtitelTimeoff()
{
extract($_POST);
   $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
						  WHERE   outusertb.type =2
						  and     jobtitle_id=".$JobTitelId."
						  AND     outusertb.id in (select  user_id 
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
//***************/get user by job titel************//
//***************get user by specialization************//
function getAvailUser_specializationTimeoff()
{
extract($_POST);
    $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
						  WHERE   outusertb.type =2
						  and     jobtitle_id=".$JobTitelId."
						  and     spe.users_id=outusertb.id
		  				  and     spe.specialization_id=".$specId."
						  AND     outusertb.id not in (select  user_id 
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
function getNotAvailUser_specializationTimeoff()
{
extract($_POST);
    $myquery = "SELECT  DISTINCT outusertb.id, (SELECT sum((TIME_TO_SEC( end_time ) - TIME_TO_SEC( start_time )) * ( end_date - start_date +1 ))		      	   						
														   FROM dusseldorf_v3_shifts inshiftstb
														   WHERE WEEKOFYEAR( start_date ) = WEEKOFYEAR('".$drpFromdate."')
														   AND inshiftstb.user_id = outusertb.id
														   and inshiftstb.type=1
														   GROUP BY user_id) AS worktime, 
								  CONCAT( first_name, ' ', last_name ) AS name, hoursPerWeek, pricePerHour
						  FROM    dusseldorf_users outusertb
						  LEFT OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id,dusseldorf_specialization_users spe
						  WHERE   outusertb.type =2
						  and     jobtitle_id=".$JobTitelId."
						  and     spe.users_id=outusertb.id
  						  and     spe.specialization_id=".$specId."
						  AND     outusertb.id in (select  user_id 
													   from    dusseldorf_v3_shifts
													   where   ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
													   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
													   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
													   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
													   AND     ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
													   or      ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
													   or      ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
													   or      ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";

		$res = $this->db->query($myquery);
		return $res->result();
}
//***************/get user by specialization************//

}
?>