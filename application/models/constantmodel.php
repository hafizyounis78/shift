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
//***************get user by dept************//
function getAvailUser_byDept()
{
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
function getNotAvailUser_specialization()
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
				  AND     outshifttb.type=2
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
				  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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
						  AND     outshifttb.type=2
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