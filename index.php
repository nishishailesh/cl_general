<?php
session_name('sn_'.rand(1000000000,1999999999));
session_start();
require_once 'base/common.php';
require_once 'config.php';
require_once 'project_common.php';
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
		  
head($GLOBALS['application_name']);
login();
/*
echo '<form method=post action=get_database_id_no_login.php class="text-center jumbotron">
		<button class="btn btn-info">Get PDF Report without Login (for Clinical Residents/Staff)</button>
		<input type=hidden name=login value=9999999999>
		<input type=hidden name=password value=doctor>	
		<input type=hidden name=session_name value=\''.session_name().'\'>
		</form>';
*/
mget_dbid();		
tail();

function mget_dbid()
{
	$YY=strftime("%y");

echo '<form method=post action=print_single_no_login.php target=_blank class="jumbotron m-0 p-3 border border-primary">';
echo '<h3>Get Report without Login</h3>';
echo '<div class="text-center"><span class="bg-warning">Both <span class="badge badge-primary ">Sample_ID</span> and <span class="badge badge-primary ">MRD</span> must exactly match to retrive report</span></div>';

echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="sid">Sample ID</label>
			<input type=number size=13 id=sid name=sample_id class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
echo '</div>';
//get_basic();
get_basic_specific_no_restriction();    //MRD


echo '<button type=submit class="btn btn-primary form-control" name=action value=view_dbid>Get Report (No login Required)</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
}
?>
