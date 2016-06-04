<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->session->set_userdata('user_id',  $this->uri->segment(3));
		
		$this->load->model('constantmodel');
		$rec=$this->constantmodel->get_user_permissions();
//		$this->session->set_userdata('itemname','');
		foreach($rec as $row)
		{
			$this->session->set_userdata('dep_id',$row->dep_id);
			$this->session->set_userdata('itemname',$row->itemname);
			
		
		}
		redirect("http://hireit4u.com/supermarket/index.php/dashboard/");
	}
}
