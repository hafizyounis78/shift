<?php

class Shiftmodel extends CI_Model
{
	
	
	function insert_shift()
	{
		extract($_POST);
		print_r($_POST);
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
function get_all_shifts_old()
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
		
/* if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT  count(id) as total,start_date,end_date,start_time,end_time,shift.status,task_map_dep.map_id as locationId,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,Special_shift
					FROM    dusseldorf_v3_shifts as shift,task_map_dep,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and shift.type=1
					AND     shift.location_id=task_map_dep.map_id
					and     task_map_dep.dep_child_id=dept.dep_id
					and     task_map_dep.dep_id=market.dep_id
					GROUP BY  start_date,end_date,start_time,end_time,shift.status,locationId,location_desc,market_id,market_name,dept_id,dept_name,Special_shift";
else*/
 
/*	if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT  count(id) as total,start_date,end_date,start_time,end_time,shift.status,task_map_dep.map_id as locationId,task_map_dep.map_name as location_desc,market.dep_id as market_id,market.dep_name as market_name,dept.dep_id as dept_id,dept.dep_name as dept_name,Special_shift
					FROM    dusseldorf_v3_shifts as shift,task_map_dep,departments as market,departments as dept
					WHERE   start_date > 2016-04-01 and shift.type=1
					AND     shift.location_id=task_map_dep.map_id
					and     task_map_dep.dep_child_id=dept.dep_id
					and     task_map_dep.dep_id=market.dep_id
					GROUP BY  start_date,end_date,start_time,end_time,shift.status,locationId,location_desc,market_id,market_name,dept_id,dept_name,Special_shift";
					
*/
        $rec=$this->db->query($myquery);
		return $rec->result();


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
	
}

?>
