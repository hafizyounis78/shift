<?php

class Shiftmodel extends CI_Model
{
	function insert_duplicatShift()
	{
		extract($_POST);
		//print_r($_POST);
		$staffid = explode(",", $staffList);
		foreach($staffid as $element)
		{
			
		 $myquery = "SELECT  COUNT(1) as count_emp
		 			 FROM    dusseldorf_users outusertb
					 LEFT    OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
					 WHERE   outusertb.type =2
					 AND     outusertb.id=".$element."
					 AND     outusertb.id in (select  user_id 
													   from   dusseldorf_v3_shifts
													   where  dusseldorf_v3_shifts.user_id=".$element."
													   AND   ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
													   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
													   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
													   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."'))
													   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
													   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
													   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
													   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))";	
	
		$res = $this->db->query($myquery);
		$emp_count = $res->result();
		$duplicat=0;
		foreach ($emp_count as $row);
		if($row->count_emp==0)
		{
			$data['type'] = 1;
			$data['location_id'] = $drpLocation;
			$data['start_date'] = $drpFromdate;
			$data['end_date'] = $drpTodate;
			$data['start_time'] = $txtStart;
			$data['end_time'] = $txtEnd;
			$data['status'] = $rdStatus;
			$data['Special_shift'] = $chbxIsspecial;
			$data['Notification_req'] = $ckbNotification;
			
			$data['lunch_break'] = $drplstBreak;
			$data['user_id'] = $element;
			
			$this->db->insert('dusseldorf_v3_shifts',$data);
			
		}
		else
		 $duplicat=1;
		
		}
			return $duplicat;
	}
	
	function insert_shift()
	{
		extract($_POST);
		//print_r($_POST);
		$staffid = explode(",", $staffList);
		if (!isset($rdShifttype))
		   $shftype=1;
		else
		     $shftype=$rdShifttype;
		foreach($staffid as $element)
		{
		
		$data['type'] = $shftype;
		$data['location_id'] = $drpLocation;
		$data['start_date'] = $drpFromdate;
		$data['end_date'] = $drpTodate;
		$data['start_time'] = $txtStart;
		$data['end_time'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['Special_shift'] = $chbxIsspecial;
		$data['Notification_req'] = $ckbNotification;
		
		$data['lunch_break'] = $drplstBreak;
		$data['user_id'] = $element;
		
		$this->db->insert('dusseldorf_v3_shifts',$data);
		}
		
		
	}
function get_all_shifts()
{	
 if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id";
else if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dept_parent=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='circle_man')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dep_id=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=1
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.id=".$this->session->userdata('user_id');


        $rec=$this->db->query($myquery);
		return $rec->result();


	}	
function get_all_shiftsmang()
{	

$myquery = "SELECT count(sft.id) as total ,sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id,sft.type, loc.map_name as loc_name,sft.status,sft.lunch_break,sft.Special_shift ,loc.color, loc.map_id, (
		
								SELECT GROUP_CONCAT( CONCAT( b.first_name, ' ', b.last_name,'@@',CONVERT(b.id, CHAR(8)))
								SEPARATOR ', ' )
								FROM dusseldorf_users b, dusseldorf_v3_shifts c,departments d
								WHERE b.id = c.user_id
								AND location_id = sft.location_id
								and b.dep_id=d.dep_id
								AND start_date = sft.start_date
								AND end_date = sft.end_date
								AND start_time = sft.start_time
								AND end_time = sft.end_time 
								) AS emp_name
								FROM dusseldorf_v3_shifts sft, task_map_dep loc,dusseldorf_users b
								where b.id=sft.user_id
								and sft.location_id = loc.map_id
								GROUP BY sft.start_date, sft.start_time, sft.end_time, sft.end_date, sft.location_id, loc.map_name, loc.color
								HAVING start_date >'2016-04-01'";
		

        $rec=$this->db->query($myquery);
		return $rec->result();


	}		
