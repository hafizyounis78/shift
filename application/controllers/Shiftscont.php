<?php
class Shiftscont extends CI_Controller 
{
	public $data;
	
	function view ( $page = 'home')
	{
		if( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		$this->lang->load('label_lang', 'german');//load german languge
			$this->data['title'] = $page;
			$this->$page();
			$this->load->view('templates/head',$this->data);
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/content');
			$this->load->view('templates/pageheader');
			$this->load->view('pages/'.$page,$this->data);
			$this->load->view('templates/footer');
	}
	function shifts()
	{
		
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
		$this->load->model('Shiftmodel');
		$this->data['shiftrec']= $this->Shiftmodel->get_all_shifts();
		
	
	}
	
	function addShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->insert_shift();
		$this->drawShiftsTable();
	}
	
	function updateShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->update_shift();
		$this->drawShiftsTable();
	}
	function deleteShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->delete_shift();
		$this->drawShiftsTable();
	}	
	function getUserByDept()
	{
		/*echo "permissions:".$this->session->userdata('itemname');
		echo "user_id:".$this->session->userdata('user_id');*/
		
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_byDept();
		$notAvailableList=$this->constantmodel->getNotAvailUser_byDept();
		$totalTime='';
		$str='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			//  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			$str=$str.'<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
		  }
		   
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			//  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			 $str=$str.'<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>'; 
			  
		  }  
		//*******************get location by dept
//		echo $str.'@@'.$this->getLocationBydept();
		echo $str.'@@'.'hafiz';
	}
	function getLocationBydept()
	{
		$this->load->model('constantmodel');
		$location=$this->constantmodel->get_locationBydept();
		$str='';
		if (count($location) == 0)
		{
			//echo 0;
			return ' <option value="">No Location</option>';
		}
		//$output = array();
		/*foreach($rec as $row)
		{*/
		else{
			 foreach ($location as $location_row)
			 {
				$str=$str.' <option value="'.$location_row->id.'">'.$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
			 }
			 return $str;
			//unset($temp); // Release the contained value of the variable from the last loop
		//	$temp = array();

			// It guess your client side will need the id to extract, and distinguish the ScoreCH data
		
		//$temp['id'] = $row->id;
		//$temp['name'] = $row->dep_name ;
		//$temp['dep_name'] = $row->dep_name ;
		
		//	array_push($output,$temp);
			
		//header('Access-Control-Allow-Origin: *');
		//	header("Content-Type: application/json");
		//	return json_encode($output);
			
			
		
//	}
		}
}
	function getallLocation()
	{
		$this->load->model('constantmodel');
		$location=$this->constantmodel->get_location_list();
		
		if (count($location) == 0)
		{
			echo 0;
			return;
		}
		$str='';
			 foreach ($location as $location_row)
			 {
				$str=$str.' <option value="'.$location_row->id.'">'.$location_row->id.'- '.$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
			 }
			 echo $str;

}
	function getUserByJobtitle()
	{
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_Jobtitel();
		$notAvailableList=$this->constantmodel->getNotAvailUser_Jobtitel();
		 $totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->staff_name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->staff_name.'</option>';
			  
		  } 
		
	}

	function getUserBySpec()
	{
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_specialization();
		$notAvailableList=$this->constantmodel->getNotAvailUser_specialization();
		$totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			  
		  }		
	}
	
	function drawShiftsTable()
	{
		
		$this->load->model('Shiftmodel');
		$shiftrec = $this->Shiftmodel->get_all_shifts();
		
		
		$i=1;
		$statusrow='';
		foreach($shiftrec as $row)
		{
			if($row->status==1)
			 $statusrow='Draft';
			 else
			 $statusrow='Active';
			 echo '<tr>';		
			 echo '<td>'.$i++.'</td>';
			 echo '<td id="tdstaff'.$row->id.'">'.$row->Staff_name.'</td>';
			 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
			  echo '<td id="tdend_date'.$row->id.'">'. $row->end_date.'</td>';
			 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
			 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
			 echo '<td id="tdMarket'.$row->id.'" data-loid="'.$row->market_id.'">'. $row->market_name.'</td>';
			 echo '<td id="tdDepartment'.$row->id.'" data-loid="'.$row->dept_id.'">'. $row->dept_name.'</td>';
			 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
			// echo '<td id="tdrdStatus'.$row->id.'">'. $statusrow.'</td>';
			if ($row->status == 1)
				 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
			else
				 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 

			 echo '<td id="tdSpecial_shift'.$row->id.'">'. $row->Special_shift.'</td>';	 
			 echo '<td>
				  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateShift('.$row->id.')">
				  <i class="fa fa-edit"></i> Update </button>
				  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deleteShift('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
			 echo '</td>';  
			
			 echo '</tr>';
		}
										
		
	}
}
?>