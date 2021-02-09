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
main_menu($link);
echo '<h3>Print Reports between two sample_id and Specific Location</h3>';

if($_POST['action']=='get_from_to')
{
	get_dbid($link);
}


//elseif($_POST['action']=='view_dbid')
//{
	////echo_class_button($link,'Haemogram');
	//view_sample($link,$_POST['sample_id']);
//}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function get_dbid($link)
{

echo '<form method=post action=print_from_to_opd_nabl.php target=_blank>';
echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="from">From Sample ID</label>
			<input type=number size=13 id=from name=from class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
	echo '	<label class="my_label text-danger" for="to">To Sample ID</label>
			<input type=number size=13 id=from name=to class="form-control text-danger"\>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
echo '</div>';
get_one_field_for_insert($link,1006);	//OPD/Ward

echo '<button type=submit class="btn btn-primary form-control" name=action value=view_dbid>Print</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
echo 	'<ul>
			<li>If only <b>From</b> is provided -> Single Sample will be shown</li>
			<li>If only <b>From</b> and <b>To</b> is provided -> Range of Sample will be shown</li>
			<li>If <b>From</b> and <b>To</b> and <b>OPD/Ward</b> is provided -> Location-Filtered Range of Sample will be shown</li>
		</ul>';
}

?>