function update_Allshift()
{
	
		extract($_POST);
		//print_r($_POST);
		$staffid = explode(",", $staffList);
		

		 $myquery = "DELETE  FROM dusseldorf_v3_shifts
		 			 WHERE   start_date='".$drpFromdate_old."' AND end_date>='".$drpTodate_old."'
					 AND     start_time='".$txtStart_old."'    AND end_time='".$txtEnd_old."'
					 AND     location_id =".$drpLocation_old;
	
		$res = $this->db->query($myquery);
		//$emp_count = $res->result();
		//$duplicat=0;
		//foreach ($emp_count as $row);
		if (!isset($rdShifttype))
		   $shftype=1;
		else
		     $shftype=$rdShifttype;
		foreach($staffid as $element)
		{
		
			$data['type'] = $shftype;
			$data['location_id'] = $drpLocation;
			$data['start_date'] = $drpFromdate;
			$data['end_date'] = $drpTodate;
			$data['start_time'] = $txtStart;
			$data['end_time'] = $txtEnd;
			$data['status'] = $rdStatus;
			$data['Special_shift'] = $chbxIsspecial;
			//$data['Notification_req'] = $ckbNotification;
			$data['Notification_req'] = 0;
			
			$data['lunch_break'] = $drplstBreak;
			$data['user_id'] = $element;
		
			$this->db->insert('dusseldorf_v3_shifts',$data);
		}
		
}
function update_shift()
{	
	extract($_POST);
	$data['location_id'] = $drpLocation;
	$data['start_date'] = $drpFromdate;
	$data['end_date'] = $drpTodate;
	$data['start_time'] = $txtStart;
	$data['end_time'] = $txtEnd;
	$data['status'] = $rdStatus;
	$data['Special_shift'] = $chbxIsspecial;
	$data['Notification_req'] = $ckbNotification;
	$this->db->where('id',$hdnshiftId);
	$this->db->update('dusseldorf_v3_shifts',$data);
}

function delete_shift()
{
	extract($_POST);
	$this->db->where('id',$shiftId);
	$this->db->delete('dusseldorf_v3_shifts');
}	

