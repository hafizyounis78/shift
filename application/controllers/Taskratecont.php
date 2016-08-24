<?php

class Taskratecont extends CI_Controller 
{
	public $data;
	function view ( $page = 'home', $uid = '' )
	{
		if( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
			$this->lang->load('label_lang', 'german');//load german languge
			//$this -> load -> library('Pdf');
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
	

	function taskrat()
	{
		$this->load->model('taskratemodel');
		$this->data['taskraterec']= $this->taskratemodel->get_taskRate();
	}
	
	
}
	
?>
