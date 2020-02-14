<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'project_common.php';

//my_print_r($_POST);
////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

prepare_result_for_export($link,$_POST['id']);
//////////////user code ends////////////////
tail();
?>
