<?php
class Locationscont extends CI_Controller 
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
	function locations()
	{
		$this->load->model('locationsmodel');
		$this->data['locations'] = $this->locationsmodel->get_locations();
	}
	function addLocation()
	{
		$this->load->model('locationsmodel');
		$this->locationsmodel->insert_locations();
		$this->drawLocationTable();
	}
	function updateLocation()
	{
		$this->load->model('locationsmodel');
		$this->locationsmodel->update_locations();
		$this->drawLocationTable();
	}
	function drawLocationTable()
	{
		
		$this->load->model('locationsmodel');
		$locations = $this->locationsmodel->get_locations();
		
		$i=1;
		foreach($locations as $row)
		 {
			 if ($row->color == '')
				$color = 'style="background-color:#ffffff;cursor:pointer"';
			 else
				$color = 'style="background-color:'.$row->color.';cursor:pointer"';
				
			 echo '<tr '.$color.' onclick="selectRow('.$row->id.')">';
			 echo '<td>'.$i++.'</td>';
			 echo '<td id="tdName'.$row->id.'">'.$row->name.'</td>';
			 echo '<td id="tdDescription'.$row->id.'">'.$row->description.'</td>';
			 echo '<td id="tdColor'.$row->id.'" data-color="'.$row->color.'"></td>';
			 echo '<tr/>';
			 
			 
		 }
	}
}
?>