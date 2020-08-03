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
//exit();

$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);


$to=strlen($_POST['to'])>0?$_POST['to']:$_POST['from'];

for ($i=$_POST['from'];$i<=$to;$i++)
{
	$released=get_one_ex_result($link,$i,$GLOBALS['released_by']);
	$interim_released=get_one_ex_result($link,$i,$GLOBALS['interim_released_by']);
	$ow=get_one_ex_result($link,$i,$GLOBALS['OPD/Ward']);
	$location_post='__ex__'.$GLOBALS['OPD/Ward'];

	if(strlen($released)!=0 || strlen($interim_released)!=0 )
	{
		if(strlen($_POST[$location_post])>0)
		{
			if($ow==$_POST[$location_post])
			{
				$at_least_one_sample=true;
				print_sample($link,$i,$pdf);
			}
		}
		else
		{
			$at_least_one_sample=true;
			print_sample($link,$i,$pdf);
		}
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

if($error===false  && $at_least_one_sample!==false)
{
	$pdf->Output('report.pdf', 'I');
}
else
{
	echo 'nothing to print. Can I go Home? Sir/Madam?';
}
//////////////user code ends////////////////
//tail();

//////////////Functions///////////////////////

?>
