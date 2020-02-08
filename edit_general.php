<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '	<link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu();
echo '<div id=response></div>';
if($_POST['action']=='edit_general')
{
	edit_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='upload')
{
	save_result_blob($link,$_POST['sample_id']);
	edit_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='delete')
{
	delete_examination($link,$_POST['sample_id'],$_POST['examination_id']);
	edit_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='insert')
{
	add_new_examination_and_profile($link,$_POST['sample_id'],$_POST['list_of_selected_examination'],$_POST['list_of_selected_profile']);
	edit_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='calculate')
{
	calculate_and_update($link,$_POST['sample_id']);
	edit_sample($link,$_POST['sample_id']);
}
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
function calculate_and_update($link,$sample_id)
{
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	//echo $sql.'<br>';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	while($ar=get_single_row($result))
	{
		$examination_details=get_one_examination_details($link,$ar['examination_id']);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		if(!$edit_specification){$edit_specification=array();}
		
		$decimal=isset($edit_specification['decimal'])?$edit_specification['decimal']:0;
		$calculate=isset($edit_specification['calculate'])?$edit_specification['calculate']:'';	
		$ex_list=isset($edit_specification['ex_list'])?$edit_specification['ex_list']:'';	

		if(strlen($calculate)>0)
		{		
			//echo 'ex='.$ar['examination_id'].'<br>';
			$ex_result=calculate_result($link,$calculate,$ex_list,$sample_id,$decimal);
			//echo $ex_result;
			save_single_result($link,$sample_id,$ar['examination_id'],$ex_result);
		}
	}
}

function save_single_result($link,$sample_id,$examination_id,$ex_result)
{
	
	$sql='update result
			set 
				result=\''.my_safe_string($link,$ex_result).'\',	
				recording_time=now(),
				recorded_by=\''.$_SESSION['login'].'\'
			where 
				sample_id=\''.$sample_id.'\' 
				and
				examination_id=\''.$examination_id.'\'';
	//echo $sql;
	if(!$result=run_query($link,$GLOBALS['database'],$sql))
	{
		echo '<p>Data not updated</p>';
	}
	else
	{
		//echo '<p>'.$sample_id.'|'.$examination_id.'|'.$ex_result.'|Saved</p>';				
	}
}
//////////////Functions///////////////////////

?>

