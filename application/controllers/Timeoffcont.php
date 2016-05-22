<?php
class Timeoffcont extends CI_Controller 
{
	public $data;
	
	function view ( $page = 'home')
	{
		if( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		/*if ($page == 'login')
		{
			$data['title'] = $page;
			$this->load->view('templates/header',$data);
			$this->load->view('pages/'.$page,$data);
		}
		else if($this->session->userdata('logged_in'))
		{*/
			$this->data['title'] = $page;
			$this->$page();
			$this->load->view('templates/head',$this->data);
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/content');
			$this->load->view('templates/pageheader');
			$this->load->view('pages/'.$page,$this->data);
			$this->load->view('templates/footer');
		/*}
		else
   		{
     		//If no session, redirect to login page
     		redirect('login', 'refresh');
   		}*/
		
	}
	function timeoff()
	{   $this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		//$this->data['staffList']= $this->constantmodel->get_staff_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
		$this->load->model('timeoffmodel');
		$this->data['timeoffrec'] = $this->timeoffmodel->get_all_timeoff();
		
	//	$this->getstaffList();
	}
	function addTimeoff()
	{
		$this->load->model('timeoffmodel');
		$this->timeoffmodel->insert_timeoff();
		$this->drawTimeoffTable();
	}
	function updateTimeoff()
	{
		$this->load->model('timeoffmodel');
		$this->timeoffmodel->update_timeoff();
		$this->drawTimeoffTable();
	}
	function drawTimeoffTable()
	{
		
		$this->load->model('timeoffmodel');
		$timeoffrec = $this->timeoffmodel->get_all_timeoff();
		
		
		$i=1;
		$statusrow='';
			foreach($timeoffrec as $row)
				{
					if($row->status==1)
					 $statusrow='Pending';
					 else
					 $statusrow='Active';
					 echo '<tr>';		
					 echo '<td>'.$i++.'</td>';
					 echo '<td id="tdstaff'.$row->id.'">'.$row->Staff_name.'</td>';
					 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
					 echo '<td id="tdend_date'.$row->id.'">'. $row->end_date.'</td>';
					 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
					 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
					 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
					 if ($row->status == 1)
						echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
					 else
						echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 
						
					 echo '<td>
						  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updatetimeoff('.$row->id.')">
						  <i class="fa fa-edit"></i> Update </button>
						  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deletetimeoff('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
					 echo '</td>';  
					
					 echo '</tr>';
				}								
		
	}
	function deletetimeoff()
	{
		$this->load->model('timeoffmodel');
		$this->timeoffmodel->delete_timeoff();
		$this->drawTimeoffTable();
	}
	
function getUserByDept()
{
/*	if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
	$this->load->model('constantmodel');
	$staffList=$this->constantmodel->getAvailUser_byDeptTimeoff();
	$notAvailableList=$this->constantmodel->getNotAvailUser_byDeptTimeoff();
	$totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			  
		  }
	  
}
function getUserByJobtitle()
{
/*	if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
	$this->load->model('constantmodel');
	$staffList=$this->constantmodel->getAvailUser_JobtitelTimeoff();
	$notAvailableList=$this->constantmodel->getNotAvailUser_JobtitelTimeoff();
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
	$staffList=$this->constantmodel->getAvailUser_specializationTimeoff();
	$notAvailableList=$this->constantmodel->getNotAvailUser_specializationTimeoff();
	$totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			  
		  }
	  
  
	
}

}
?>