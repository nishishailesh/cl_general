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

echo '<div class="accordion" id="little_forms"">';
	echo '<button data-toggle="collapse" data-target="#get_name_for_best_to_open" class="btn btn-dark">Get Best to Open</button>';
	echo '<button data-toggle="collapse" data-target="#get_opening_id" class="btn btn-dark">Open Reagent</button>';
	echo '<button data-toggle="collapse" data-target="#get_id_for_details" class="btn btn-dark">Reagent ID Details</button>';
	echo '<button data-toggle="collapse" data-target="#get_name_for_details" class="btn btn-dark">Reagent Name Details</button>';

	
get_opening_id();
if($_POST['action']=='open')
{
	save_opening($link);
}

get_id_for_details();
if($_POST['action']=='id_details')
{
	view_id_details($link,$_POST['id']);
}

get_name_for_details($link);
if($_POST['action']=='name_details')
{
	view_reagent_summary_by_name($link);
}

if($_POST['action']=='near_expiry_data')
{
	near_expiry_data($link);
}

if($_POST['action']=='out_of_stock_data')
{
	out_of_stock_data($link);
}

get_name_for_best_to_open($link);
if($_POST['action']=='get_name_for_best_to_open')
{
	find_best_to_open($link);
}

echo '</div>';


function get_opening_id()
{

				echo '<div id="get_opening_id" class="collapse show" data-parent="#little_forms" >';

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

function get_id_for_details()
{

	echo '<div id="get_id_for_details" class="collapse hide" data-parent="#little_forms" >';		

		echo '<div class="border border-danger m-2 p-2">';
			echo '<h5 class=text-danger>(Details of an ID) Give ID of Reagent/Consumable Received</h5>';
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

/*
Array
(
    [line1] => rew89
    [line2] => rew7
    [range] => line2
    [line3] => rew6
    [line4] => dfg
    [from] => 1
    [to] => 5
    [action] => view_dbid
    [session_name] => sn_1692785306
)
*/

function echo_reagent_lable_print_button($ar)
{		
	echo '<div class="m-2 p-2">';
	echo '<form method=post action=print_4_line_label.php target=_blank>';
	
	echo '<button class="btn btn-outline-success btn-sm" name=action value=print_4_line >Print Lables</button>';
	
	echo '
			<input type=hidden id=line1 name=line1  value=\''.$ar['line1'].'\' class="form-control text-danger"\>
			<input type=hidden id=line2 name=line2  value=\''.$ar['line2'].'\' class="form-control text-danger"\>
			<input type=hidden id=line3 name=line3  value=\''.$ar['line3'].'\' class="form-control text-danger"\>
			<input type=hidden id=line4 name=line4  value=\''.$ar['line4'].'\' class="form-control text-danger"\>
			<input type=hidden  name=from value=\''.$ar['from'].'\'  class="form-control text-danger"\>
			<input type=hidden name=to   value=\''.$ar['to'].'\'    class="form-control text-danger"\>
			<input type=hidden  name=range  value=\''.$ar['range'].'\'    class="form-control text-danger"\>
			<input type=hidden  name=barcode1   value=on    class="form-control text-danger"\>
			';	
	
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '</form>';
	echo '</div>';

}

function view_id_details($link,$id)
{	

		echo '<div class="m-2 p-2">';
			echo '<h5 class=text-danger>Details of Reagent/Consumable ID:'.$id.'</h5>';
			$vsql='select * from reagent where id=\''.$id.'\'';
			view_sql_result_as_table($link,$vsql,$show_hide='no');
			$result=run_query($link,$GLOBALS['database'],$vsql);
			$ar=get_single_row($result);
			//print_r($ar);
			
			/* 
			 * Array ( [id] => 30 
			 * [name] => ALT_UV 
			 * [lot] => B121952 
			 * [size] => 330 [unit] => ml 
			 * [count] => 13 
			 * [date_of_preparation] => 2019-12-01 
			 * [date_of_expiry] => 2021-08-01 
			 * [prepared_by] => erba 
			 * [date_of_receipt] => 2020-01-01 
			 * [condition_on_receipt] => ok 
			 * [remark] => brought foreward 
			 * [recording_time] => 2020-08-18 10:59:18 
			 * [recorded_by] => 3 )*/
			  
			$arl=array	
				(
					'line1'=> $ar['id'],
					'barcode1'=>'on',
					'range'=>'line1',	//NOT USED
					'line2' => '',
					'line3' => $ar['name'].' '.$ar['lot'].' '.$ar['date_of_expiry'],
					'line4' => $ar['size'].'x'.$ar['count'].' '.$ar['prepared_by'],
					'from' => 1,
					'to' => $ar['count']
				);
    
			echo_reagent_lable_print_button($arl);
		echo '</div>';
		echo '<div class="m-2 p-2">';
		
			$usql='select * FROM reagent_use where reagent_id=\''.$id.'\'';
			view_sql_result_as_table($link,$usql,$show_hide='no');
			echo '<h3 class=text-danger>For ID:'.$id.' Unopened Reagent count is: <span class="bg-warning">'.get_unopened_count($link,$id).'</span></h3>';
		echo '</div>';
}


function get_name_for_details($link)
{

	echo '<div id="get_name_for_details" class="collapse hide" data-parent="#little_forms" >';		

		echo '<div class="border border-danger m-2 p-2">';
			echo '<h5 class=text-danger>(Get Details of a Reagent) Choose Name of Reagent/Consumable</h5>';
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

function get_name_for_best_to_open($link)
{
	echo '<div id="get_name_for_best_to_open" class="collapse hide" data-parent="#little_forms" >';		

		echo '<div class="border border-danger m-2 p-2">';
			echo '<h5 class=text-danger>(Get best to open container) Choose Name of Reagent/Consumable</h5>';
			echo '<table class="table table-striped table-sm table-bordered">';
				echo '<tr><th>id</th></tr>';
			echo '<form method=post>';
				echo '<tr>';
					$sql='select reagent_name from reagent_name';
					echo '<td>';
						mk_select_from_sql($link,$sql,'reagent_name','reagent_name','reagent_name','','',$blank='yes');
					echo '</td>';
				echo '</tr>';
			echo '<tr><td><button class="btn btn-sm btn-info" type=submit name=action value=get_name_for_best_to_open>Find Best to Open</button></td></tr>';
			echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

			echo '</form>';
			echo '</table>';
		echo '</div>';
	
	echo '</div>';
	
}	

function get_best_container($link,$reagent_name)
{
	$all_sql='select * from reagent where name=\''.$_POST['reagent_name'].'\' order by date_of_expiry';
	$all_result=run_query($link,$GLOBALS['database'],$all_sql);
	$got_it='no';
	while($all_ar=get_single_row($all_result))
	{
		$c=get_unopened_count($link,$all_ar['id']);	
		$e=count_expiry_period_in_days($link,$all_ar['id']);
		if($c>0 && $got_it=='no'){$got_it='yes';}	
		if($got_it == 'yes')
		{
			$got_it='dead';
			$max=$all_ar['count'];
			//now find correct sequence
			for($i=1;$i<=$max;$i++)
			{
				$usql='select * FROM reagent_use where reagent_id=\''.$all_ar['id'].'\' and count=\''.$i.'\'';
				$container_result=run_query($link,$GLOBALS['database'],$usql);
				if(get_row_count($container_result)==0)
				{
					return array($all_ar['id'],$i);
				}
			}
			
		}
		else
		{
			//do nothing, go next in llop
		}
	}
	return false;
}

function find_best_to_open($link)
{
	$best=get_best_container($link,$_POST['reagent_name']);
	//print_r($best);
	echo '<h3 class="text-success border border-danger rounded">It is best to open '. $_POST['reagent_name'].' ID:<span class="badge bg-warning">'.$best[0].'</span> Container count:<span class="badge  bg-warning">'.$best[1].' </span></h3>';
	view_id_details($link,$best[0]);
	view_reagent_summary_by_name($link);
	
}



function view_reagent_summary_by_name($link)
{	
	
		echo '<div class="m-2 p-2">';
		echo '<h5 class=text-danger>Details of Reagent</h5>';

			$all_sql='select * from reagent where name=\''.$_POST['reagent_name'].'\' order by id desc';
			$all_result=run_query($link,$GLOBALS['database'],$all_sql);
			echo '<table class="table table-striped table-sm table-bordered">';
			echo '<tr>
					<th>Reagent Name</th>
					<th>Lot</th>
					<th>Receipt ID</th>
					<th>un-Opened Units</th>
					<th>Expiry date</th>
					<th>Expiry in days</th>
				</tr>';
			while($all_ar=get_single_row($all_result))
			{
				$c=get_unopened_count($link,$all_ar['id']);
				$e=count_expiry_period_in_days($link,$all_ar['id']);
				echo '<tr><td>'.$all_ar['name'].'</td><td>'.$all_ar['lot'].'</td><td>'.$all_ar['id'].'</td><td>'.$c.'</td><td>'.$all_ar['date_of_expiry'].'</td><td>'.$e.'</td></tr>';
			}
			$sr=get_stock_and_reorder($link,$_POST['reagent_name']);
			if($sr[0]<=$sr[1])
			{
				$decision='<span class=bg-danger>YES</span>';
			}
			else
			{
				$decision='<span class=bg-success>NO</span>';
			}
			echo '<tr class="bg-warning">	<th>Total Stock</th>	<th>'.$sr[0].'</th>
						<th>Reorder Value</th>	<th>'.$sr[1].'</th>
						<th>Reorder?</th>		<th>'.$decision.'</th></tr>';
			echo '</table>';
		echo '</div>';
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
	echo '<h5 class=text-info>Near Expiry Data</h5>';
	$sql='select * from reagent order by id desc';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<table class="table table-striped table-sm table-bordered">';
	echo '<tr><th>Reagent Name</th><th>Receipt ID</th><th>un-Opened Units</th><th>Expiry date</th><th>Expiry in days</th></tr>';

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

function get_stock($link,$reagent_name)
{
	$sql='select * from reagent where name=\''.$reagent_name.'\' order by id desc';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$balance=0;
	while($ar=get_single_row($result))
	{
		$c=get_unopened_count($link,$ar['id']);
		$balance=$balance+$c*$ar['size'];
	}
	return $balance;
}

function get_reorder_value($link,$reagent_name)
{
	$sql='select * from reagent_name where reagent_name=\''.$reagent_name.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	return $ar['reorder_value'];		
}
function get_stock_and_reorder($link,$reagent_name)
{
		$stock=get_stock($link,$reagent_name);
		$reorder=get_reorder_value($link,$reagent_name);
		return array($stock,$reorder);
}

function out_of_stock_data($link)
{
	echo '<h5 class=text-info>Out of Stock Data (Reorder trigger). to be Released Soon!!</h5>';
	$sql='select * from reagent_name where reorder_value is not null order by reagent_name';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<table class="table table-striped table-sm table-bordered">';
	echo '<tr><th>Reagent Name</th><th>Reorder Value</th><th>Stock</th><th>Reorder?</th></tr>';

	while($ar=get_single_row($result))
	{	
		$stock=get_stock($link,$ar['reagent_name']);
		if($stock<=$ar['reorder_value'])
		{
			$decision='<span class=bg-danger>YES</span>';
		}
		else
		{
			$decision='<span class=bg-success>NO</span>';
		}			
		echo '<tr><td>'.$ar['reagent_name'].'</td><td>'.$ar['reorder_value'].'</td><td>'.$stock.'</td><td>'.$decision.'</td></tr>';
	}
	echo '</table>';

}
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
?>
