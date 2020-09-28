<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
require_once 'single_table_edit_common.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
//print_r($auth);



if(in_array('requestonly',$auth))
{
	exit(0);
}

$tname='refrigerator_temperature';
main_menu($link);

echo_write_temp_button();

$ref=get_refrigerator($link);

	$record_type_sql='select equipment_record_type from equipment_record_type 
				where id=\''.$GLOBALS['ongoing_acceptibility_record_type_id'].'\'';
	$record_type_result=run_query($link,$GLOBALS['database'],$record_type_sql);
	$record_type_ar=get_single_row($record_type_result);
	$record_type=$record_type_ar['equipment_record_type'];
	

/*
id	int(11) Auto Increment	
name	varchar(100) NULL	
date	int(11) NULL	
time	int(11) NULL	
temp	decimal(10,2) NULL	
remark	varchar(100) NULL	
recorded_by	varchar(50) NULL	
recording_time	datetime NULL	

*/

if($_POST['action']=='write_temp')
{
	$record_ids=array();
	
	foreach ($ref as $value)
	{
		$id=add_without_display($link,$tname);
		
		update_one_field_with_value($link,$tname,'name',$id,'\''.$value.'\'');
		update_one_field_with_value($link,$tname,'date',$id,'\''.strftime("%Y-%m-%d").'\'');
		update_one_field_with_value($link,$tname,'time',$id,'\''.strftime("%H:%M:%S").'\'');
		$record_ids[]=$id;
	}

	multiedit($link,$tname,$record_ids,'yes');

}

if($_POST['action']=='save')
{
	//[id_111] => 111
    //[name_111] => 11_REFRIGERATOR_HE_78_SAMSUNG
    //[date_111] => 2020-09-28
    //[time_111] => 23:28:43
    //[temp_111] => 13
    //[remark_111] => 

	/*
	id	int(11) Auto Increment	
	name	varchar(100) NULL	
	date	int(11) NULL	
	time	int(11) NULL	
	temp	decimal(10,2) NULL	
	remark	varchar(100) NULL	
	recorded_by	varchar(50) NULL	
	recording_time	datetime NULL	
	*/
    
	foreach ($_POST as $data=>$value)
	{
		$ex=explode('_',$data);
		//print_r($ex);
		if(count($ex)==2  && $ex[0]=='id')
		{
			$sql='update `'.$tname.'`
					set
						name=\''.$_POST['name_'.$ex[1]].'\' ,
						date=\''.$_POST['date_'.$ex[1]].'\' ,
						time=\''.$_POST['time_'.$ex[1]].'\' ,
						temp=\''.$_POST['temp_'.$ex[1]].'\' ,
						remark=\''.$_POST['remark_'.$ex[1]].'\' ,
						recording_time=now(),
						recorded_by=\''.$_SESSION['login'].'\'
					where
						id=\''.$ex[1].'\'';
			//echo $sql;
			run_query($link,$GLOBALS['database'],$sql);
		}
	}
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////

//list freeze, refrigerator

function echo_write_temp_button()
{
	echo '<div class="d-inline-block" >
	<form method=post class=print_hide>
	<button class="btn btn-outline-primary btn-sm" name=action value=write_temp >Write Temperature</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	</form></div>';
}


function get_refrigerator($link)
{
	$sql='select * from equipment where ( equipment  like \'%freez%\' or equipment like \'%refri%\' ) and ( equipment not like \'%not in use%\' ) ';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ret=array();
	while($ar=get_single_row($result))
	{
		$ret[]=$ar['equipment'];
	}
	return $ret;
}




?>
