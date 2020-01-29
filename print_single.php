<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

$GLOBALS['img_res']='';

$GLOBALS['img_list']=array();

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
	
	echo '<table  cellpadding="2">
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
					echo '<td style="border-right:0.1px solid black;">';
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

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function print_sample($link,$sample_id)
{
	     $pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
	     
	     $pdf->sample_id=$sample_id;
	     $pdf->link=$link;
	     $pdf->profile_wise_ex_list=get_profile_wise_ex_list($link,$sample_id);
	     if($pdf->profile_wise_ex_list===false){return;}

	ob_start();
		view_sample_p($link,$sample_id,$pdf->profile_wise_ex_list);
		$myStr = ob_get_contents();
	ob_end_clean();

	//echo $myStr;
	//exit(0);
	     //left,top,right
	     $pdf->SetMargins(10, 40, 10);
	     $pdf->SetAutoPageBreak(TRUE, 30);
	     
	     $pdf->SetFont('courier', '', 9);
	     //$pdf->SetMargins(10, $pdf->current_y, 10); //no effect, page not added
	     //$pdf->SetY($pdf->current_y); //no effect, page not added
		 $pdf->AddPage();
		 $pdf->SetY($pdf->current_y); //required , setMargin after add page have no effect
		 $pdf->SetMargins(10, $pdf->current_y, 10); //will take effect from next page onwards

	     $pdf->writeHTML($myStr, true, false, true, false, '');
	     
	     //$pdf->writeHTML(count($GLOBALS['img_list']), true, false, true, false, '');
	 
	     //prepare for graphics
	    $y=$pdf->GetY(); //Y first?
		$x=$pdf->GetX();
		$i=0;
			
	     foreach($GLOBALS['img_list'] as $k=>$v)
	     {
			//somehow manual calculation of X and Y is required
			//public function Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, 
			//$dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array()) {
			
			$pdf->Image('@'.$v,$x+$i*40,$y+$i*0,40,20,$type='', $link='', $align='', $resize=true,
						$dpi=300, $palign='', $ismask=false, $imgmask=false, $border=1);
			$i++;
		 }
				     
	     $pdf->Output('report-'.$sample_id.'.pdf', 'I');
}

function display_dw_png($ex_result,$label)
{
	$ar=str_split($ex_result);
	
	$width=256; //128 X 2
    $height=128; //256;//223+32=255 make is half to save space
    $im = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($im, 255, 255, 225);
    $black = imagecolorallocate($im, 0,0,0);
	imagefill($im,0,0,$white);
	imagestring($im, 5, 3, 1, $label, $black);

	$px=0;
	$py=256;
	$y=2;
	foreach ($ar as $k=>$v)
	{
		$y=(256-ord($v))/2 +16; //make half add 16 to get baseline
		$x=$k*2;	//every two pixel
		imageline ( $im , $px , $py , $x , $y , $black ) ;
		
		$py=$y;
		$px=$x;
	}
	
	ob_start();	
	imagepng($im);
	$myStr = ob_get_contents();
	ob_end_clean();
	imagedestroy($im);	
	return $myStr;
}

function view_sample_p($link,$sample_id,$profile_wise_ex_list)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	echo '<table border="0"  cellpadding="2">';

	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		if($kp==$GLOBALS['pid_profile']){continue;}	//pid is displyed on each page//not needed here

		$pinfo=get_profile_info($link,$kp);
		$profile_edit_specification=json_decode($pinfo['edit_specification'],true);
		$print_hide=isset($profile_edit_specification['print_hide'])?$profile_edit_specification['print_hide']:'';
		if($print_hide=='yes'){continue;}	//not to be printed
		
		$display_name=isset($profile_edit_specification['display_name'])?$profile_edit_specification['display_name']:'';

		if($display_name!='no')
		{		
			echo '<tr><th colspan="3"><h2><u>'.$pinfo['name'].'</u></h2></th></tr>';
		}
		
		if($pinfo['profile_id']>$GLOBALS['max_non_ex_profile'])
		{
		
			$header=isset($profile_edit_specification['header'])?$profile_edit_specification['header']:'';
			if($header!='no')
			{
				echo_result_header_p();
			}
		
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
					echo '<td style="border-right:0.1px solid black;">';
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
		$type=isset($edit_specification['type'])?$edit_specification['type']:'';

		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$cinterval_l=isset($edit_specification['cinterval_l'])?$edit_specification['cinterval_l']:'';
		$ainterval_l=isset($edit_specification['ainterval_l'])?$edit_specification['ainterval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		$cinterval_h=isset($edit_specification['cinterval_h'])?$edit_specification['cinterval_h']:'';
		$ainterval_h=isset($edit_specification['ainterval_h'])?$edit_specification['ainterval_h']:'';
		$img=isset($edit_specification['img'])?$edit_specification['img']:'';


		if($img=='dw')
		{
			//echo '<tr>';
			//echo '<td style="border: 0.3px solid black;">'.$examination_details['name'].'</td>';
			//echo '<td style="border: 0.3px solid black;">';
			
			//just save graphics in global array, for display leter on
			$GLOBALS['img_list'][$examination_details['name']]=display_dw_png($ex_result,$examination_details['name']);
			//echo '</td>';
			//echo '<td style="border: 0.3px solid black;"></td></tr>';			
		}
		elseif($type=='subsection')
		{		
				echo '<tr>';
				echo '	<td style="border: 0.3px solid black;"></td>
				<td style="border: 0.3px solid black;"><h3 align="center">'.$examination_details['name'].'</h3></td>
				<td style="border: 0.3px solid black;"></td>';
				echo '</tr>';
		//echo '	<pre><table border="1"><tr><td>sadda</td><td>sadda</td></tr><tr><td>sadda</td><td>sadda</td></tr></table>'.htmlspecialchars($help).'</pre>';
		}
		else
		{		
				echo '<tr>';
		echo '	<td style="border: 0.3px solid black;">'.$examination_details['name'].'</td>
				<td style="border: 0.3px solid black;"><pre>'.htmlspecialchars($ex_result.' '.
				decide_alert($ex_result,$interval_l,$cinterval_l,$ainterval_l,$interval_h,$cinterval_h,$ainterval_h)).'</pre></td>
				<td style="border: 0.3px solid black;">'.nl2br(htmlspecialchars($help)).'</td>';
				echo '</tr>';
		//echo '	<pre><table border="1"><tr><td>sadda</td><td>sadda</td></tr><tr><td>sadda</td><td>sadda</td></tr></table>'.htmlspecialchars($help).'</pre>';
		}

}		

function display_dw_p($ex_result)
{
	$ar=str_split($ex_result);

	$width=256; //128 X 2
    $height=128; //256;//223+32=255 make is half to save space
    $im = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($im, 255, 255, 225);
    $black = imagecolorallocate($im, 0,0,0);
	imagefill($im,0,0,$white);
	$px=0;
	$py=256;
	foreach ($ar as $k=>$v)
	{
		$y=(256-ord($v))/2 +16; //make half add 16 to get baseline
		$x=$k*2;	//every two pixel
		imageline ( $im , $px , $py , $x , $y , $black ) ;
		$py=$y;
		$px=$x;
	}
	
	ob_start();	
	imagepng($im);
	$myStr = base64_encode(ob_get_contents());
	ob_end_clean();

	//echo "<img src='data:image/png;base64,".$myStr."'/>";
	echo '<img src=\'data:image/png;base64,'.$myStr.'\'>';
	//echo "x<img src='img/img.png'>y";
	imagedestroy($im);	
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
