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

main_menu($link);

if(in_array('unlock',$auth))
{
	//delete_examination($link,$_POST['sample_id'],$GLOBALS['released_by']);
	update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['released_by'],'');
	update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['release_date'],'');
	update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['release_time'],'');
}
else
{
	echo '<h3>You are not authorized to un-release report</h3>';
}
view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
