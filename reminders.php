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
//print_r($auth);

////Settings
//$GLOBALS['all_records_limit'] defined in config.php
////Settings

if(in_array('requestonly',$auth))
{
	exit(0);
}

$start=isset($_POST['start'])?$_POST['start']:0;
$limit=50;



	//just skip this if 'show'
	if($_POST['action']=='save')
	{
		foreach($_POST as $k=>$v)
		{
			if(!in_array($k,array('action','session_name','start')))
			{
				$ex=explode('_',$k);
				if($ex[0]=='response')
				{
					update_one_field_with_value($link,'reminders',$ex[0],$ex[1],'\''.$v.'\'');
				}
				elseif($ex[0]=='completed')
				{
					$completed=($v=='')?0:$v;
					if(update_one_field_with_value($link,'reminders',$ex[0],$ex[1],'\''.$completed.'\'')==1)
					{					
						update_one_field_with_value($link,'reminders','recording_time',$ex[1],strftime("%Y%m%d%H%M%S"));
						update_one_field_with_value($link,'reminders','recorded_by',$ex[1],$_SESSION['login']);
					}
				}
				
			}
		}
	}

//show menu after save
main_menu($link);
	
	//all time show fifty
	echo '<h5>Reminders: 50 uncompleted latest reminders are shown first. Use Skip to see older records</h5>';
	$result=run_query($link,$GLOBALS['database'],'select * from reminders  order by completed, datetime desc limit '.$start.' , '.$limit);
	echo '<table class="table table-striped table-sm table-bordered">';
		echo '<tr><th>id</th><th>reminder</th><th>datetime</th><th>response</th><th>completed</th><th>recording time</th><th>recorded by</th></tr>';
	echo '<form method=post>';
	echo 'Skip:<input type=text name=start value=\''.$start.'\'>';
	while($ar=get_single_row($result))
	{
		if($ar['completed']==1){$checked='checked';}else{$checked='';}
		echo '<tr>';
			echo '<td>'.$ar['id'].'</td>';
			echo '<td>'.$ar['reminder'].'</td>';
			echo '<td>'.$ar['datetime'].'</td>';
			echo '<td><input type=text name=response_'.$ar['id'].' value=\''.$ar['response'].'\'></td>';
			echo '<td><input type=checkbox name=chk_'.$ar['id'].' '.$checked.' 
					onchange="set_target(\'completed_'.$ar['id'].'\')">';
			echo '<input type=hidden name=completed_'.$ar['id'].' id=completed_'.$ar['id'].' value=\''.$ar['completed'].'\'></td>';
			echo '<td>'.$ar['recording_time'].'</td>';
			echo '<td>'.$ar['recorded_by'].'</td>';
		echo '</tr>';
	}
	echo '<input type=submit name=action value=save>';
	echo '<input type=submit name=action value=show>';
	echo '	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

	echo '</form>';
	echo '</table>';
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////

function update_one_field_with_value($link,$tname,$fname,$pk,$value)
{
		$sql='update `'.$tname.'`
			set 
				`'.$fname.'` ='.$value.'
			where 
				id=\''.$pk.'\' ';
		//echo $sql;
	
	if(!$result=run_query($link,$GLOBALS['database'],$sql))
	{
		echo '<p>Data not updated</p>';
	}
	else
	{
		if(rows_affected($link)==1)
		{
			return 1;				
		}
		else
		{
			return 0;
		}
	}
}

?>
<script>
function set_target(id)
{
	if(document.getElementById(id).value==0)
	{
		document.getElementById(id).value=1
	}
	else
	{
		document.getElementById(id).value=0
	}
}



</script>
