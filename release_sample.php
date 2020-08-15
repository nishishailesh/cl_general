<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
//print_r($auth);
main_menu($link);

if(in_array('lock',$auth))
{
	//delete_examination($link,$_POST['sample_id'],$GLOBALS['released_by']);
	//insert_one_examination_with_result($link,$_POST['sample_id'],
	//		$GLOBALS['released_by'],$user['name'].' ('.strftime("%Y-%m-%d %H:%M").')');
	
	update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['released_by'],$user['name'].' ('.strftime("%Y-%m-%d %H:%M").')');

}
else
{
	echo '<h3>You are not authorized to release report</h3>';
}
view_sample($link,$_POST['sample_id']);
calculate_tat($link,$_POST['sample_id']);

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
