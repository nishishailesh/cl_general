<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

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
		//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, 'Page '.$this->getPageNumGroupAlias().'/'.$this->getPageGroupAlias(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}	
}


$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//echo '<pre>';print_r($_POST);echo '</pre>';

$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
//$pdf = new ACCOUNT1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
for ($i=$_POST['from'];$i<=$_POST['to'];$i++)
{
	$released=get_one_ex_result($link,$i,$GLOBALS['released_by']);
	//echo 'xxx'.$i.$released_by;
	if(strlen($released)!=0)
	{
		$pdf->startPageGroup();
		print_sample($link,$i,$pdf);
		
		
		/////////////DW
		//$sql='select * from result_blob where sample_id=\''.$i.'\'';
		//$result=run_query($link,$GLOBALS['database'],$sql);


		//while($ar=get_single_row($result))
		//{
			//$ex_result=get_one_ex_result_blob($link,$i,$ar['examination_id']);
			//$png[]=display_dw_png($ex_result,$ar['examination_id']);
		//}

		
		//$x=$pdf->GetX();
		//$y=$pdf->GetY();

		//foreach($png as $v)
		//{
			//$pdf->Image('@'.$v,$x,$y,40,20,$type='', $link='', $align='', $resize=true,
					//$dpi=300, $palign='', $ismask=false, $imgmask=false, $border=1);	
			//$x=$x+40;
		//}
		
		
		///////////////
	}
	else
	{
		echo '<div class="d-inline-block">Sample _ID='.$i.' is [ not released / does not exist ]</div>';
		sample_id_view_button($i,'_blank');
	}
}

$pdf->Output('report-multi.pdf', 'I');
//////////////user code ends////////////////
//tail();

echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
