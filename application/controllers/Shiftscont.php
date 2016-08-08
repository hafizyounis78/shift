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
	function shiftsearch()
	{
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
	}
	function shiftsmang()
	{
		
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
		$this->load->model('Shiftmodel');
		$this->data['shiftrec']= $this->Shiftmodel->get_all_shiftsmang();
		
		
	
	}
	function shifts()
	{
		
		$this->load->model('constantmodel');
		$this->data['location']= $this->constantmodel->get_location_list();
		$this->data['deptList']= $this->constantmodel->get_dept_list();
		$this->data['specList']= $this->constantmodel->get_spec_list();
		$this->data['jobtitleList']= $this->constantmodel->get_jobtitle_list();
		$this->load->model('Shiftmodel');
		$this->data['shiftrec']= $this->Shiftmodel->get_all_shifts();
		
	
	}
	
	function addShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->insert_shift();
		$this->drawShiftsTable();
	}
function duplicatShift()
{
		$this->load->model('Shiftmodel');
		$returnValue=$this->Shiftmodel->insert_duplicatShift();
		$tableData=$this->drawShiftsmangTable();
		echo $returnValue.'@@'.$tableData;
		
}		
	
	function updateShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->update_shift();
		$this->drawShiftsTable();
	}
function updateAllshift()
{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->update_Allshift();
		$this->drawShiftsmangTable();
}
	function deleteShift()
	{
		$this->load->model('Shiftmodel');
		$this->Shiftmodel->delete_shift();
		$this->drawShiftsTable();
	}	
	function getUserByDept()
	{
		/*echo "permissions:".$this->session->userdata('itemname');
		echo "user_id:".$this->session->userdata('user_id');*/
		
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_byDept();
		$notAvailableList=$this->constantmodel->getNotAvailUser_byDept();
		$totalTime='';
		$str='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			//  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			$str=$str.'<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
		  }
		   
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			//  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			 $str=$str.'<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>'; 
			  
		  }  
		//*******************get location by dept
