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

$near_expiry="90";

if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link);
	
	//only required if all tables need to be edited
	//if($post['action']=='get_record_list')
	//{
	//		list_available_tables($link);
	//}
echo '<div class="border border-info bg-light border-2px m-1 p-1">';
show_manage_single_table_button('reagent','Reagents received');	
show_manage_single_table_button('reagent_use','Reagents Opened');
echo '<form method=post class="form-group m-0 p-0">	
		<input type=hidden name=session_name value=\''.session_name().'\'>
		<button class="btn btn-outline-primary m-0 p-0" 
			type=submit name=action value=near_expiry_data>Near Expiry Data</button>
		<button class="btn btn-outline-primary m-0 p-0" 
			type=submit name=action value=out_of_stock_data>Near out-of-stock Data</button>
			
		</form>';		
	
echo '</div>';

manage_stf($link,$_POST);

	echo '<button data-toggle="collapse" data-target="#get_opening_id" class="btn btn-dark">Open Reagent</button>';
	echo '<button data-toggle="collapse" data-target="#get_id_for_details" class="btn btn-dark">Reagent ID Details</button>';
	echo '<button data-toggle="collapse" data-target="#get_name_for_details" class="btn btn-dark">Reagent Name Details</button>';

	
get_opening_id();
save_opening($link);
get_id_for_details();
view_id_details($link);
get_name_for_details($link);
view_reagent_summary_by_name($link);
near_expiry_data($link);
out_of_stock_data($link);

function get_opening_id()
{

				echo '<div id="get_opening_id" class="collapse show">';

		$default=strftime("%Y-%m-%d");
		echo '<div class="border border-success m-2 p-2" >';
		echo '<h5 class="text-success">Open Reagent/Consumable</h5>';
		echo '<table class="table table-striped table-sm table-bordered">';
			echo '<tr><th>id^count</th><th>date_of_opening</th></tr>';
		echo '<form method=post>';
			echo '<tr>';
				echo '<td><input type=text name=id autofocus></td>';
				echo '<td><input type=date name=date_of_opening value=\''.$default.'\'>';			
			echo '</tr>';
		echo '<tr><td colspan=2><input class="btn btn-sm btn-info"  type=submit name=action value=open></td></tr>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

		echo '</form>';
		echo '</table>';
		echo '</div>';
	echo '</div>';
}	

function get_unopened_count($link,$id)
{
	$rsql='select `count` as total from reagent where id=\''.$id.'\'';
	$rresult=run_query($link,$GLOBALS['database'],$rsql);
	$rar=get_single_row($rresult);	
	$usql='select count(id) as used FROM reagent_use where reagent_id=\''.$id.'\'';
	$uresult=run_query($link,$GLOBALS['database'],$usql);
	$uar=get_single_row($uresult);
	//print_r($rar);
	//print_r($uar);
	//echo ($rar['total']-$uar['used']);
	return ($rar['total']-$uar['used']);
}
	
function save_opening($link)
{
	if($_POST['action']=='open')
	{
		if(strlen($_POST['date_of_opening'])==0){echo 'Date of Opening can not be empty';}
		else
		{
			$ex=explode('^',$_POST['id']);
			$unopened=get_unopened_count($link,$ex[0]);
			if($unopened <= 0)
			{
				echo '<h3 class=text-danger>Failure!!! Unopened Reagent count for id='.$ex[0].' is: <span class="bg-warning">'.$unopened.'</span></h3>';
				echo '<h5 class=text-success>Details of Reagent/Consumable ID:'.$ex[0].'</h5>';
			
				$vsql='select * from reagent where id=\''.$ex[0].'\'';
				view_sql_result_as_table($link,$vsql,$show_hide='no');
			
				$usql='select * FROM reagent_use where reagent_id=\''.$ex[0].'\'';
				view_sql_result_as_table($link,$usql,$show_hide='no');
				return;
			}

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
				echo '<h5 class=text-success>Opened. Details of Reagent/Consumable ID:'.$ex[0].'</h5>';
			
				$vsql='select * from reagent where id=\''.$ex[0].'\'';
				view_sql_result_as_table($link,$vsql,$show_hide='no');
			
				$usql='select * FROM reagent_use where reagent_id=\''.$ex[0].'\'';
				view_sql_result_as_table($link,$usql,$show_hide='no');
			}
		}
	}	
}

function get_id_for_details()
{

	echo '<div id="get_id_for_details" class="collapse hide">';		

		echo '<div class="border border-danger m-2 p-2">';
			echo '<h5 class=text-danger>Details of Reagent/Consumable Received</h5>';
			echo '<table class="table table-striped table-sm table-bordered">';
				echo '<tr><th>id</th></tr>';
			echo '<form method=post>';
				echo '<tr>';
					echo '<td><input type=text name=id ></td>';
				echo '</tr>';
			echo '<tr><td><button class="btn btn-sm btn-info" type=submit name=action value=id_details>Get Details</button></td></tr>';
			echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

			echo '</form>';
			echo '</table>';
		echo '</div>';
	
	echo '</div>';
	
}	

