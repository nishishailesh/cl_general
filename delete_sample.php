<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);

$sql='delete from result where sample_id=\''.$_POST['sample_id'].'\'';
$result=run_query($link,$GLOBALS['database'],$sql);
if($result)
{
	echo '<h3>Deleting result of sample_id='.$_POST['sample_id'].'</h3>';
}
$sql_blob='delete from result_blob where sample_id=\''.$_POST['sample_id'].'\'';
$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
if($result_blob)
{
	echo '<h3>Deleting attachments of sample_id='.$_POST['sample_id'].'</h3>';
}

view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
