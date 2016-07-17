<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("America/New_York");
//header("Content-type: application/pdf");

class Reportscont extends CI_Controller 
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
	
	 public function creatreport() {
		//**************************************//
		extract($_POST);
		$_POST['drpFromdate'] = date($this->session->userdata('startDate'),strtotime('last monday'));
		$drpFromdate=$_POST['drpFromdate'];
		$parts = explode('-', $drpFromdate);

		
		//**************************************///
		
		
		 
        $this -> load -> library('pdf');
		
        date_default_timezone_set('GMT');
        // report data
	        $header = '<span style="text-align:center;"><h1>Plan From :'.$_POST['drpFromdate'].'  To  '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+6,$parts[0])).'</h1></span>';
       $pdf = new PDF($header, '', PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //set margins
        $pdf -> SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
        $pdf -> SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
        //set image scale factor
        $pdf -> setImageScale(PDF_IMAGE_SCALE_RATIO);
        // ---------------------------------------------------------

        // set font

        //$pdf -> setCellHeightRatio(1.7);
      //  $pdf -> SetFont('trado', 'B', 15);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'ltr';
        $lg['a_meta_language'] = 'ger';
        $lg['w_page'] = 'page';

        //set some language-dependent strings
        $pdf -> setLanguageArray($lg);
        // add a page
       $pdf->AddPage('L', 'A4');

//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
        // report content
		//$this->SetFillColor(224, 235, 255);
       $pdf ->SetFont('times', '', 14);
		//******************my code*****************************//
		date_default_timezone_set('Asia/Gaza');  
//		echo date('Y-m-d',strtotime('last monday')); 
	//	print_r(date('Y-m-d',strtotime('last monday'))); 
		
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



	  $txt='<table style="border: 1px solid #999999; border-collapse: collapse;padding: 5px" id="shiftTable"><thead><tr><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',strtotime($_POST['drpFromdate'])).' '.$_POST['drpFromdate'].'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+1,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+1,$parts[0])).'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+2,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+2,$parts[0])).'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+3,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+3,$parts[0])).'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+4,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+4,$parts[0])).'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+5,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+5,$parts[0])).'</th><th style="border: 1px solid #999999;padding: 5px " scope="col">'.date('D',mktime(0, 0, 0, $parts[1], $parts[2]+6,$parts[0])).' '.date('y-m-d',mktime(0, 0, 0,$parts[1],$parts[2]+6,$parts[0])).'</th></tr></thead><tbody id="shedul_body">';
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
				$txt.='<tr>';
				if(isset($day1[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day1[$i]->color.'">'.$day1[$i]->start_time." - ".$day1[$i]->end_time."<br/> Location : ".$day1[$i]->name."<br/> Employees : ".$day1[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';
				
				if(isset($day2[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day2[$i]->color.'">'.$day2[$i]->start_time." - ".$day2[$i]->end_time."<br/> Location : ".$day2[$i]->name."<br/> Employees : ".$day2[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';
				
				if(isset($day3[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day3[$i]->color.'">'.$day3[$i]->start_time." - ".$day3[$i]->end_time."<br/> Location : ".$day3[$i]->name."<br/> Employees : ".$day3[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';
				
				if(isset($day4[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day4[$i]->color.'">'.$day4[$i]->start_time." - ".$day4[$i]->end_time."<br/> Location : ".$day4[$i]->name."<br/> Employees : ".$day4[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';
				
				if(isset($day5[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day5[$i]->color.'">'.$day5[$i]->start_time." - ".$day5[$i]->end_time."<br/> Location : ".$day5[$i]->name."<br/> Employees : ".$day5[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';
					
				if(isset($day6[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day6[$i]->color.'">'.$day6[$i]->start_time." - ".$day6[$i]->end_time."<br/> Location : ".$day6[$i]->name."<br/> Employees : ".$day6[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';	
				if(isset($day7[$i]->name))
					$txt.='<td style="border: 1px solid #999999;padding: 5px;background-color:'.$day7[$i]->color.'">'.$day7[$i]->start_time." - ".$day7[$i]->end_time."<br/> Location : ".$day7[$i]->name."<br/> Employees : ".$day7[$i]->emp_name."</td>";
				else
					$txt.='<td style="border: 1px solid #999999;padding: 5px;"></td>';	
					
				
				$txt.='</tr>';
				
				$i++;
				$max_row--;	
			}
                $txt.='</tbody>';
		        $txt.='</table>';

		//******************my code*****************************//
		$pdf -> setRTL(false);

        $pdf -> SetAlpha(0.03);
        
       // $img_file = '../../images/NSR.gif';
       // $pdf -> Image($img_file, 45, 50, 0, 0, '', '', '', false, 300, '', false, false, 0);
         
        $pdf -> SetAlpha(1);
        //$pdf -> setRTL(true);

        $pdf -> writeHTML($txt, true, false, false, false, '');
//echo $txt;
        // ob_clean();
        //Close and output PDF document
  
       // $pdf -> Output('report.pdf',  'I');
//	   $pdf -> Output('c://report.pdf',  'F');
	   $pdf -> Output('report.pdf',  'F');
	   $rec=$this->fullschedulemodel->get_emails($drpFromdate);
	   $address = $rec->result();
	   //echo 'address : '.$rec1[0]->email1;
	  //  $to="hafizyounis@gmail.com";
		$subject='Super Market Account';
		$message="Dear Sear \n,Your Plan as follow : \n";	        
		foreach ($address as $to)
		$this->send_email($to->email1,$subject,$message);
	   
    }
	   private function send_email($to,$subject,$message)
	{
            $this->email->clear();
            $this->email->from('supermarket@info.com', 'supermarket');
            $this->email->to($to);
            //$this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');
			/*$path = set_realpath('uploads/pdf/');*/
			$this->email->attach('report.pdf');
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        
    }
	function printcalendar()
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
      echo '<tbody id="shedul_body">';
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

	
	/*function getmy_Shift_calender()
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
		
	}*/
	function getall_ShiftByDAte()
	{
		/*		
		$this->load->model('fullschedulemodel');
		$data["shifts"] = $this->fullschedulemodel->get_shiftByDate();
		
		/*
		
		
		$rec = $rec->result();
		
		$output = array();
		foreach($rec as $row)
		{
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();
	
			if ( $row->type==1)
	//			$temp['title'] ="Shift-".$row->name."\n";
				$temp['title'] ='Location: '.$row->name."\n";
			else
//				$temp['title'] ="TimeOff-".$row->name."\n";
				$temp['title'] =$row->name."\n";

			$temp['start_date'] = $row->start_date;
			$temp['start_time'] = $row->start_time;
			$temp['end_date'] = $row->end_date;
			$temp['end_time'] = $row->end_time;
			$temp['location_name'] = $row->name;
			$temp['event_details'] = 'Employee: '.$row->emp_name;
			$temp['color'] = $row->color;
	
			array_push($output,$temp);
		}
		
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode($output);
		*/
	}
	
	}
	
?>
