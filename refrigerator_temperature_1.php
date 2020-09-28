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


main_menu($link);
echo_write_temp_button();

$ref=get_refrigerator($link);

	$record_type_sql='select equipment_record_type from equipment_record_type 
				where id=\''.$GLOBALS['ongoing_acceptibility_record_type_id'].'\'';
	$record_type_result=run_query($link,$GLOBALS['database'],$record_type_sql);
	$record_type_ar=get_single_row($record_type_result);
	$record_type=$record_type_ar['equipment_record_type'];
	
if($_POST['action']=='write_temp')
{

	//print_r($ref);
	$record_ids=array();
	
	/*foreach ($ref as $value)
	{
		$sql='insert into equipment_record
				(date,equipment,equipment_record_type, description)
				values
				(now(),\''.$value.'\', \''.$record_type.'\', \''.strftime("%Y-%m-%d %H:%M:%S").'(degree C)\')';			
		//echo $sql;
		run_query($link,$GLOBALS['database'],$sql);
		$record_ids[]=last_autoincrement_insert($link);
	}
 	print_r($record_ids);

	*/
	echo '<div class="d-block p-2 m-2 border border-success" >';
	echo '<table class="table table-striped table-bordered"><form method=post class=print_hide>';
	echo '<tr><th>Refrigerator</th><th>Date Time</th><th>Temperature (in centigrade)</th></tr>';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	
	$counter=1;
	foreach ($ref as $value)
	{
		echo '<tr>
			<input type=hidden name=id value=\''.$counter.'__'.$value.'\'>
			<td><input class="w-100" type=text readonly name='.$counter.'__equipment value=\''.$value.'\'></td>
			<td><input class="w-100" type=text name='.$counter.'__description value=\''.strftime("%Y-%m-%d %H:%M:%S").'\'></td>
			<td><input type=number name='.$counter.'__temperature step=0.1></td></tr>';
			$counter++;
	}
	echo '<tr><td><button class="btn btn-outline-primary btn-sm" name=action value=save >Save</button></td></tr>';
	echo '</form></table>';
	echo '</div>';
}


if($_POST['action']=='save')
{
	//[1__equipment] => 11_REFRIGERATOR_HE_78_SAMSUNG
    //[1__description] => 2020-09-15 00:48:53
    //[1__temperature] => 2
    
	foreach ($_POST as $data=>$value)
	{
		$ex=explode('__',$data);
		//print_r($ex);
		if(count($ex)==2  && $ex[1]=='equipment')
		{
			$at=$_POST[$ex[0].'__description'];
			$temp=$_POST[$ex[0].'__temperature'];
			$final_entry=$temp.' C -->'.$at;
			$sql='insert into equipment_record
				(date,equipment,equipment_record_type, description)
				values
				(now(),\''.$value.'\', \''.$record_type.'\', \''.$final_entry.'\')';			
			//echo $sql;
			run_query($link,$GLOBALS['database'],$sql);
		}
	}
}


foreach($ref as $value)
{
	$sql='select id from equipment_record where equipment=\''.$value.'\' order by id desc';
	
	//echo $sql;
	
	$result=run_query($link,$GLOBALS['database'],$sql);
	$all_fields=array();
	$header='yes';
	echo '<table class="table table-striped table-sm table-bordered">';
	while($ar=get_single_row($result))
	{	
		view_row($link,'equipment_record',$ar['id'],$header);
		$header='no';
	}		
	echo '</table>';
}


//add($link,'equipment_record');

//////////////user code ends////////////////
tail();

echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

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