//		echo $str.'@@'.$this->getLocationBydept();
		echo $str.'@@'.'hafiz';
	}
	function getAllEmp()
	{
		
		$this->load->model('constantmodel');
//		$staffList=$this->constantmodel->getAvailUser_byDept();
		$staffList=$this->constantmodel->getAllempAvailable();
		$staffListNotAvailable=$this->constantmodel->getAllempNotAvailable();
		$totalTime='';
		
		$output = array();
		 foreach($staffList as $staff_row)
		  {
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();
	 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			//  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			//$str=$str.'<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
		  	$temp['stffId'] = $staff_row->id;
			$temp['staffName'] = $staff_row->name;
			$temp['totalTime'] = $totalTime;
			$temp['hoursPerWeek'] = $staff_row->hoursPerWeek;
			
			array_push($output,$temp);
		  }
		$output2 = array();
		 foreach($staffListNotAvailable as $staff_row)
		  {
			unset($temp); // Release the contained value of the variable from the last loop
			$temp = array();
	 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			//  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			//$str=$str.'<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
		  	$temp['stffId'] = $staff_row->id;
			$temp['staffName'] = $staff_row->name;
			$temp['totalTime'] = $totalTime;
			$temp['hoursPerWeek'] = $staff_row->hoursPerWeek;
			
			array_push($output2,$temp);
		  }
		
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode(array('result1'=>$output,'result2'=>$output2));
		/*echo json_encode($output);
		echo json_encode($output2);*/
		

		
	}
	function getLocationBydept()
	{
		$this->load->model('constantmodel');
		$location=$this->constantmodel->get_locationBydept();
		$str='';
		if (count($location) == 0)
		{
			//echo 0;
			return ' <option value="">No Location</option>';
		}
		//$output = array();
		/*foreach($rec as $row)
		{*/
		else{
			 foreach ($location as $location_row)
			 {
				$str=$str.' <option value="'.$location_row->id.'">'.$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
			 }
			 return $str;
			//unset($temp); // Release the contained value of the variable from the last loop
		//	$temp = array();

			// It guess your client side will need the id to extract, and distinguish the ScoreCH data
		
		//$temp['id'] = $row->id;
		//$temp['name'] = $row->dep_name ;
		//$temp['dep_name'] = $row->dep_name ;
		
		//	array_push($output,$temp);
			
		//header('Access-Control-Allow-Origin: *');
		//	header("Content-Type: application/json");
		//	return json_encode($output);
			
			
		
//	}
		}
}
	function getallLocation()
	{
		$this->load->model('constantmodel');
		$location=$this->constantmodel->get_location_list();
		
		if (count($location) == 0)
		{
			echo 0;
			return;
		}
		$str='';
			 foreach ($location as $location_row)
			 {
				$str=$str.' <option value="'.$location_row->id.'">'.$location_row->id.'- '.$location_row->Location_name.'::'.$location_row->dep_name.'</option>';
			 }
			 echo $str;

}
	function getUserByJobtitle()
	{
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_Jobtitel();
		$notAvailableList=$this->constantmodel->getNotAvailUser_Jobtitel();
		 $totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->staff_name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=-45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->staff_name.'</option>';
			  
		  } 
		
	}

	function getUserBySpec()
	{
		/*if ($this->session->userdata('itemname')== null || $this->session->userdata('itemname') == '')
		return;*/
		$this->load->model('constantmodel');
		$staffList=$this->constantmodel->getAvailUser_specialization();
		$notAvailableList=$this->constantmodel->getNotAvailUser_specialization();
		$totalTime='';
		 foreach($staffList as $staff_row)
		  {
			 
			// $totalTime=$staff_row->hoursPerWeek-(($staff_row->totaltime)/3600);
			if ($staff_row->worktime =='')
				$totalTime=45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
			 
			  echo '<option  value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'|'.$staff_row->pricePerHour.'</option>';
			  
		  }
		 foreach($notAvailableList as $staff_row)
		  {
			  	if ($staff_row->worktime =='')
				$totalTime=45;
			else
			 $totalTime=(($staff_row->worktime)/3600)-$staff_row->hoursPerWeek;
	
	
			  echo '<option title="Unavailable" disabled="disabled" value='.$staff_row->id.'>'.$totalTime.'|'.$staff_row->name.'</option>';
			  
		  }		
	}
	
	function drawShiftsTable()
	{
		
		$this->load->model('Shiftmodel');
		$shiftrec = $this->Shiftmodel->get_all_shifts();
		
		
		$i=1;
		$statusrow='';
		foreach($shiftrec as $row)
		{
			if($row->status==1)
			 $statusrow='Draft';
			 else
			 $statusrow='Active';
			 echo '<tr>';		
			 echo '<td>'.$i++.'</td>';
			 echo '<td id="tdstaff'.$row->id.'">'.$row->Staff_name.'</td>';
			 echo '<td id="tdstart_date'.$row->id.'">'. $row->start_date.'</td>';
			  echo '<td id="tdend_date'.$row->id.'">'. $row->end_date.'</td>';
			 echo '<td id="tdstart_Time'.$row->id.'">'. $row->start_time.'</td>';
			 echo '<td id="tdend_Time'.$row->id.'">'. $row->end_time.'</td>';
			 echo '<td id="tdMarket'.$row->id.'" data-loid="'.$row->market_id.'">'. $row->market_name.'</td>';
			 echo '<td id="tdDepartment'.$row->id.'" data-loid="'.$row->dept_id.'">'. $row->dept_name.'</td>';
			 echo '<td id="tdlocation'.$row->id.'" data-loid="'.$row->locationId.'">'. $row->location_desc.'</td>';
			// echo '<td id="tdrdStatus'.$row->id.'">'. $statusrow.'</td>';
			if ($row->status == 1)
				 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
			else
				 echo '<td id="tdrdStatus'.$row->id.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 

			 echo '<td id="tdSpecial_shift'.$row->id.'">'. $row->Special_shift.'</td>';	 
			 echo '<td>
				  <button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateShift('.$row->id.')">
				  <i class="fa fa-edit"></i> Update </button>
				  <button id="btndelShift" name="btndelShift" type="submit" value="Delete" class="btn default btn-xs red" onclick="deleteShift('.$row->id.')"><i class="fa fa-trash-o"></i> delete</button>';
			 echo '</td>';  
			
			 echo '</tr>';
		}
										
		
	}
	function drawShiftsmangTable()
	{
		
		$this->load->model('Shiftmodel');
		$shiftrec = $this->Shiftmodel->get_all_shiftsmang();

		
		$i=1;
		$statusrow='';
		$specialrow='';
		$str='';
			foreach($shiftrec as $row)
				{
					if($row->status==1)
					 $statusrow='Draft';
					 else
					 $statusrow='Active';
					 if($row->Special_shift==1)
					 $specialrow='Yes';
					 else
					 $specialrow='No';
					 $str= '<tr><td id="tdlocation'.$i.'" data-loid="'.$row->map_id.'">'. $row->loc_name.'</td><td id="tdstart_date'.$i.'">'. $row->start_date.'</td><td id="tdend_date'.$i.'">'. $row->end_date.'</td><td id="tdstart_Time'.$i.'">'. $row->start_time.'</td><td id="tdend_Time'.$i.'">'. $row->end_time.'</td>';
					 
					if ($row->status == 1)
					 $str.= '<td id="tdrdStatus'.$i.'" data-stid="'.$row->status.'"><span class="label label-sm label-warning">'.$statusrow.'</span></td>';		 
					else
					 $str.= '<td id="tdrdStatus'.$i.'" data-stid="'.$row->status.'"><span class="label label-sm label-success">'.$statusrow.'</span></td>';		 
					 
					 $str.= '<td id="tdSpecial_shift'.$i.'">'.$specialrow.'</td><td id="tdemployees'.$i.'">'.$row->emp_name.'</td><td><button id="btnupdateShift" name="btnupdateShift" type="button" class="btn default btn-xs blue" onclick="updateAllshift('.$i.')"><i class="fa fa-edit"></i></button><button id="btnduplicatShift" name="btnduplicatShift" type="button" class="btn default btn-xs green" onclick="duplicatShift('.$i.')"><i class="fa fa-copy"></i></button></td></tr>';
				$i++;
				}
			return $str;	
			}
