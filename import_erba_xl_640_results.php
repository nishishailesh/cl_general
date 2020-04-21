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
	csv_to_sql($link,$_FILES['fvalue']);
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

function prepare_id_code_array($link,$equipment)
{
	$sql='select * from host_code where equipment=\''.$equipment.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ret=array();
	while($ar=get_single_row($result))
	{
		$ret[$ar['examination_id']]=$ar['code'];
	}
	return $ret;
}

function csv_to_sql($link,$file_data)
{
	$code_id_array=prepare_id_code_array($link,'XL_640');
	print_r($code_id_array);
	//echo '<pre>';print_r($file_data);echo '</pre>';2,4,5,8
	$f=fopen($file_data['tmp_name'],'r');
	while($ar=fgetcsv($f,'',"\t"))	// '\t' donot work, double-inverted-comma required to express escape sequence
	{
		//echo '<pre>';print_r($ar);echo '</pre>';
		
		if(count($ar)>=8)
		{
			//echo $ar[2];
			if($examination_id=array_search($ar[4],$code_id_array))
			{
				if(ctype_digit($ar[2]))
				{
					$sql=	'insert into primary_result
								(sample_id,examination_id,result,uniq)
								values
								(\''.$ar[2].'\',\''.$examination_id.'\',\''.$ar[5].'\',\''.$ar[8].'\')
							on duplicate key
							update result=\''.$ar[5].'\'';							
					echo $sql.'<br>';
					if($result=run_query($link,$GLOBALS['database'],$sql))
					{
						echo '<span class="text-success">Records updated='.rows_affected($link).'<br></span>';
					}
				}
			}
			else
			{
				echo '<span class="text-danger">'.$ar[4].' have no corresponding code in host_code table<br></span>';
			}
			
		}
		flush();
	}
}

