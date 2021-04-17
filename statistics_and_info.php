<?php

require_once 'base/verify_login.php';
	////////User code below/////////////////////
require_once 'project_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link); 
show_dashboard($link);
if(isset($_POST['action']))
{
	if( $_POST['action']=='display_data')
	{
		$result=prepare_result_from_view_data_id($link,$_POST['id']);
	}
}

	//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';

?>
