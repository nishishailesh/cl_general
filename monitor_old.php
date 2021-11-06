<?php
session_name($_POST['session_name']);
session_start();
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';
require_once $GLOBALS['main_user_location'];
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);



//$lot_size=200;
$lot_size=100;


if(isset($_POST['login']))
{
	$_SESSION['login']=$_POST['login'];
}

if(isset($_POST['password']))
{
	$_SESSION['password']=$_POST['password'];
}
		
if(!isset($_SESSION['login']) && !isset($_POST['login']))
{
		exit(0);
}

if(!isset($_SESSION['password']) && !isset($_POST['password']))
{
		exit(0);
}

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

$lh_id=explode("-",$_SESSION['id_range']);


$one='select max(sample_id) as max_id from result where sample_id between \''.$lh_id[0].'\' and \''.$lh_id[1].'\'';

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
$rounded_start_id=$start_id+1+$_POST['show_offset'];		//100361
$end_id=$ar['max_id']+$_POST['show_offset'];

echo '<div class="two_column">';
	echo '<div class="ten_column">';
				for ($i=$rounded_start_id;$i<$rounded_start_id+$lot_size;$i++)
				{
					echo '<div class="btn-group-vertical m-0 p-0 rounded">';
					show_sid_button_release_status($link,$i);
					echo '</div>';
				}			
	
	echo '</div>';

	echo '<div class="ten_column">';
			for ($i=$rounded_start_id+$lot_size;$i<=$end_id;$i++)
			{
				echo '<div class="btn-group-vertical m-0 p-0">';
				show_sid_button_release_status($link,$i);
				echo '</div>';
			}							
	echo '</div>';
echo '</div>';
echo '<pre>monitor:post';print_r($_POST);echo '</pre>';
//echo '<pre>monitor:session';print_r($_SESSION);echo '</pre>';

function get_user_info($link,$user)
{
	$sql='select * from user where user=\''.$user.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}


?>
