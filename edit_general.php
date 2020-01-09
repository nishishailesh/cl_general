<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu();
echo '<div id=response></div>';
if($_POST['action']=='edit_general')
{
	edit_sample($link,$_POST['sample_id']);
	//view_primary_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='upload')
{
	save_result_blob($link,$_POST['sample_id']);
	
	edit_sample($link,$_POST['sample_id']);
	//view_primary_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='delete')
{
	delete_examination($link,$_POST['sample_id'],$_POST['examination_id']);
}
if($_POST['action']=='insert')
{
	add_new_examination_and_profile($link,$_POST['sample_id'],$_POST['list_of_selected_examination'],$_POST['list_of_selected_profile']);
	edit_sample($link,$_POST['sample_id']);
	//view_primary_sample($link,$_POST['sample_id']);
}
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////


//////////////Functions///////////////////////

?>

