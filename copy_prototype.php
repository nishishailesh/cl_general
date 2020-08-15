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
echo '<div id=response></div>';

if($_POST['action']=='copy_prototype')
{
	get_dbid_and_prototype_id($link);
}
else if($_POST['action']=='paste_prototype')
{
	paste_prototype($link,$_POST['sample_id'],$_POST['prototype_id']);
	edit_sample($link,$_POST['sample_id']);
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

function get_dbid_and_prototype_id($link)
{
	echo '<form method=post>';
	echo '<div class="basic_form">';
		echo '	<label class="my_label text-danger" for="mrd">Database ID</label>
				<input type=number size=13 id=mrd name=sample_id class="form-control text-danger" required="required" \>
				<p class="help"><span class=text-danger>Must be</span> number</p>';
	echo '</div>';
	echo '<div class="basic_form">';
		echo '	<label class="my_label text-danger" for="mrd">Prototype ID</label>';
			$sql='select * from prototype';
			mk_select_from_sql_kv($link,$sql,'prototype_id','name','prototype_id',$disabled='',$default='');
		echo '<p class="help"><span class=text-danger>Must be</span> number</p>';
	echo '</div>';
	echo '<button type=submit class="btn btn-primary form-control" name=action value=paste_prototype>Copy</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
}

function paste_prototype($link,$sample_id,$prototype_id)
{
	//select * from result,prototype_data where result.sample_id=4000002 and result.examination_id=prototype_data.examination_id
	//update result,prototype_data set result.result=prototype_data.result where result.sample_id=4000002 and result.examination_id=prototype_data.examination_id
	$sql='update result,prototype_data 
			set result.result=prototype_data.result 
			where 
				result.sample_id=\''.$sample_id.'\'
				and 
				prototype_data.prototype_id=\''.$prototype_id.'\' 
				and 
				result.examination_id=prototype_data.examination_id';
	$result=run_query($link,$GLOBALS['database'],$sql);
	if(!$result)
	{
		echo '<h4>Something failed. prototype '.get_prototype_name($prototype_id).' not copied in to sample_id '.$sample_id.'</h4>';
	}
}

?>
