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

$subject='Biochemistry_Sample_ID_'.$_POST['sample_id'];
$content='<h5>Please Find the report attached herewith</h5>';

$mail_sql='insert into email (`to`,subject,content,sent,att,att_name) 
		values(\''.$email.'\',\''.$subject.'\',\''.$content.'\',0,\''.my_safe_string($rlink,$output).'\',\''.$subject.'.pdf\')';
//echo $mail_sql;

if(run_query($rlink,'email',$mail_sql))
{
  echo 'email sent to main server. It may reach destination after 5-30 minutes, depending on main server configuration<br>';
}
else
{
  echo 'email can not be sent to main server.';
}
view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';


?>
