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
dashboard($link);

	//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';

?>
