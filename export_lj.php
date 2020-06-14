<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'project_common.php';

//my_print_r($_POST);
////////User code below/////////////////////	
$qc_sample_type=array('QC-QC-BI');
$GLOBALS['qc_eqipment_ex_id']=9000;
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$array=get_date_range_sample_id($link,$_POST['from_date'],$_POST['to_date']);
//echo '<pre>';
$fp = initialize_csv_export_file();
if($fp!==false)
{
	foreach ($array as $sample_id)
	{
		$ar=mk_array_for_one_qc_result($link,$sample_id);
		foreach($ar as $sub_ar)
		{
			fputcsv($fp,$sub_ar);
			//print_r($sub_ar);
		}
	}
}
//////////////user code ends////////////////
//tail();


?>
