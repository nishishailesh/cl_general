<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';

//print_r($_POST);
////////User code below/////////////////////	
	if(isset($_POST['fname_postfix']))
	{
		$postfix=$_POST['fname_postfix'];
	}
	else
	{
		$postfix='';
	}

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	download($link,$GLOBALS['database'],$_POST['table'],$_POST['field'],
				$_POST['primary_key'],$_POST['primary_key_value'],
				$_POST['primary_key2'],$_POST['primary_key_value2'],
				$postfix);

function download($link,$d,$t,$f,$pk,$pkv,$pk2,$pkv2,$postfix='')
{
	$sql='select * 
			from `'.$t.'`
			where `'.$pk.'`=\''.$pkv.'\' and
			 `'.$pk2.'`=\''.$pkv2.'\'';
	//echo $sql;
	$result=run_query($link,$d,$sql);
	$ar=get_single_row($result);
	$filename=$postfix;
	$h='Content-Disposition: attachment; filename="'.$filename.'"';
	header($h);
	echo $ar[$f];
}

//////////////user code ends////////////////
tail();
?>
