<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if(!isset($_SESSION['display_style'])){$_SESSION['display_style']='full';}
$_SESSION['display_style']=isset($_POST['display_style'])?$_POST['display_style']:$_SESSION['display_style'];

if($_SESSION['display_style']=='full')
{
	main_menu($link);
}
echo '<div class="d-inline-block">';
select_display_style();
echo '</div><div class="d-inline-block">';
get_dbid_small();
echo '</div>';

if($_SESSION['display_style']=='full')
{
	view_sample($link,$_POST['sample_id']);
	//calculate_tat($link,$_POST['sample_id']);
	//$GLOBALS['library']='';
	//	require_once 'get_data_for_delta_check.php';
	//unset($GLOBALS['library']);
	//show_delta_for_single_sample($link,$_POST['sample_id']);
}
else
{
	view_sample_compact($link,$_POST['sample_id']);
}


//////////////user code ends////////////////
tail();


//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function select_display_style()
{
	echo '<div class="d-inline-block" ><form method=post class=print_hide>
	<button class="btn btn-outline-success btn-sm m-0 p-0" name=display_style value=full >Full</button>
	<button class="btn btn-outline-success btn-sm  m-0 p-0" name=display_style value=compact >Compact</button>
	<input type=hidden name=sample_id value=\''.$_POST['sample_id'].'\'>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=action value=view_single>
	</form></div>';
}


function get_dbid_small()
{
echo '<form method=post action=view_single.php>';
echo '<input name=sample_id value=\''.$_POST['sample_id'].'\' class="m-0 p-0 input-sm" type=text size=6>';
echo '<button type=submit class="btn btn-sm m-0 p-0 btn-primary" name=action value=view_dbid>View</button>';
echo '<input  type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
}
?>
