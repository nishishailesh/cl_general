<?php
$GLOBALS['nojunk']='';

require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

////////Start

$search_array=prepare_search_array($link);
if(count($search_array)==0)
{
	echo '<h3>No meaningful search conditions provided!!</h3>';
	exit(0);
}

//echo '<pre>';	
//print_r($_POST);
//print_r($search_array);



$from=' ';
$counter=0;
foreach ($search_array as $kd=>$vd)
{
	$tn='r'.$counter;
	$from=$from.' result '.$tn.' ,';
	$counter++;
}
if(substr($from,-1,1)==',')
{
	$from=substr($from,0,-1);
}

$counter=0;
$w=' ';
foreach ($search_array as $kd=>$vd)
{
	$tn='r'.$counter;
	
	$w= $w. ' ('.$tn.'.examination_id=\''.$kd.'\' and '.$tn.'.result like \'%'.$vd.'%\' ) and ';
	if($counter>0)
	{
		$tp=' r'.($counter-1);
		$w=$w.' '.$tn.'.sample_id='.$tp.'.sample_id and ';
	}
	$counter++;
}

if(substr($w,-4,4)=='and ')
{
	$w=substr($w,0,-4);
}
		
$sql='select * from '.$from.' where '.$w;
//echo $sql; 
$ret=array();
$result=run_query($link,$GLOBALS['database'],$sql);

//////////////////////end of search, now printing starts

$first=TRUE;
$error=false;
$at_least_one_sample=false;

$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
		
while($ar=get_single_row($result))
{
	$sid=$ar['sample_id'];
	$released=get_one_ex_result($link,$sid,$GLOBALS['released_by']);
	$interim_released=get_one_ex_result($link,$sid,$GLOBALS['interim_released_by']);

	if(sample_exist($link,$sid))
	{
		if(strlen($released)!=0 || strlen($interim_released)!=0 )
		{
				$at_least_one_sample=true;
				print_sample($link,$sid,$pdf);
		}
		else
		{
				sample_id_view_button($sid,'_blank',$sid.' is not released');
				$error=true;
		}
	}	
}

//echo '|'.$error.'|'.$at_least_one_sample.'|';
if($error===false && $at_least_one_sample!==false)
{
	$pdf->Output('report.pdf', 'I');
}
else
{
	echo 'nothing to print. Can I Hibernate?';
}
//print_r($ret);
//echo '</pre>';


//////////////user code ends////////////////
//tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
