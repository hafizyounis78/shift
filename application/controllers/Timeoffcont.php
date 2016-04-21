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
		$this->data['staffList']= $this->constantmodel->get_staff_list();
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
		foreach($timeoffrec as $row)
		{
			 echo '<tr>';		
			 echo '<td>'.$i++.'</td>';
			 echo '<td id="tdstaff'.$row->id.'">'.$row->Staff_name.'</td>';
			 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
			 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
			 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
			 echo '<td id="tdend_Time'.$row->id.'">'. $row->location_desc.'</td>';
			 echo '<td>
				  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateShift('.$row->id.')">
				  <i class="fa fa-edit"></i> Update </button>
				  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deleteShift('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
			 echo '</td>';  
			
			 echo '<tr/>';
		}
										
		
	}
/*function getstaffList()
	{
		$this->load->model('constantmodel');
		//$rec = $this->constantmodel->get_staff_list();
		$this->data['staffList']= $this->constantmodel->get_staff_list();
		//echo '<select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]">';
			  $menue_id = '';
			  foreach($rec as $staff_row)
			  {
				  $selected = '';
					  echo '</optgroup>';

					  echo '<option  value='.$staff_row->id.'>'.$staff_row->name.'</option>';
				  
			  }
			  echo '</optgroup>';
	}
*/}
?>