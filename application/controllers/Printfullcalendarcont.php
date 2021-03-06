<?php

class Printfullcalendarcont extends CI_Controller 
{
	public $data;
	function view ( $page = 'home', $uid = '' )
	{
		if( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
			$this->lang->load('label_lang', 'german');//load german languge
			$this->data['title'] = $page;
			
			$this->$page();
			$this->load->view('templates/head',$this->data);
		//	$this->load->view('templates/header',$this->data);
			//$this->load->view('templates/sidebar');
			//$this->load->view('templates/content');
		//	$this->load->view('templates/pageheader');
			
			$this->load->view('pages/'.$page,$this->data);
			$this->load->view('templates/footer');
			
		
		
	}
	
	function printfullcalendar()
	{
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		//$this->data['staffList']= $this->constantmodel->get_staff_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
	//	$this->getall_Shift_calender();
	}
	function fullschedule()
	{
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		//$this->data['staffList']= $this->constantmodel->get_staff_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
	//	$this->getall_Shift_calender();
	}
	function getfullschedule()
	{
		
			
		$this->load->model('fullschedulemodel');
		$shifttemplate = $this->fullschedulemodel->get_shift_templates();
		
		$output = array();
		foreach($shifttemplate as $row)
	    {
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();

			// It guess your client side will need the id to extract, and distinguish the ScoreCH data
			$temp['txtName'] 	= $row->name;
			$temp['txtStart'] 	= $row->start_time;
			$temp['txtEnd'] 	= $row->end_time;
			$temp['txtBreak'] 	= $row->lunch_break;
			
			array_push($output,$temp);
			
			
			/*echo '<div class="external-event label label-default">'.$row->name.
							'<br/>' . $row->start . ' - '. $row->start .
							' <i class="fa fa-coffee" aria-hidden="true"></i>' . $row->lunch_break .'</div>';*/
			
		}
		header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json");
			echo json_encode($output);
	}
	function addShiftTemplate()
	{
		$this->load->model('fullschedulemodel');
		$this->fullschedulemodel->insert_shift_template();
		$this->getfullschedule();
		
	}


	function addShift()
	{
			$this->load->model('Shiftmodel');
			$this->Shiftmodel->insert_shift();
	}
	function getmy_Shift_calender()
	{
		
		
		
		$this->load->model('fullschedulemodel');
		$rec = $this->fullschedulemodel->get_my_shift();
		
		
		$rec = $rec->result();
		
		$output = array();
		foreach($rec as $row)
		{
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();
	
			if ( $row->type==1)
				$temp['title'] ="Shift-".$row->name."\n";
			else
				$temp['title'] ="TimeOff-".$row->name."\n";
	
	
			$temp['start_date'] = $row->start_date;
			$temp['start_time'] = $row->start_time;
			$temp['end_date'] = $row->end_date;
			$temp['end_time'] = $row->end_time;
			$temp['location_name'] = $row->name;
			$temp['event_details'] = $row->emp_name;
			$temp['color'] = $row->color;
			
			array_push($output,$temp);
		}
		
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode($output);
		
	}
	function getall_Shift_calender()
	{
		
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		
		$this->load->model('fullschedulemodel');
		$rec = $this->fullschedulemodel->get_all_shift();
				
		
		
		
		$rec = $rec->result();
		
		$output = array();
		foreach($rec as $row)
		{
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();
	
			if ( $row->type==1)
				$temp['title'] ="Shift-".$row->name."\n";
			else
				$temp['title'] ="TimeOff-".$row->name."\n";

			$temp['start_date'] = $row->start_date;
			$temp['start_time'] = $row->start_time;
			$temp['end_date'] = $row->end_date;
			$temp['end_time'] = $row->end_time;
			$temp['location_name'] = $row->name;
			$temp['event_details'] = $row->emp_name;
			$temp['color'] = $row->color;
	
			array_push($output,$temp);
		}
		
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode($output);
		
	}
	
	}
	
?>
