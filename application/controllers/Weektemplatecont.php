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
		$this->load->model('constantmodel');
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		date_default_timezone_set('Asia/Gaza');
		$firstDayList='';
		$dayList='';
		$firstDayList=date('Y-m-d',strtotime('next monday'));
		$interval='';
		for ($i=1;$i<=4;$i++)
		{  
			$interval=$i*7;
			$dayList =$dayList.'<option value="'.$interval.'" >'.$firstDayList.'</option>';
		  	//$firstDayList=date('Y-m-d',strtotime('next monday'));
			 $firstDayList = date('Y-m-d', strtotime($firstDayList . ' +7 day'));
		}
		$this->data['dayList']= $dayList; 
		
//		echo date('Y-m-d',strtotime('last monday')); 
	//	print_r(date('Y-m-d',strtotime('last monday'))); 
	$today_date = date('y-m-d');
	$dayofweek = date('w', strtotime($today_date));
	
		if ($dayofweek !=1)
		$_POST['drpFromdate'] = date('Y-m-d',strtotime('last monday'));
		else
		$_POST['drpFromdate'] =$today_date ;
		
	    $this->session->set_userdata('startDate', $_POST['drpFromdate']);
		$this->load->model('Weektempmodel');
		
		$rec1  = $this->Weektempmodel->get_shift_day1();
		$rec2  = $this->Weektempmodel->get_shift_day2();
		$rec3  = $this->Weektempmodel->get_shift_day3();
		$rec4  = $this->Weektempmodel->get_shift_day4();
		$rec5  = $this->Weektempmodel->get_shift_day5();
		$rec6  = $this->Weektempmodel->get_shift_day6();
		$rec7  = $this->Weektempmodel->get_shift_day7();

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
		date_default_timezone_set('Asia/Gaza');
		$today_date = date('y-m-d');
		
		
		
		//$this->getall_ShiftByDAte();
		$this->session->set_userdata('startDate', $_POST['drpFromdate']);
		$this->load->model('Weektempmodel');
		
		$rec1  = $this->Weektempmodel->get_shift_day1();
		$rec2  = $this->Weektempmodel->get_shift_day2();
		$rec3  = $this->Weektempmodel->get_shift_day3();
		$rec4  = $this->Weektempmodel->get_shift_day4();
		$rec5  = $this->Weektempmodel->get_shift_day5();
		$rec6  = $this->Weektempmodel->get_shift_day6();
		$rec7  = $this->Weektempmodel->get_shift_day7();

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
//************************************//
date_default_timezone_set('Asia/Gaza');
		$firstDayList='';
		$dayList='';
		$firstDayList=date('Y-m-d',strtotime('next monday'));
		$interval='';
		$disable='';
		if ($NoOfDay==7)
			$interval=$currWeekValue;
		else
			$interval=$currWeekValue - 14;
		for ($i=1;$i<=4;$i++)
		{  //if($currWeekValue!=0)
			//$interval=$NoOfDay+($i*$currWeekValue);
			//=7+21
			if ($NoOfDay==7)
				$interval=$interval+7;
			else
				$interval=$interval+7;
			  
			  //$interval=$interval+4*$NoOfDay;
			//$interval=($i*$NoOfDay);
			
			if ($interval <= 0)
				$disable='disabled="disabled"';
				
			$dayList =$dayList.'<option value="'.$interval.'" '.$disable.' >'.$firstDayList.'</option>';
		  	//$firstDayList=date('Y-m-d',strtotime('next monday'));
			 $firstDayList = date('Y-m-d', strtotime($firstDayList. ' +7 day'));
			// $interval='';
		}
	
//***********************************//

	echo date('Y-m-d', strtotime('last monday', strtotime($drpFromdate)));
	echo '@#@'; 
	echo date('Y-m-d', strtotime('next monday', strtotime($drpFromdate)));
	echo '@#@';
	echo $dayList; 
	echo '@#@';
	$parts = explode('-', $drpFromdate);
	  echo '<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>PLAN
							</div>
							<div class="tools">
							</div>
						</div>
   <div class="portlet-body">';
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
