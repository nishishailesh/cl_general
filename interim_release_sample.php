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

if(in_array('interimlock',$auth))
{
	delete_examination($link,$_POST['sample_id'],$GLOBALS['interim_released_by']);
	insert_update_one_examination_with_result($link,$_POST['sample_id'],
			$GLOBALS['interim_released_by'],$user['name'].' ('.strftime("%Y-%m-%d %H:%M").')');
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['interim_release_date'],strftime("%Y-%m-%d"));
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['interim_release_time'],strftime("%H:%M"));			
}
else
{
	echo '<h3>You are not authorized to release interim report</h3>';
}
view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
