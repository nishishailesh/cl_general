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


//$one='select distinct sample_id from result where sample_id between \''.$lh_id[0].'\' and \''.$lh_id[1].'\' order by sample_id desc limit '.$lot_size*2;

$one='select distinct sample_id from result where 
			sample_id between \''.$lh_id[0].'\' and \''.$lh_id[1].'\' 
			and
			examination_id=\''.$GLOBALS['sample_requirement'].'\'
			and
			result like \'%'.$_SESSION['sample_requirement'].'%\'
			
			order by sample_id desc limit '.$lot_size*2;
//echo $one;

$result=run_query($link,$GLOBALS['database'],$one);


while($ar=get_single_row($result))
{
	show_sid_button_release_status($link,$ar['sample_id']);
}


/*
$first=True;

while($ar=get_single_row($result))
{
	if(!isset($prev_sid)){$prev_sid=$ar['sample_id']+1;}
	if($prev_sid!=$ar['sample_id']+1){show_sid_button_release_status($link,$prev_sid-1);}
	if($first===True)
	{
		$offset=20-$ar['sample_id']%20;
		for($i=$ar['sample_id']+$offset;$i>$ar['sample_id'];$i--)
		{
			show_sid_button_release_status($link,$i);
		}
		$first=False;
	}
	show_sid_button_release_status($link,$ar['sample_id']);
	if($ar['sample_id']%20==1){echo '<br>';}
	$prev_sid=$ar['sample_id'];
}

*/
echo '<pre>monitor:post';print_r($_POST);echo '</pre>';
//echo '<pre>monitor:session';print_r($_SESSION);echo '</pre>';

function get_user_info($link,$user)
{
	$sql='select * from user where user=\''.$user.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}


?>