// Get All Elders
function get_search_shifts($requestData)
{
	$columns = array( 
		1 => 'Staff_name',
		2 => 'start_date',
		3 => 'end_date',
		4 => 'start_time', 
		5 => 'end_time',
		6 => 'type',
		7 => 'status',
		8 => 'location_desc');
	
		
 if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT   dusseldorf_v3_shifts.id,dusseldorf_v3_shifts.user_id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_shifts.type,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id";
else if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT   dusseldorf_v3_shifts.id,dusseldorf_v3_shifts.user_id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_shifts.type,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dept_parent=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='circle_man')
	 	$myquery = "SELECT   dusseldorf_v3_shifts.id,dusseldorf_v3_shifts.user_id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_shifts.type,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dep_id=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='emp')
		$myquery = "SELECT   dusseldorf_v3_shifts.id,dusseldorf_v3_shifts.user_id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_shifts.type,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,CONCAT(first_name,' ',last_name) as Staff_name
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and      dusseldorf_users.id=".$this->session->userdata('user_id');




	
	
	if(isset($requestData['txtName']) && $requestData['txtName'] !='')
	{
		$myquery = $myquery." AND CONCAT(first_name,' ',last_name)
		LIKE '%".$requestData['txtName']."%' ";
	}
	
	/*******************************************************************/
	if(isset($requestData['dtstartDate']) && $requestData['dtstartDate'] != '')
	
	{
		$myquery = $myquery." AND start_date >= '".$requestData['dtstartDate']."'";
	}
	if(isset($requestData['dtendDate']) && $requestData['dtendDate'] != '')
	
	{
		$myquery = $myquery." AND end_date <= '".$requestData['dtendDate']."'";
	}
	
	if(isset($requestData['txtStart']) && $requestData['txtStart'] != '')
	
	{
		$myquery = $myquery." AND start_time >= '".$requestData['txtStart']."'";
	}
	if(isset($requestData['txtEnd']) && $requestData['txtEnd'] != '')
	
	{
		$myquery = $myquery." AND end_time <= '".$requestData['txtEnd']."'";
	}
	
	//*****************************************************************//
	if(isset($requestData['drpLocation']) && $requestData['drpLocation'] !='')
	{
		$myquery = $myquery." AND task_map_dep.map_id = ".$requestData['drpLocation'];
	}
	if(isset($requestData['drpStatus']) && $requestData['drpStatus'] !='')
	{
		$myquery = $myquery." AND dusseldorf_v3_shifts.status = ".$requestData['drpStatus'];
	}
	
	if(isset($requestData['drpType']) && $requestData['drpType'] !='')
	{
		$myquery = $myquery." AND dusseldorf_v3_shifts.type = ".$requestData['drpType'];
	}
	/*$myquery = $myquery." ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'].
				" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	*/
	$myquery = $myquery." ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		
		if ($requestData['length'] > 0)
			$myquery = $myquery." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		
	$res = $this->db->query($myquery);
	return $res->result();
	
}
function count_shifts()
{
	
	
		
 if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT   count(*) as count_row
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id";
else if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT   count(*) as count_row
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dept_parent=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='circle_man')
	 	$myquery = "SELECT   count(*) as count_row
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and dusseldorf_users.dep_id=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='emp')
		$myquery = "SELECT   count(*) as count_row
					FROM     dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,departments as market,departments as dept
					WHERE    start_date > 2016-04-01 
					AND      location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and      market.dep_id=dusseldorf_users.dept_parent
					and      dept.dep_id=dusseldorf_users.dep_id
					and      dusseldorf_users.id=".$this->session->userdata('user_id');




	
	
	if(isset($requestData['txtName']) && $requestData['txtName'] !='')
	{
		$myquery = $myquery." AND CONCAT(first_name,' ',last_name)
		LIKE '%".$requestData['txtName']."%' ";
	}
	
	/*******************************************************************/
	if(isset($requestData['dtstartDate']) && $requestData['dtstartDate'] != '')
	
	{
		$myquery = $myquery." AND start_date >= '".$requestData['dtstartDate']."'";
	}
	if(isset($requestData['dtendDate']) && $requestData['dtendDate'] != '')
	
	{

		$myquery = $myquery." AND end_date <= '".$requestData['dtendDate']."'";
	}
	
	if(isset($requestData['txtStart']) && $requestData['txtStart'] != '')
	
	{
		$myquery = $myquery." AND start_time >= '".$requestData['txtStart']."'";
	}
	if(isset($requestData['txtEnd']) && $requestData['txtEnd'] != '')
	
	{
		$myquery = $myquery." AND end_time <= '".$requestData['txtEnd']."'";
	}
	
	//*****************************************************************//
	if(isset($requestData['drpLocation']) && $requestData['drpLocation'] !='')
	{
		$myquery = $myquery." AND task_map_dep.map_id = ".$requestData['drpLocation'];
	}
	if(isset($requestData['drpStatus']) && $requestData['drpStatus'] !='')
	{
		$myquery = $myquery." AND dusseldorf_v3_shifts.status = ".$requestData['drpStatus'];
	}
	
	if(isset($requestData['drpType']) && $requestData['drpType'] !='')
	{
		$myquery = $myquery." AND dusseldorf_v3_shifts.type = ".$requestData['drpType'];
	}
	
	$res = $this->db->query($myquery);
	return $res->result();
	

//	return $this->db->count_all('dusseldorf_v3_shifts');			
}
function update_Shift_status()
{
	extract($_POST);
		
	$data['status'] = $isactive;
		
	$this->db->where('id',$shiftId);
	$this->db->update('dusseldorf_v3_shifts',$data);
}

}

?>
