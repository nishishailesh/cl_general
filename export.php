<?php
//session_start();
$nojunk='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

//////////////////Code for salary//////////

//echo '<pre>';print_r($_POST);echo '</pre>';

$ex_sample_id=explode(',',$_POST['sample_id']);
//print_r($ex_sample_id);
//export_h_examination($link);

$fp = fopen('php://output', 'w');
if ($fp) 
{
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="export.csv"');
}

$ex_list=export_h_examination($link);

fputcsv($fp, $ex_list);
		
foreach($ex_sample_id as $val)
{
	$result_data=export_h_result($link,$val,$ex_list);
	fputcsv($fp, $result_data);

}

function export_h_examination($link)
{
	$sql='select * from profile order by profile_id';
	$result=run_query($link,$GLOBALS['database'],$sql);

	$ret=array(0=>'DbID');
	//print_r($ret);
	while($ar=mysqli_fetch_assoc($result))
	{
		$explod=explode(',',$ar['examination_id_list']);
		foreach($explod as $v)
		{
			$ex_detail=get_one_examination_details($link,$v);
			$ret[$v]=$ex_detail['name'];
		}
	}
	return $ret;
}

function export_h_result($link,$sample_id,$ex_list)
{
	foreach($ex_list as $k=>$v)
	{
		$sql='select * from result where sample_id=\''.$sample_id.'\' and examination_id=\''.$k.'\'';
		//echo $sql;
		$result=run_query($link,$GLOBALS['database'],$sql);
		$ar=get_single_row($result);
		//print_r($ar);
		$ret[$k]=isset($ar['result'])?$ar['result']:'';
		//print_r( $ret);
	}
	$ret['0']=$sample_id;
	return $ret;
}

















?>
