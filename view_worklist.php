<?php
//$GLOBALS['nojunk']='';
//echo '<pre>';print_r($_POST);echo '</pre>';
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

if($_POST['action']=='get_sid_eid_for_worklist')
{
	get_sid_eid($link);
}
else if($_POST['action']=='get_worklist')
{
	$ex_requested=explode(',',$_POST['list_of_selected_examination']);
	show_worklist($link,$_POST['from'],$_POST['to'],$ex_requested);
}
else
{
	
	
}
//elseif($_POST['action']=='view_dbid')
//{
	////echo_class_button($link,'Haemogram');
	//view_sample($link,$_POST['sample_id']);
//}

//////////////user code ends////////////////
tail();


//////////////Functions///////////////////////

function get_sid_eid($link)
{
echo '<form method=post>';
echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="from">From Sample ID</label>
			<input type=text size=13 id=from name=from class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
	echo '	<label class="my_label text-danger" for="to">To Sample ID</label>
			<input type=text size=13 id=from name=to class="form-control text-danger" required="required" \>
			<p class="help"><span class=text-danger>Must be</span> number</p>';
	get_examination_data($link);			
echo '</div>';
echo '<button type=submit class="btn btn-primary form-control" name=action value=get_worklist>Get Worklist</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';

echo '</form>';
}

function show_worklist($link,$from_sid,$to_sid,$ex_id_array)
{
	foreach($ex_id_array as $ex_id)
	{
		show_worklist_one_ex($link,$from_sid,$to_sid,$ex_id);
	}
}


function show_worklist_one_ex($link,$from_sid,$to_sid,$ex_id)
{
	$sql='select * from result where sample_id between \''.$from_sid.'\' and \''.$to_sid.'\' and examination_id=\''.$ex_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	echo '<table class="table table-striped align-top table-sm">';
	while($ar=get_single_row($result))
	{
		echo '<tr><td >';
		echo $ar['sample_id'];
		echo '</td><td>';
		edit_field($link,$ar['examination_id'],array($ar['examination_id']=>$ar['result']),$ar['sample_id'],'',$frill=False);
		echo '</td></tr>';
		
		//print_r($ar);
	}
	echo '</table>';
}
?>
