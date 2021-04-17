<?php
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';
require_once $GLOBALS['main_user_location'];

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
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

echo '<div class="two_column">';
	echo '<div class="ten_column">';
				for ($i=$rounded_start_id;$i<$rounded_start_id+$lot_size;$i++)
				{
					echo '<div class="btn-group-vertical m-0 p-0">';
					//echo '<div border border-warning>';
					show_sid_button_release_status($link,$i);
					show_sample_dropdown($link,$i);
					//echo '</div>';
					echo '</div>';
				}			
	
	echo '</div>';

	echo '<div class="ten_column">';
			for ($i=$rounded_start_id+$lot_size;$i<=$ar['max_id'];$i++)
			{
				echo '<div class="btn-group-vertical m-0 p-0">';
				show_sid_button_release_status($link,$i);
				show_sample_dropdown($link,$i);
				echo '</div>';
			}							
	echo '</div>';
echo '</div>';

echo '<pre>';print_r($_POST);echo '</pre>';

function show_sample_dropdown($link,$sid)
{
	echo '
<div class="btn-group">
  <button type="button" class="m-0 p-0 btn btn-success btn-block btn-sm dropdown-toggle" data-toggle="dropdown">'.$sid.'</button>
  <ul class="dropdown-menu">
    <li><a href="#">'.$sid.'</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>';
}

?>
