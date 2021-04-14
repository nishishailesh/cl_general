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
  justify-items: start;
  gap: 0px 0px;
  margin: 3px;
  border: 3px solid red;
}
</style>

';


//echo '<h5 class="text-success">'.strftime("%Y-%m-%d %H:%M:%S").'</h5>';
$one='select max(sample_id) as max_id from result where sample_id between 1000000 and 1999999';
$result=run_query($link,$GLOBALS['database'],$one);
if($result)
{
	$ar=get_single_row($result);
	//echo '<span style="border-radius:60px" class="badge bg-warning">Biochemistry Last ID<br><h5>'.$ar['max_id'].'</h5></span>';
}

$start_id=$ar['max_id']-2*$lot_size +10;	//100566 -> 100366 -> 100376  100563 -> 100363 -> 100373
$rounded_start_id=round($start_id,-1)+1;		//100370


echo '<div class="two_column">';

	echo '<div class="ten_column">';
			for ($i=$rounded_start_id;$i<$rounded_start_id+$lot_size;$i++)
			{
				show_sid_button_release_status($link,$i);
			}			
	echo '</div>';

	echo '<div class="ten_column">';
			for ($i=$rounded_start_id+$lot_size;$i<=$ar['max_id'];$i++)
			{
				show_sid_button_release_status($link,$i);
				//show_sid_button_equipment_status($link,$i);
			}				
	echo '</div>';
echo '</div>';

?>