function shiftgriddata()
{
	/*
	date_default_timezone_set('Asia/Gaza');   
	$today_date = date('y-m-d');
	*/
	$this->load->model('Shiftmodel');
	$rec = $this->Shiftmodel->get_search_shifts($_REQUEST);
	
	
	$i = 1;
	$data = array();
	foreach($rec as $row)
	{
	$nestedData=array();
	/*
	if ($row->active_account == 1)
		$active = '<i class="fa fa-user font-green"></i>';
	else
		$active = '<i class="fa fa-user font-red-sunglo"></i>';
		*/
	/*$btn='<a href="'.base_url().'adduser/'.$row->user_name.'" class="btn default btn-xs purple">
	  <i class="fa fa-edit"></i> تعديل </a>';*/
	  $active='';
	  $typerow='';
	/*if($row->status==1)
	 $statusrow='Pending';
	else
	 $statusrow='Active';*/
	  $onclick='onclick="updateshiftstatus(\''.$row->id.'\')"';
	  $style = 'style="cursor:pointer"';
	 
	if($row->type==1)
	 $typerow='Shift';
	else
	 $typerow='Timeoff';
	// $start_date='';
	 //$start_date=date('Y-m-d',$row->start_date);  // for first day of this week
	 //*****************************************//
	 if (($row->user_id == $this->session->userdata('user_id') && $this->session->userdata('itemname') != 'admin') )
	 	//	|| $start_date <= $today_date)
	 {
	 	$onclick='';
		$style = '';
		
	 }
	 if ($row->status == 2)
	 {
		 //'.$this->session->userdata('user_id').'-'.$row->user_id.'
				$active = '<i id="i'.$row->id.'" class="fa fa-user font-green" '.$onclick.' '.$style.' ></i>';
				$active = $active .'&nbsp;&nbsp;&nbsp;&nbsp';
				
				
	}
	else
	{
		$active = '<i id="i'.$row->id.'" class="fa fa-user font-red-sunglo" '.$onclick.' '.$style.'></i>';
		$active = $active .'&nbsp;&nbsp;&nbsp;&nbsp';
		
		
	}
	 
	 //*******************************************//
	 
	 
	 
	$btn='<a class="btn default btn-xs purple" onclick="showshiftDetails(\''.$row->id.'\')">
	  <i class="fa fa-edit"></i> Details </a>';
	
	$nestedData[] = $i++;
	$nestedData[] = $row->Staff_name;
	$nestedData[] = $row->start_date;
	$nestedData[] = $row->end_date;
	$nestedData[] = $row->start_time;
	$nestedData[] = $row->end_time;
	$nestedData[] = $typerow;
	$nestedData[] = $active;
	$nestedData[] = $row->location_desc;
	
	//$nestedData[] = $active;
	$nestedData[] = $btn;
	
	$data[] = $nestedData;
	} // End Foreach
	
	$totalFiltered = count($rec);
	$totalData=$this->Shiftmodel->count_shifts();
	
	foreach($totalData as $res);
	$totalCount = $res->count_row;
	
	//$records["draw"] = $sEcho;
	$json_data = array(
			"draw"            => intval( $_REQUEST['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalCount ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
	
	echo json_encode($json_data);  // send data as json format
}
function updateShiftStatus()
{
	$this->load->model('Shiftmodel');
	$rec = $this->Shiftmodel->update_Shift_status();
	
}

}
?>