<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'project_common.php';

//print_r($_POST);
/*
Array (
[session_name] => sn_1631566223 
[qc_equipment] => XL_1000 
[from_date] => 2020-06-10 
[to_date] => 2020-06-10 
[list_of_selected_examination] => 5009 
[show_lj] => export_lj_date 
) 
*/
//exit();
////////User code below/////////////////////	
$qc_sample_type=array('QC-QC-BI');
$GLOBALS['qc_equipment_ex_id']=9000;
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if($_POST['show_lj']=='export_lj_date')
{
	$array=get_date_range_sample_id($link,$_POST['from_date'],$_POST['to_date'],$_POST);
}
elseif($_POST['show_lj']=='export_lj_sample')
{
	$array=get_qc_sample_id_from_parameters($link,$_POST);
}


//echo '<pre>';
$all_result=array();
$fp = initialize_csv_export_file();
if($fp!==false)
{
	foreach ($array as $sample_id)
	{
		$ex_requested=explode(',',$_POST['list_of_selected_examination']);
		$ar=mk_array_for_one_qc_result($link,$sample_id,$ex_requested);
		$all_result[]=$ar;
		foreach($ar as $sub_ar)
		{
			fputcsv($fp,$sub_ar);
			//print_r($sub_ar);
		}
	}
}


//print_r($all_result);
//////////////user code ends////////////////
//tail();


?>
