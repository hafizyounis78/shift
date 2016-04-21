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
		$this->data['staffList']= $this->constantmodel->get_staff_list();

}

function addShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->insert_shift();
		//$this->drawTimeoffTable();
	}
}
?>