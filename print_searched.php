<?php
$GLOBALS['nojunk']='';

require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

	$search_array=prepare_search_array($link);
	//echo '<pre>';
	//print_r($_POST);
	//print_r($search_array);
	//echo '</pre>';
	$first=TRUE;
	$error=false;

	$temp=array();
	foreach ($search_array as $sk=>$sv)
	{
		$temp=get_sample_with_condition($link,$sk,$sv,$temp,$first);
		$first=FALSE;
	}
	//print_r($temp);
	if(count($temp)>0)
	{
		$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
		foreach ($temp as $sid)
		{
			$released=get_one_ex_result($link,$sid,$GLOBALS['released_by']);
			//echo 'xxx'.$i.$released_by;
			if(strlen($released)!=0)
			{
				print_sample($link,$sid,$pdf);
			}
			else
			{
				echo '<div class="d-inline-block">Sample _ID='.$sid.' is [ not released / does not exist ]</div>';
				sample_id_view_button($sid,'_blank');
				echo '<br>';
			}
		}
		
		if($error===false)
		{
			$pdf->Output('report-multi.pdf', 'I');
		}
	}
	else
	{
		echo '<h3>No Sample matching // Nothing meaningful provided!!</h3>';
	}


//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
