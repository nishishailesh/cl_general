<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu();

if($_POST['action']=='get_file')
{
	get_import_file();
}
else if($_POST['action']=='import')
{
	csv_to_sql($_FILES['fvalue']);
}

//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';

function get_import_file()
{
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=file name=fvalue >';
	echo '<button  class="btn btn-success" type=submit name=action value=import>Import</button>';
	echo'</form>';
}

function csv_to_sql($file_data)
{
	//echo '<pre>';print_r($file_data);echo '</pre>';2,4,5,8
	$f=fopen($file_data['tmp_name'],'r');
	while($ar=fgetcsv($f,'',"\t"))
	{
		//echo '<pre>';print_r($ar);echo '</pre>';
		
		if(count($ar)>=8)
		{
			//echo $ar[2];
			if(ctype_digit($ar[2]))
			{
				$sql=	'insert into primary_result
							(sample_id,ex_id,result,uniq)
							values
							(\''.$ar[2].'\',\''.$ar[4].'\',\''.$ar[5].'\',\''.$ar[8].'\')
						on duplicate
						set result=\''.$ar[5].'\'';
				echo $sql.'<br>';
			}
		}
	}
}
