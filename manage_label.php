<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
require_once 'single_table_edit_common.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);

if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link);

echo '	
<form method=post class="form-group m-0 p-0">
	<input type=hidden name=session_name value=\''.session_name().'\'>
	<button class="btn btn-outline-primary m-0 p-0" formaction=get_id_range_for_small_barcode.php type=submit name=action value=get_sample_id_range>Sample Tube Barcode</button>					
	<button class="btn btn-outline-primary m-0 p-0" formaction=get_4_line.php type=submit name=action value=get_4_line>4 Line Label</button>
	<button class="btn btn-outline-primary m-0 p-0" formaction=get_4_line_2_columns.php type=submit name=action value=get_4_line_2_columns>4 Line Label(two column)</button>
</form>';

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
?>
