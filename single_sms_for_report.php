<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

echo '            <link rel="stylesheet" href="project_common.css">
				<script src="project_common.js"></script>';  
 
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);
insert_sample_id_link($link,$_POST['sample_id']);
$patient_name_value=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['patient_name']);
$location_value=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['OPD/Ward']);

ob_start();

//view_sample_sms($link,$_POST['sample_id']);
echo "\nBiochemistry Report NCHS, Surat:\n";
echo $patient_name_value."\n";
echo $location_value."\n";
echo "Report PDF download link::\n";
make_link($link,$_POST['sample_id']);

$x = ob_get_contents();
ob_end_clean();

//echo $x;
$GLOBALS['mobile_id']=1025;
$mobile_value=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['mobile_id']);

$ret=send_sms($x,$mobile_value);
echo '<h5 class="text-success">'.$ret.'</h5>';

if(substr($ret,0,3)=='100')
{
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['sms_date'],strftime("%Y-%m-%d"));
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['sms_time'],strftime("%H:%M"));
}
view_sample($link,$_POST['sample_id']);

//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';



?>
