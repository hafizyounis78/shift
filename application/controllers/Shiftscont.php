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
	$this->load->model('constantmodel');
	$staffList=$this->constantmodel->getUser_byDept();
	 foreach($staffList as $staff_row)
	  {
		 
		  echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
		  
	  }
	  
	
}
function getUserByJobtitle()
{
	$this->load->model('constantmodel');
	$staffList=$this->constantmodel->getUser_Jobtitel();
	 foreach($staffList as $staff_row)
	  {
		 
		  echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
		  
	  }
	  
	
}
function getUserBySpec()
{
	$this->load->model('constantmodel');
	$staffList=$this->constantmodel->getUser_specialization();
	 foreach($staffList as $staff_row)
	  {
		 
		  echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
		  
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
		 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
		// echo '<td id="tdrdStatus'.$row->id.'">'. $statusrow.'</td>';
		 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'">'.$statusrow.'</td>';	
		 echo '<td id="tdSpecial_shift'.$row->id.'">'. $row->Special_shift.'</td>';	 
		 echo '<td>
			  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateShift('.$row->id.')">
			  <i class="fa fa-edit"></i> Update </button>
			  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deleteShift('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
		 echo '</td>';  
		
		 echo '<tr/>';
	}
									
	
}
}
?>