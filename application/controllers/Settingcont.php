<?php
class Settingcont extends CI_Controller 
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
function setting()
{
			
		
		

}
function get_colorsetting()
{
	$this->load->model('constantmodel');
	$rec= $this->constantmodel->get_ColorSetting();

	$i = 1;
		$output = array();
		foreach($rec as $row)
		{
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();

			
			$temp['close_from'] = $row->close_from;
			$temp['close_to'] = $row->close_to;
			$temp['open_emp_from'] = $row->open_emp_from;
			$temp['open_emp_to'] = $row->open_emp_to;
			$temp['open_from'] = $row->open_from;
			$temp['open_to'] = $row->open_to;
			
			array_push($output,$temp);
		} // End Foreach
		
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode($output);
}
function update_colorsetting()
{
	$this->load->model('constantmodel');
	$this->constantmodel->update_ColorSetting();
		
}
}
?>