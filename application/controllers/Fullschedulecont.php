<?php
class Fullschedulecont extends CI_Controller 
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
			//$this->$page();
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
	function getfullschedule()
	{
		$this->load->model('fullschedulemodel');
		$shifttemplate = $this->fullschedulemodel->get_shift_templates();
		
		foreach($shifttemplate as $row)
	    {
			echo '<div class="external-event label label-default">'.$row->name.
							'<br/>' . $row->start . ' - '. $row->start .
							' <i class="fa fa-coffee" aria-hidden="true"></i>' . $row->lunch_break .'</div>';
			
			
		}
	}
	function addShiftTemplate()
	{
		$this->load->model('fullschedulemodel');
		$this->fullschedulemodel->insert_shift_template();
		//$this->drawLocationTable();
	}
}
?>