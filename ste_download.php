<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';

//print_r($_POST);
//exit(0);
////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	download($link,$_POST['table'],$_POST['field'],
				$_POST['primary_key']);

//Array ( 	[table] => equipment_records 
//			[field] => attachment 
//			[primary_key] => 1 
//			[session_name] => sn_1184876634 
//			[action] => download ) 

function download($link,$tname,$fname,$pk)
{
	$sql='select `'.$fname.'`, `'.$fname.'_name'.'`
			from `'.$tname.'`
			where `id`=\''.$pk.'\' ';
			
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	$filename=$ar[$fname.'_name'];
	$h='Content-Disposition: attachment; filename="'.$filename.'"';
	header($h);
	echo $ar[$fname];
}

//////////////user code ends////////////////
tail();
?>
