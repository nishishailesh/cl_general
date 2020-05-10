<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

$GLOBALS['img_list']=array();

$error=false;
$at_least_one_sample=false;

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//echo '<pre>';print_r($_POST);echo '</pre>';

$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
//$pdf = new ACCOUNT1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



for ($i=$_POST['from'];$i<=$_POST['to'];$i++)
{
	//echo 'entered';
	$released=get_one_ex_result($link,$i,$GLOBALS['released_by']);
	$interim_released=get_one_ex_result($link,$i,$GLOBALS['interim_released_by']);

	//echo 'xxx'.$i.$released_by;
	if(strlen($released)!=0 || strlen($interim_released)!=0 )
	{
		$at_least_one_sample=true;
		print_sample($link,$i,$pdf);
	}
	else
	{
		echo '<link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
		echo '<div class="d-inline-block">Sample _ID='.$i.' is [ not released / does not exist ]</div>';
		sample_id_view_button($i,'_blank');
		$error=true;
	}
}

if($error===false && $at_least_one_sample!==false)
{
	$pdf->Output('report.pdf', 'I');
}
else
{
	echo 'nothing to print. Can I go Home? Sir/Madam?';
}
//////////////user code ends////////////////
//tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
