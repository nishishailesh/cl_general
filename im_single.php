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

/*
$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);

print_sample($link,$_POST['sample_id'],$pdf);

$output=$pdf->Output('report.pdf', 'S');

$rlink=get_remote_link($GLOBALS['email_db_server'],$GLOBALS['email_user'],$GLOBALS['email_pass']);

$email=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['email']);

echo 'Result will sent to ('.$email.')<br>';
if(strlen($email)==0)
{
  echo 'email address not available';
  exit(0);
}
*/

//				recording_time=now(),
//				recorded_by=\''.$_SESSION['login'].'\'

$send_to='shailesh_patel@nchs.gmcsurat.edu.in';
$message=fetch_lab_report($link,$_POST['sample_id']);
$xmpp_sql='insert into im_message (send_to,message,message_status,recording_time,recorded_by) 
		values
		(
			\''.$send_to.'\',
			\''.$message.'\',
			0,
			now(),
			\''.$_SESSION['login'].'\'
		)';
	
	
//			\''.my_safe_string($link,$message).'\',

//echo $xmpp_sql;

if(run_query($link,$GLOBALS['database'],$xmpp_sql))
{
  echo 'xmpp message sent to main server. It may reach destination after 5-30 minutes, depending on main server configuration<br>';
}
else
{
  echo 'xmpp message can not be sent to main server.';
}
view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';


function fetch_lab_report($link,$sample_id)
{
	$ret= '
	Biochemistry Lab Report\n';

	$sql='select sample_id,examination.examination_id,name,result from result,examination where sample_id=\''.$sample_id.'\' and examination.examination_id=result.examination_id';
    $result=run_query($link,$GLOBALS['database'],$sql);

    $ret=$ret.'sample_id:'. $sample_id.'\n';

	while($ar=get_single_row($result))
	{
		$ret=$ret.str_pad($ar['name'],20).':'.$ar['result'].'\n';
	}
	return $ret.'\n
	';

}



?>
