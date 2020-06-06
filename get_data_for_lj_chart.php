<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu();

$qc_levels=array(5,8);
$qc_sample_type=array('QC-QC-BI');

echo '<h2>QC</h2>';
get_lj_display_parameter($link,$qc_levels);



//////////////user code ends////////////////
tail();

echo '<pre>';print_r($_POST);echo '</pre>';

//////////////data//////

//////////////Functions///////////////////////

function get_lj_display_parameter($link,$qc_levels)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		read_checkbox($qc_levels);
		echo '<input type=date name=from_date>';
		echo '<input type=date name=to_date>';
		//echo '<input type=text name=examination>';	
		get_examination_names($link);
		echo '<input type=submit name=make_lj>';	
	echo '</form>';
}

function read_checkbox($ar)
{
	foreach ($ar as $v)
	{
		echo '<input type="checkbox" id=\'chk_'.$v.'\' name=\'chk_'.$v.'\'>
				<label for=\'chk_'.$v.'\'>'.$v.'</label>';
	}
}

function get_examination_names($link)
{
	$sql='select examination_id,name from examination where sample_requirement="QC-QC-BI"';
	mk_select_from_sql_kv($link,$sql,'examination_id','name','examination_id','examination_id',$disabled='',$default='');
}

?>
