<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);

if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link);
	
$default=strftime("%Y-%m-%d");
echo '<h5>Open Reagent/Consumable</h5>';
echo '<table class="table table-striped table-sm table-bordered">';
	echo '<tr><th>id^count</th><th>date_of_opening</th></tr>';
echo '<form method=post>';
	echo '<tr>';
		echo '<td><input type=text name=id autofocus></td>';
		echo '<td><input type=date name=date_of_opening value=\''.$default.'\'>';			
	echo '</tr>';
echo '<tr><td colspan=2><input type=submit name=action value=open></td></tr>';
echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

echo '</form>';
echo '</table>';
	
	

if($_POST['action']=='open')
{
	if(strlen($_POST['date_of_opening'])==0){echo 'Date of Opening can not be empty';}
	else
	{
		$ex=explode('^',$_POST['id']);
		$sql='insert into reagent_use (reagent_id,count,date_of_opening,recording_time,recorded_by) 
				values(	\''.$ex[0].'\', 
						\''.$ex[1].'\', 
						\''.$_POST['date_of_opening'].'\',
						now(),
						\''.$_SESSION['login'].'\'	
						)
				on duplicate key update 
					date_of_opening=\''.$_POST['date_of_opening'].'\',
					recording_time=now(),
					recorded_by=\''.$_SESSION['login'].'\'
				';
				
		if(!$result=run_query($link,$GLOBALS['database'],$sql))
		{
			echo '<p>Data not updated</p>';
		}	
		else
		{
			$vsql='select * from reagent where id=\''.$ex[0].'\'';
			view_sql_result_as_table($link,$vsql,$show_hide='no');
		
			$usql='select * FROM reagent_use where reagent_id=\''.$ex[0].'\'';
			view_sql_result_as_table($link,$usql,$show_hide='no');
		}
	}
}	
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
?>
