<?php
require_once 'base/verify_login.php';
	////////User code below/////////////////////
require_once 'project_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

		main_menu(); 
		dashboard($link);
	//////////////user code ends////////////////
tail();
?>
