<?php

class Taskratemodel extends CI_Model
{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Gaza');   
	}

function get_taskRate()
{
	extract($_POST);
	$myquery ="SELECT  a.task_id,usr_id,CONCAT( u.first_name, ' ', u.last_name ) as Staff_name,d.dep_name,tsk_rate
			   FROM    task_assigned a,tasks t,dusseldorf_users u,departments d
			   WHERE   t.tsk_id =a.task_id
			   AND     d.dep_id=u.dep_id
			   AND     u.id=usr_id";		
		
				
			
		$res = $this->db->query($myquery);
		return $res->result();	
	
}
}
?>