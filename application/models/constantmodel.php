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
   $myquery = "SELECT id, CONCAT(first_name,' ',last_name) as name 
				FROM dusseldorf_users 
				where type=2 
				and depart_id=".$deptNo."
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

}
?>