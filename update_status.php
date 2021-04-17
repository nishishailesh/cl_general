<?php
require_once 'base/verify_login.php';
////////User code below/////////////////////
require_once 'project_common.php';
echo '<div id=monitor class="jumbotron m-0 p-0">';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	//echo '<div>';
main_menu($link); 

//$lot_size=200;
$lot_size=100;

echo '
<style>

.two_column 
{
  display: grid;
  grid-template-columns: auto auto;
}

.ten_column 
{
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto auto auto auto;
  grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
  justify-items: start;
  gap: 0px 0px;
  margin: 3px;
  border: 3px solid red;
}
</style>

';

if(isset($_POST['status_action']))
{
	update_all_sample_status($link,$_POST['status_action'],$_POST);
}
$one='select max(sample_id) as max_id from result where sample_id between 1000000 and 1999999';
$result=run_query($link,$GLOBALS['database'],$one);
if($result)
{
	$ar=get_single_row($result);
}

$div=$ar['max_id']%10;		//1149290 -> 0
if($div!=0)
{
	$offset=10-$div;			//10 - 0 -> 10 
}
else
{
	$offset=0;
}

$start_id=$ar['max_id']+$offset - 2*$lot_size;	//100566 -> 100566 +4 -200 =100560 - 200 = 100360 
$rounded_start_id=$start_id+1;		//100361


echo '<form method=post>';
	echo_sample_action_button();

	echo '<div class="two_column">';
		echo '<div class="ten_column">';
			for ($i=$rounded_start_id;$i<$rounded_start_id+$lot_size;$i++)
			{
				echo '<div class="btn-group-vertical m-0 p-0">';
				show_sid_button_for_status_change($link,$i);
				echo '</div>';
			}			
		
		echo '</div>';

		echo '<div class="ten_column">';
			for ($i=$rounded_start_id+$lot_size;$i<=$ar['max_id'];$i++)
			{
				echo '<div class="btn-group-vertical m-0 p-0">';
				show_sid_button_for_status_change($link,$i);
				echo '</div>';
			}							
		echo '</div>';
	echo '</div>';
	

	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';			
echo '</form>';

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////


function show_sid_button_for_status_change($link,$sid)
{
	$final_state=0;
	foreach ($GLOBALS['sample_status'] as $status_index=>$status_array )
	{
		$temp_state=0;
		foreach($status_array[1] as $key=>$ex_id)
		{
			$len=strlen(get_one_ex_result($link,$sid,$ex_id));
			if($len>0)
			{
				$temp_state=$temp_state+1;
			}
			if($temp_state==count($status_array[1]))
			{
				$final_state=$status_index;
			}
		}
	}

	$label=$sid.'<br>'.colorize_eq_str(get_equipment_str($link,$sid));
	
	echo '
	<div class="d-inline-block border border-success" style="background-color:'.$GLOBALS['sample_status'][$final_state][2].'">
		<input  type="checkbox" name=\''.$sid.'\' id='.$sid.'>
		<label   for='.$sid.'>'.$label.'</label>
	</div>';
}

function echo_sample_action_button()
{
	echo '<div class="d-inline-block" >';
	foreach($GLOBALS['sample_status'] as $index=>$status_details)
	{
		if($status_details[4]=='show')
		{
			echo '<button 
					type=submit 
					class="btn btn-outline-dark btn-sm " 
					style="background-color:'.$status_details[2].'" 
					name=status_action
					value=\''.$status_details[0].'\' >'.$status_details[0].'</button>';
		}
	}

	echo '</div>';	
}

function update_all_sample_status($link,$action,$post)
{
		foreach($post as $k=>$v)
		{
			if(is_int($k))
			{
				update_sample_status($link,$k,$action);
			}
		}
}
?>
