<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

/////Note////
//it is not by mrd
//it is by databaase ID
main_menu();
echo '<div id=response></div>';

if($_POST['action']=='get_dbid')
{
	get_dbid($link);
}
elseif($_POST['action']=='view_dbid')
{
	echo_class_button($link,'OGDC')	;
	view_sample($link,$_POST['sample_id']);
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function get_dbid()
{
	$YY=strftime("%y");

echo '<form method=post>';
echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="mrd">Database ID</label>
			<input type=number size=13 id=mrd name=sample_id class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
echo '</div>';
echo '<button type=submit class="btn btn-primary form-control" name=action value=view_dbid>View</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
}

function view_mrd($link,$mrd)
{
	$sql='select sample_id from result where examination_id=1 and result=\''.$mrd.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	while($ar=get_single_row($result))
	{
		//print_r($ar);
		view_sample($link,$ar['sample_id']);
		//edit_sample($link,$ar['sample_id']);
	}
	
}

?>
