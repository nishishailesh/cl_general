<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
require_once 'verify.php';
	////////User code below/////////////////////
echo '	<link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);
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
	add_new_examination_and_profile($link,$_POST['sample_id'],
											$_POST['list_of_selected_examination'],
											$_POST['list_of_selected_profile'],
											$_POST['list_of_selected_super_profile']);
	edit_sample($link,$_POST['sample_id']);
}
if($_POST['action']=='calculate')
{
	calculate_and_update($link,$_POST['sample_id']);
	edit_sample($link,$_POST['sample_id']);
}

if($_POST['action']=='sync_ALL')
{
	sync_all($link,$_POST['sample_id']);
	edit_sample($link,$_POST['sample_id']);
}

if($_POST['action']=='sync_single')
{
	if(!isset($_POST['is_blob']))
	{
		save_single_result($link,$_POST['sample_id'],$_POST['examination_id'],$_POST['result']);
	}
	else
	{
		save_single_result_blob($link,$_POST['sample_id'],$_POST['examination_id'],$_POST['uniq']);
	}
	edit_sample($link,$_POST['sample_id']);
}

if($_POST['action']=='verify')
{
	verify_sample($link,$_POST['sample_id']);
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

function save_single_result_blob($link,$sample_id,$examination_id,$uniq)
{
	$sql_blob='select * from result_blob where sample_id=\''.$sample_id.'\' and 
							examination_id=\''.$examination_id.'\'';
	//echo ($sql_blob);
	$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
	$ar_blob=get_single_row($result_blob);
	
	$sql_primary_blob='select * from primary_result_blob 
						where 	sample_id=\''.$sample_id.'\' and 
								examination_id=\''.$ar_blob['examination_id'].'\' and
								uniq=\''.$uniq.'\'';							
	//echo $sql_primary_blob;
	$result_primary_blob=run_query($link,$GLOBALS['database'],$sql_primary_blob);
	$arr_blob=get_single_row($result_primary_blob);
	
	if($arr_blob !==NULL && $arr_blob !==FALSE)
	{
		//print_r($arr);
		//echo $ar_blob['sample_id'].'>>'.$ar_blob['examination_id'].'>>'.$ar_blob['fname'].'||||'.
	    //$arr_blob['sample_id'].'>>'.$arr_blob['examination_id'].'>>'.$arr_blob['fname'].'>>'.$arr_blob['uniq'].'<br>';
	
		$update_sql_blob='update result_blob 
							set 
								result=\''.my_safe_string($link,$arr_blob['result']).'\' ,
								fname=\''.my_safe_string($link,$arr_blob['fname']).'\' 
							where
								sample_id=\''.$sample_id.'\' and 
								examination_id=\''.$arr_blob['examination_id'].'\'';
								
								
		//echo $update_sql_blob.'<br>';
		if(!run_query($link,$GLOBALS['database'],$update_sql_blob))
		{echo 'blob data synchronization failed';}
	}	
}
//////////////Functions///////////////////////

?>

