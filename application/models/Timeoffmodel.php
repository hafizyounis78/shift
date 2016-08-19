<?php

class Timeoffmodel extends CI_Model
{
	// Check duplication
	function Check_duplicatShift()//check duplication timeoff with othertimeoff
	{
		extract($_POST);
		//print_r($_POST);
		
			
		 $myquery = "SELECT  COUNT(1) as count_emp
		 			 FROM    dusseldorf_users outusertb
					 LEFT    OUTER JOIN dusseldorf_v3_shifts outshifttb on outusertb.id= outshifttb.user_id
					 WHERE   outusertb.type =2
					 AND     outshifttb.type=2
					 AND     outusertb.id=".$staffList."
					 AND     outusertb.id in (select  user_id 
											   from   dusseldorf_v3_shifts
											   where  dusseldorf_v3_shifts.user_id=".$staffList."
											   AND   ((start_date<='".$drpFromdate."' and end_date>='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and start_date<='".$drpTodate."' AND end_date>='".$drpTodate."')
											   OR      (start_date<='".$drpFromdate."' and end_date>='".$drpFromdate."' AND end_date<='".$drpTodate."')
											   OR      (start_date>='".$drpFromdate."' and end_date<='".$drpTodate."')))";
											   
/*											   AND   ((start_time<='".$txtStart."' and end_time>='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and start_time<='".$txtEnd."' AND end_time>='".$txtEnd."')
											   or     ( start_time<='".$txtStart."' and end_time>='".$txtStart."' and end_time<='".$txtEnd."')
											   or     ( start_time>='".$txtStart."' and end_time<='".$txtEnd."')))*/	

		$res = $this->db->query($myquery);
		$emp_count = $res->result();
		$duplicat=0;
		foreach ($emp_count as $row);
		if($row->count_emp==0)
		{	$duplicat=0;
		 	$this->insert_timeoff();
		}
		else
		 	$duplicat=1;
		
		return $duplicat;
	}
	
	
	function insert_timeoff()
	{
		extract($_POST);
	//	print_r($_POST);
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
		$data['leavereason'] = $leavereason;
		
		$data['type'] = 2;
		$this->db->insert('dusseldorf_v3_shifts',$data);
		}
	}
	function get_all_timeoff()
	{	if ($this->session->userdata('itemname')=='admin')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,leavereason,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name,dusseldorf_users.id as staffId,itemname
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,AuthAssignment
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=task_map_dep.map_id
					and     user_id=AuthAssignment.userid
					AND      user_id=dusseldorf_users.id";
else if ($this->session->userdata('itemname')=='gm')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,leavereason,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name,dusseldorf_users.id as staffId,itemname
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,AuthAssignment
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and     user_id=AuthAssignment.userid
					and dusseldorf_users.dept_parent=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='circle_man')
	 	$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,leavereason,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name,dusseldorf_users.id as staffId,itemname
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,AuthAssignment
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and     user_id=AuthAssignment.userid
					and dusseldorf_users.dep_id=".$this->session->userdata('dep_id');
else if ($this->session->userdata('itemname')=='emp')
$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,leavereason,task_map_dep.map_id as locationId,Special_shift,task_map_dep.map_name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name,dusseldorf_users.id as staffId,itemname
					FROM    dusseldorf_v3_shifts,task_map_dep,dusseldorf_users,AuthAssignment
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=task_map_dep.map_id
					AND      user_id=dusseldorf_users.id
					and     user_id=AuthAssignment.userid
					and dusseldorf_users.id=".$this->session->userdata('user_id');


	
	 	/*$myquery = "SELECT  dusseldorf_v3_shifts.id, start_date,end_date,start_time,end_time,dusseldorf_v3_shifts.status,dusseldorf_v3_locations.id as locationId,name as location_desc,CONCAT(first_name,' ',last_name) as Staff_name
					FROM    dusseldorf_v3_shifts,dusseldorf_v3_locations,dusseldorf_users
					WHERE   start_date > 2016-04-01 and dusseldorf_v3_shifts.type=2
					AND     location_id=dusseldorf_v3_locations.id
					AND      user_id=dusseldorf_users.id";*/
        $rec=$this->db->query($myquery);
		return $rec->result();


	}
	function update_timeoff()
	{	
		extract($_POST);
		$data['location_id'] = $drpLocation;
		$data['start_date'] = $drpFromdate;
		$data['end_date'] = $drpTodate;
		$data['start_time'] = $txtStart;
		$data['end_time'] = $txtEnd;
		$data['status'] = $rdStatus;
		$data['leavereason'] = $leavereason;
		$data['type'] = 2;
		$this->db->where('id',$hdnshiftId);
		$this->db->update('dusseldorf_v3_shifts',$data);
	}
	
	function delete_timeoff()
	{
		extract($_POST);
		$this->db->where('id',$timeoffId);
		$this->db->delete('dusseldorf_v3_shifts');
	}
	
}

?>
