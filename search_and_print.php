<?php
//	$GLOBALS['nojunk']='';

require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
	main_menu($link);

echo '<h3>Search and print Sample IDs</h3>';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if($_POST['action']=='get_search_condition')
{
	get_search_condition($link);
}
elseif($_POST['action']=='set_search')
{
	set_search($link,$action=' action=print_searched.php target=_blank',$for_print='yes');
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
