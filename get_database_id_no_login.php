<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/common.php';
require_once 'config.php';	
require_once $GLOBALS['main_user_location'];

//echo '<pre>';print_r($_POST);echo '</pre>';

//require_once 'base/verify_login.php';
head();
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

get_dbid();

//////////////user code ends////////////////
tail();


//////////////Functions///////////////////////

function get_dbid()
{
	$YY=strftime("%y");

echo '<form method=post action=print_single_no_login.php target=_blank>';
echo '<div class="text-center"><span class="bg-warning">Both <span class="badge badge-primary ">Sample_ID</span> and <span class="badge badge-primary ">MRD</span> must exactly match to retrive report</span></div>';

echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="mrd">Sample ID</label>
			<input type=number size=13 id=mrd name=sample_id class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
echo '</div>';
get_basic();

echo '<button type=submit class="btn btn-primary form-control" name=action value=view_dbid>View</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
}


?>
