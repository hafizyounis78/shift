<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("America/New_York");
//header("Content-type: application/pdf");

class Weektemplatecont extends CI_Controller 
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
	

	function weektemp()
	{
		date_default_timezone_set('Asia/Gaza');  
//		echo date('Y-m-d',strtotime('last monday')); 
	//	print_r(date('Y-m-d',strtotime('last monday'))); 
		$_POST['drpFromdate'] = date('Y-m-d',strtotime('last monday'));
	    $this->session->set_userdata('startDate', $_POST['drpFromdate']);
		$this->load->model('fullschedulemodel');
		
		$rec1  = $this->fullschedulemodel->get_shift_day1();
		$rec2  = $this->fullschedulemodel->get_shift_day2();
		$rec3  = $this->fullschedulemodel->get_shift_day3();
		$rec4  = $this->fullschedulemodel->get_shift_day4();
		$rec5  = $this->fullschedulemodel->get_shift_day5();
		$rec6  = $this->fullschedulemodel->get_shift_day6();
		$rec7  = $this->fullschedulemodel->get_shift_day7();

		$rec1 = $rec1->result();
		$rec2 = $rec2->result();
		$rec3 = $rec3->result();
		$rec4 = $rec4->result();
		$rec5 = $rec5->result();
		$rec6 = $rec6->result();
		$rec7 = $rec7->result();

		$this->data["day1"]=$rec1;
		$this->data["day2"]=$rec2;
		$this->data["day3"]=$rec3;
		$this->data["day4"]=$rec4;
		$this->data["day5"]=$rec5;
		$this->data["day6"]=$rec6;
		$this->data["day7"]=$rec7;


	}
	function getcalendar()
	{
		extract($_POST);
		//$this->getall_ShiftByDAte();
		$this->session->set_userdata('startDate', $_POST['drpFromdate']);
		$this->load->model('fullschedulemodel');
		
		$rec1  = $this->fullschedulemodel->get_shift_day1();
		$rec2  = $this->fullschedulemodel->get_shift_day2();
		$rec3  = $this->fullschedulemodel->get_shift_day3();
		$rec4  = $this->fullschedulemodel->get_shift_day4();
		$rec5  = $this->fullschedulemodel->get_shift_day5();
		$rec6  = $this->fullschedulemodel->get_shift_day6();
		$rec7  = $this->fullschedulemodel->get_shift_day7();

		$rec1 = $rec1->result();
		$rec2 = $rec2->result();
		$rec3 = $rec3->result();
		$rec4 = $rec4->result();
		$rec5 = $rec5->result();
		$rec6 = $rec6->result();
		$rec7 = $rec7->result();

		$day1=$rec1;
		$day2=$rec2;
		$day3=$rec3;
		$day4=$rec4;
		$day5=$rec5;
		$day6=$rec6;
		$day7=$rec7;
//***********************************//
	echo date('Y-m-d', strtotime('last monday', strtotime($drpFromdate)));
	echo '@#@'; 
	echo date('Y-m-d', strtotime('next monday', strtotime($drpFromdate)));
	echo '@#@';
	
	$parts = explode('-', $drpFromdate);

	  echo '<table class="table table-bordered" id="shiftTable">';
      echo '<thead>';
      echo '<tr>';
      echo '<th scope="col">'.date('D',strtotime($_POST['drpFromdate'])).' '.$_POST['drpFromdate'].'</th>';
      echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+1,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+1,$parts[0])).'</th>';
      echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+2,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+2,$parts[0])).'</th>';
	  echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+3,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+3,$parts[0])).'</th>';            
	  echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+4,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+4,$parts[0])).'</th>';
	  echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+5,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+5,$parts[0])).'</th>';
	  echo '<th scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+6,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+6,$parts[0])).'</th>';
     // strtotime($drpFromdate.'+5 day'));
	  echo '</tr>';
      echo '</thead>';
      echo '<tbody id="shedul_body">';;
			$max_row = count($day1);
			if (count($day2) > $max_row)
				$max_row = count($day2);
			if (count($day3) > $max_row)
				$max_row = count($day3);
			if (count($day4) > $max_row)
				$max_row = count($day4);
			if (count($day5) > $max_row)
				$max_row = count($day5);
			if (count($day6) > $max_row)
				$max_row = count($day6);
			if (count($day7) > $max_row)
				$max_row = count($day7);
			
			$i=0;	
			while($max_row != 0)
			{
				echo '<tr>';
				if(isset($day1[$i]->name))
					echo "<td style='background-color:".$day1[$i]->color."'>".$day1[$i]->start_time." - ".$day1[$i]->end_time."<br/> Location : ".$day1[$i]->name."<br/> Employees : ".$day1[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day2[$i]->name))
					echo "<td style='background-color:".$day2[$i]->color."'>".$day2[$i]->start_time." - ".$day2[$i]->end_time."<br/> Location : ".$day2[$i]->name."<br/> Employees : ".$day2[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day3[$i]->name))
					echo "<td style='background-color:".$day3[$i]->color."'>".$day3[$i]->start_time." - ".$day3[$i]->end_time."<br/> Location : ".$day3[$i]->name."<br/> Employees : ".$day3[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day4[$i]->name))
					echo "<td style='background-color:".$day4[$i]->color."'>".$day4[$i]->start_time." - ".$day4[$i]->end_time."<br/> Location : ".$day4[$i]->name."<br/> Employees : ".$day4[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
				
				if(isset($day5[$i]->name))
					echo "<td style='background-color:".$day5[$i]->color."'>".$day5[$i]->start_time." - ".$day5[$i]->end_time."<br/> Location : ".$day5[$i]->name."<br/> Employees : ".$day5[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';
					
				if(isset($day6[$i]->name))
					echo "<td style='background-color:".$day6[$i]->color."'>".$day6[$i]->start_time." - ".$day6[$i]->end_time."<br/> Location : ".$day6[$i]->name."<br/> Employees : ".$day6[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';	
				if(isset($day7[$i]->name))
					echo "<td style='background-color:".$day7[$i]->color."'>".$day7[$i]->start_time." - ".$day7[$i]->end_time."<br/> Location : ".$day7[$i]->name."<br/> Employees : ".$day7[$i]->emp_name."</td>";
				else
					echo '<td>&nbsp</td>';	
					
				
				echo '</tr>';
				
				$i++;
				$max_row--;	
			}
                echo '</tbody>';
		        echo '</table>';

   
//***********************************//

	}	

	
function copyshift()
{
	$this->load->model('weektempmodel');
	$this->weektempmodel->copyshift();
}
	
}
	
?>
