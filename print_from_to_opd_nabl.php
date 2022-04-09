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

	if(sample_exist($link,$i))					//if there is such sample
	{
		if(strlen($_POST[$location_post])>0)	//if location given
		{
			if($ow==$_POST[$location_post])		//if locaion match
			{
				if(strlen($released)!=0 || strlen($interim_released)!=0 )	//if released/interim
				{
					$at_least_one_sample=true;
					print_sample($link,$i,$pdf);
				}
				else 														//else output html(no pdf)
				{
					//echo '<link rel="stylesheet" href="project_common.css">
					//  <script src="project_common.js"></script>';
					//echo '<div class="d-inline">Sample _ID='.$i.' is [ not released ]</div>';
					sample_id_view_button($i,'_blank',$i.' is not released');
					$error=true;
				}
			}
			else 								//if location do not match
			{
				//do nothing
			}
		}
		else 									//location not given, print all
		{
				if(strlen($released)!=0 || strlen($interim_released)!=0 )	//if released/interim
				{
					$at_least_one_sample=true;
					print_sample($link,$i,$pdf);
				}
				else 														//else output html(no pdf)
				{
					//echo '<link rel="stylesheet" href="project_common.css">
					//  <script src="project_common.js"></script>';
					//echo '<div class="d-inline">Sample _ID='.$i.' is [ not released ]</div>';
					sample_id_view_button($i,'_blank',$i.' is not released');
					$error=true;
				}
		}
	}
	else  //no such sample
	{
		//do nothing
	}
}

if($error===false  && $at_least_one_sample!==false)
{
	$pdf->Output('report.pdf', 'I');
}
else
{
	echo 'nothing to print';
}
//////////////user code ends////////////////
//tail();

//////////////Functions///////////////////////

?>
