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
	
echo '</form>';

//////////////user code ends////////////////
tail();

echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////


function show_sid_button_for_status_change($link,$sid)
{
	$final_state=1;
	foreach ($GLOBALS['dates_times'] as $each_ex=>$state )
	{
		$len=strlen(get_one_ex_result($link,$sid,$each_ex));
		if($len>0)
		{
			$final_state=$state;
		}
	}

	$label=$sid.'<br>'.colorize_eq_str(get_equipment_str($link,$sid));


	echo '
	<div class="d-inline-block border border-success" >
	<div style="background-color:'.$GLOBALS['state_colorcode'][$final_state-1].'" class="form-check form-switch">
		<input  class="form-check-input" type="checkbox" id='.$sid.'>
		<label  class="form-check-label" for='.$sid.'>'.$label.'</label>
	</div>
	</div>';	
}


?>

<!--
<button 
style="background-color:'.$GLOBALS['state_colorcode'][$final_state-1].'"
class="btn btn-outline-success btn-sm text-dark btn-block" 
name=sample_id 
value=\''.$sid.'\' >'.$label.'
</button>	
<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
<input type=hidden name=action value=change_status>-->
