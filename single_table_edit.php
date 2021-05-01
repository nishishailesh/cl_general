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
//print_r($auth);

if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link);


if($_POST['action']=='get_record_list')
{
	list_available_tables($link);
}

manage_stf($link,$_POST);

echo '
<h5>Table managed in this utility must have following properties</h5>
<ul>
	<li>auto-incremented primary key named <b>id</b></li>
	<li>All except <b>id</b> must be able to take null value</li>
	<li>two fields <b>recording_time</b> of datetime type and <b> recorded_by </b> of varchar type are mandatory</li>
	<li>id,recording_time and recorded_by are not user editable</li>
	<li>all blob fields named <b>xyz</b> must have <b>xyz_name</b> field for storing uploaded file name</li>
	<li>For date,time,dropdown, text, text area etc, respective entry needs to be made in table <b>table_field_specification</b></li>
</ul>


';
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////

?>
