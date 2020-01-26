<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

class ACCOUNT1 extends TCPDF {
	public $sample_id;
	public $link;
	public $current_y;
	public $profile_wise_ex_list;
	public function Header() 
	{
		ob_start();	
	$sr=get_one_ex_result($this->link,$this->sample_id,$GLOBALS['sample_requirement']);
	$sr_array=explode('-',$sr);
	$header=$GLOBALS[$sr_array[2]];
	
	echo '<table>
	<tr><td style="text-align:center" colspan="3"><h2>'.$header['name'].'</h2></td></tr>
	<tr><td style="text-align:center" colspan="3"><h3>'.$header['section'].'<b> (Sample ID:</b> '.$this->sample_id.')</h3></td></tr>
	<tr><td style="text-align:center" colspan="3"><h5>'.$header['address'].'</h5></td></tr>
	<tr><td style="text-align:center" colspan="3"><h5>'.$header['phone'].'</h5></td></tr>';

	
			$count=1;
			foreach($this->profile_wise_ex_list[$GLOBALS['pid_profile']] as $v)
			{
				if($count%3==1)
				{
					echo '<tr>';
				}

				if($v<100000)
				{
					$r=get_one_ex_result($this->link,$this->sample_id,$v);
					echo '<td>';
					view_field_hr_p($this->link,$v,$r);	
					echo '</td>';
				}
				else
				{
					//view_field_blob_hr($link,$ex_id,$sample_id);	
				}
				
				
				if($count%3==0)
				{
					echo '</tr>';
				}
			$count++;
			}
			$count--;
			
			if($count%3==1){echo '<td></td><td></td></tr>';}
			if($count%3==2){echo '<td></td></tr>';}
			
	echo '</table>
	<hr></hr>';

	 $myStr = ob_get_contents();
	 ob_end_clean();
	$this->SetY(10);
	$this->writeHTML($myStr, true, false, true, false, '');
	$this->current_y=$this->GetY();
	}
	
	public function Footer() 
	{
	    $this->SetY(-20);
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}	
}


$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);


	print_sample($link,$_POST['sample_id']);

//////////////user code ends////////////////
//tail();

echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function print_sample($link,$sample_id)
{

	//echo $myStr;
	//exit(0);

	     $pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
	     $pdf->sample_id=$sample_id;
	     $pdf->link=$link;
	     $pdf->profile_wise_ex_list=get_profile_wise_ex_list($link,$sample_id);
	     if($pdf->profile_wise_ex_list===false){return;}
	     
	ob_start();
	view_sample_p($link,$sample_id,$pdf->profile_wise_ex_list);
	  $myStr = ob_get_contents();
	ob_end_clean();
	
		     
	     //left,top,right
	     $pdf->SetMargins(10, 40, 10);

	     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);

	     
	     $pdf->SetFont('courier', '', 9);
		 $pdf->AddPage();
		 $pdf->SetY($pdf->current_y);
	     $pdf->writeHTML($myStr, true, false, true, false, '');
	     //$pdf->writeHTML($pdf->current_y, true, false, true, false, '');	     
	     $pdf->Output('print_dc.pdf', 'I');
}


function view_sample_p($link,$sample_id,$profile_wise_ex_list)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	echo '<table border="0">';

	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		if($kp==$GLOBALS['pid_profile']){continue;}
		$pinfo=get_profile_info($link,$kp);

		echo '<tr><th colspan="3"><br><h2><u>'.$pinfo['name'].'</u></h2></th></tr>';
		if($pinfo['profile_id']>$GLOBALS['max_non_ex_profile'])
		{
			echo_result_header_p();
		
			foreach($vp as $ex_id)
			{
				if($ex_id<100000)
				{
					view_field_p($link,$ex_id,$ex_list[$ex_id]);	
				}
			}
		}
		else
		{	
			$count=1;

			foreach($vp as $ex_id)
			{
				if($count%3==1)
				{
					echo '<tr>';
				}

				if($ex_id<100000)
				{
					echo '<td>';
					view_field_hr_p($link,$ex_id,$ex_list[$ex_id]);	
					echo '</td>';
				}
				else
				{
					//view_field_blob_hr($link,$ex_id,$sample_id);	
				}
				
				
				if($count%3==0)
				{
					echo '</tr>';
				}
			$count++;
			}
			$count--;
			
			if($count%3==1){echo '<td></td><td></td></tr>';}
			if($count%3==2){echo '<td></td></tr>';}
			
		}
	}
	
	echo '</table>';	
}

function view_field_p($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'';
		//$help=str_replace('\n','<br>',$help);
		$interval=isset($edit_specification['interval'])?$edit_specification['interval']:'';
		
				echo '<tr>';
		echo '	<td style="border: 0.3px solid black;">'.$examination_details['name'].'</td>
				<td style="border: 0.3px solid black;"><pre>'.htmlspecialchars($ex_result.' '.decide_alert($ex_result,$interval,'','','','','')).'</pre></td>
				<td style="border: 0.3px solid black;">'.nl2br(htmlspecialchars($help)).'</td>';
				echo '</tr>';
		//echo '	<pre><table border="1"><tr><td>sadda</td><td>sadda</td></tr><tr><td>sadda</td><td>sadda</td></tr></table>'.htmlspecialchars($help).'</pre>';

}		

function view_field_hr_p($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'';
		$interval=isset($edit_specification['interval'])?$edit_specification['interval']:'';
		
		echo '<b>'.$examination_details['name'].':</b> '.htmlspecialchars($ex_result.' '.decide_alert($ex_result,$interval,'','','','',''));
}	

function echo_result_header_p()
{
	echo '<tr><td width="25%">Examination</td><td width="30%">Result</td><td width="45%">Unit, Ref. Intervals ,(Method)</td></tr>';
}

function get_profile_wise_ex_list($link,$sample_id)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	//print_r($ex_list);
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	//print_r($rblob);
	$result_plus_blob_requested=$ex_list+$rblob;
	//print_r($result_plus_blob_requested);
	if(count($result_plus_blob_requested)==0)
	{
		echo '<h3>No such sample with sample_id='.$sample_id.'</h3>';
		return false;
	}
	
	return $profile_wise_ex_list=ex_to_profile($link,$result_plus_blob_requested);
}
?>
