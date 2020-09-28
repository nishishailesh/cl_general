<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);
echo '<h2 class="bg-success">Import XL-640 Results</h2>';

if($_POST['action']=='get_file')
{
	get_import_file();
}
else if($_POST['action']=='import')
{
	csv_to_sql($link,$_FILES['fvalue'],'XL_640');
}

//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';

function get_import_file()
{
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=file name=fvalue >';
	echo '<button  class="btn btn-success" type=submit name=action value=import>Import from XL-640</button>';
	echo'</form>';
}

function get_code_for_examination_id($link,$equipment,$examination_id)
{
	$sql='select * from host_code where equipment=\''.$equipment.'\' and examination_id=\''.$examination_id.'\'';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	echo '<pre>';print_r($ar);echo '</pre>';
	if(isset($ar['examination_id']))
	{
		return $ar['code'];
	}
	else
	{
		return FALSE;
	}
}

function get_examination_codes($link,$equipment,$sample_id)
{
	$result_array=get_result_of_sample_in_array($link,$sample_id);
	$id_code_array=array();
	foreach ($result_array as $examination_id=>$result)
	{
		$code=get_code_for_examination_id($link, $equipment, $examination_id);
		if($code!==FALSE)
		{
			$id_code_array[$code]=$examination_id;
		}
	}
	return $id_code_array;
}


function csv_to_sql($link,$file_data,$equipment)
{
	$f=fopen($file_data['tmp_name'],'r');
	while($ar=fgetcsv($f,'',"\t"))	// '\t' donot work, double-inverted-comma required to express escape sequence
	{
		//echo '<pre>';print_r($ar);echo '</pre>';
		
		if(count($ar)>=8)
		{
			
			//05/29/2020 10:29:59 to YYMMDDHHMMSS format
			$tkd=preg_split('/[:\/\s]+/',$ar[8]);		//640=8 1000=7
			//echo '<br>'.$ar[7];
			//Array ( [0] => 08 [1] => 01 [2] => 2020 [3] => 14 [4] => 03 [5] => 07 ) 
			if(count($tkd)>=6)
			{
				$my_date=$tkd[2].$tkd[0].$tkd[1].$tkd[3].$tkd[4].$tkd[5];
			}
			else
			{
				$my_date='';
			}
			
			$my_date=$my_date."|XL_640";
			
			//only for given sample_id
			$sample_code_to_ex=get_examination_codes($link,$equipment,$ar[2]);
			if(count($sample_code_to_ex)==0)
			{
				echo '<span class="text-success">No entry for sample_id='.$ar[2].'<br></span>';
				continue;
			}
			
			//echo '<pre>';print_r($sample_code_to_ex);echo '</pre>';
			if(array_key_exists($ar[4],$sample_code_to_ex))
			{
				$examination_id=$sample_code_to_ex[$ar[4]];
			}
			else
			{
				$examination_id=FALSE;
			}
			
			if($examination_id!=FALSE)
			{
				if(ctype_digit($ar[2]))
				{
					$sql=	'insert into primary_result
								(sample_id,examination_id,result,uniq)
								values
								(\''.$ar[2].'\',\''.$examination_id.'\',\''.$ar[5].'\',\''.$my_date.'\')
							on duplicate key
							update result=\''.$ar[5].'\'';							
					//echo $sql.'<br>';
					if($result=run_query($link,$GLOBALS['database'],$sql))
					{
						echo '<span class="text-success">Records inserted/updated='.rows_affected($link).'<br></span>';
					}
				}
			}
			else
			{
				echo '<span class="text-danger">('.$ar[2].')->('.$ar[4].') have no corresponding code in host_code table<br></span>';
			}
			
		}
		flush();
	}
}

