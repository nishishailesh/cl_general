<?php
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';
require_once $GLOBALS['main_user_location'];

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$lot_size=200;

echo '<h5 class="text-success">'.strftime("%Y-%m-%d %H:%M:%S").'</h5>';
$one='select max(sample_id) as max_id from result where sample_id between 1000000 and 1999999';
$result=run_query($link,$GLOBALS['database'],$one);
if($result)
{
	$ar=get_single_row($result);
	echo '<span style="border-radius:60px" class="badge bg-warning">Biochemistry Last ID<br><h5>'.$ar['max_id'].'</h5></span>';
}
echo '<div class="d-block">';
//requested //collected //receipt //preprocessed // analysed //released
for ($i=$ar['max_id']-$lot_size;$i<=$ar['max_id'];$i++)
{
	show_sid_button_release_status($link,$i);
	if($i%10==0)
	{
		echo '</div>';
		echo '<div class="d-block">';
	}
}

?>
