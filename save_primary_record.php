<?php
session_start();
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';
require_once $GLOBALS['main_user_location'];
//echo '<br>Sending POST from server<br><pre>';
//print_r($_SESSION);
print_r($_POST);
echo 'xxxx';
//print_r($_FILES);
//echo '<br>With proper POSTing of data by to-script and proper output by from-script AJAX is complate';
//javascript to encode url and PHP to decode POST value is must


//date india vs mysql. Corusponding change in edit_dc.php

//if($_POST['field']=='from_date' ||$_POST['field']=='to_date' )
//{
//	$_POST['value']=india_to_mysql_date($_POST['value']);
//}

//echo $_POST['session_name'];
/*
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$released_by=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['released_by']);
if(strlen($released_by)==0)
{
	save_result($link);
}
else
{
	echo '<h3>Released samples can not be edited, refresh/view to get previous data</h3>';	
}

function save_result($link)
{
	
	$sql='update result
			set 
				result=\''.my_safe_string($link,$_POST['result']).'\',	
				recording_time=now(),
				recorded_by=\''.$_POST['user'].'\'
			where 
				sample_id=\''.$_POST['sample_id'].'\' 
				and
				examination_id=\''.$_POST['examination_id'].'\'';
	//echo $sql;
	if(!$result=run_query($link,$GLOBALS['database'],$sql))
	{
		echo '<p>Data not updated</p>';
	}
	else
	{
		if(rows_affected($link)>0)
		{
			echo '<p>'.$_POST['sample_id'].'|'.$_POST['examination_id'].'|'.$_POST['result'].'|Saved</p>';				
		}
		else
		{
			echo '<p>nothing to update (no row / same data)</p>';
		}
	}
}*/

?>