function view_id_details($link)
{	
	if($_POST['action']=='id_details')
	{
		echo '<div class="m-2 p-2">';
			echo '<h5 class=text-danger>Details of Reagent/Consumable ID:'.$_POST['id'].'</h5>';
			$vsql='select * from reagent where id=\''.$_POST['id'].'\'';
			view_sql_result_as_table($link,$vsql,$show_hide='no');

		echo '</div>';
		echo '<div class="m-2 p-2">';
		
			$usql='select * FROM reagent_use where reagent_id=\''.$_POST['id'].'\'';
			view_sql_result_as_table($link,$usql,$show_hide='no');
			echo '<h3 class=text-danger>For ID:'.$_POST['id'].' Unopened Reagent count is: <span class="bg-warning">'.get_unopened_count($link,$_POST['id']).'</span></h3>';
		echo '</div>';
	}
}


function get_name_for_details($link)
{

	echo '<div id="get_name_for_details" class="collapse hide">';		

		echo '<div class="border border-danger m-2 p-2">';
			echo '<h5 class=text-danger>Details of Reagent/Consumable Received</h5>';
			echo '<table class="table table-striped table-sm table-bordered">';
				echo '<tr><th>id</th></tr>';
			echo '<form method=post>';
				echo '<tr>';
					$sql='select reagent_name from reagent_name';
					echo '<td>';
						mk_select_from_sql($link,$sql,'reagent_name','reagent_name','reagent_name','','',$blank='yes');
					echo '</td>';
				echo '</tr>';
			echo '<tr><td><button class="btn btn-sm btn-info" type=submit name=action value=name_details>Get Details</button></td></tr>';
			echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

			echo '</form>';
			echo '</table>';
		echo '</div>';
	
	echo '</div>';
	
}	


function view_reagent_summary_by_name($link)
{	
	if($_POST['action']=='name_details')
	{	
		echo '<div class="m-2 p-2">';
		echo '<h5 class=text-danger>Details of Reagent</h5>';

			$all_sql='select * from reagent where name=\''.$_POST['reagent_name'].'\' order by id desc';
			$all_result=run_query($link,$GLOBALS['database'],$all_sql);
			echo '<table class="table table-striped table-sm table-bordered">';
			echo '<tr><th>Reagent Name</th><th>Receipt ID</th><th>Open Units</th><th>Expiry date</th><th>Expiry in days</th></tr>';
			while($all_ar=get_single_row($all_result))
			{
				$c=get_unopened_count($link,$all_ar['id']);
				$e=count_expiry_period_in_days($link,$all_ar['id']);
				echo '<tr><td>'.$all_ar['name'].'</td><td>'.$all_ar['id'].'</td><td>'.$c.'</td><td>'.$all_ar['date_of_expiry'].'</td><td>'.$e.'</td></tr>';
			}
			echo '</table>';
		echo '</div>';
	}
}

function count_expiry_period_in_days($link,$id)
{
	$sql='select date_of_expiry from reagent where id=\''.$id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	//echo 'expiry:'.$ar['date_of_expiry'].' today:'.date("Y-m-d").'<br>';
	$diff=strtotime($ar['date_of_expiry'])-strtotime(date("Y-m-d"));
	//echo 'seconds:'.$diff.'<br>';
	//echo 'days:'.($diff/(60*60*24)).'<br>';
	return $diff/(60*60*24);
}	

function near_expiry_data($link)
{
	if($_POST['action']!='near_expiry_data'){return;}
	echo '<h5 class=text-info>Near Expiry Data</h5>';
	$sql='select * from reagent order by id desc';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<table class="table table-striped table-sm table-bordered">';
	echo '<tr><th>Reagent Name</th><th>Receipt ID</th><th>Open Units</th><th>Expiry date</th><th>Expiry in days</th></tr>';

	while($ar=get_single_row($result))
	{
		$e=count_expiry_period_in_days($link,$ar['id']);
		$c=get_unopened_count($link,$ar['id']);
		
		if($e<=90)
		{
			echo '<tr><td>'.$ar['name'].'</td><td>'.$ar['id'].'</td><td>'.$c.'</td><td>'.$ar['date_of_expiry'].'</td><td>'.$e.'</td></tr>';
		}	
	}
	echo '</table>';

}
function out_of_stock_data($link)
{
	if($_POST['action']!='out_of_stock_data'){return;}
	echo '<h5 class=text-info>Out of Stock Data (Reorder trigger). to be Released Soon!!</h5>';
}
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
?>
