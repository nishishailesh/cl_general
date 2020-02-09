<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

$GLOBALS['img_list']=array();

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
