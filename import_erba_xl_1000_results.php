<?php
//$GLOBALS['nojunk']='';
//echo '<pre>';print_r($GLOBALS);echo '</pre>';
require_once 'project_common.php';
require_once 'base/verify_login.php';
//echo '<pre>';print_r($GLOBALS);echo '</pre>';

	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);
echo '<h2 class="bg-danger">Import XL-1000 Results</h2>';

if($_POST['action']=='get_file')
{
	get_import_file();
}
else if($_POST['action']=='import')
{
	csv_to_sql($link,$_FILES['fvalue'],'XL_1000');
}

//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';

function get_import_file()
{
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=file name=fvalue >';
	echo '<button  class="btn btn-danger" type=submit name=action value=import>Import from XL-1000</button>';
	echo'</form>';
}

function get_code_for_examination_id($link,$equipment,$examination_id)
{
	$sql='select * from host_code where equipment=\''.$equipment.'\' and examination_id=\''.$examination_id.'\'';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	//echo '<pre>';print_r($ar);echo '</pre>';
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
	
	$f_data=fread($f,$file_data['size']);
	$f_data_final=substr($f_data,2);	//remove byte-order-mark FF FE
	$f_data_final_ascii=iconv('UTF16LE','ASCII//IGNORE',$f_data_final);	//convert to ascii
	
	//echo '.A.<br>'.$f_data;
	//echo '.B.<br>'.$f_data_final;
	//echo '.C.<br>'.$f_data_final_ascii;
	
	//return;
	$lines = explode(PHP_EOL, $f_data_final_ascii);
	
	foreach($lines as $each_line)
	{
		$ar=str_getcsv
						(
							$each_line,	//input
							"\t"					//delimiter, in double inveted comma only
						);

		//echo '<pre>';print_r($ar);echo '</pre>';
				/*
				Array
				(
					[0] => 1
					[1] => 1007149
					[2] => 
					[3] => ALTT
					[4] => -0.0001
					[5] => U/L
					[6] => N!
					[7] => 05/29/2020 10:29:59
					[8] => 637
					[9] => 
				)
				*/
		
		if(count($ar)>=8)
		{
			//05/29/2020 10:29:59 to YYMMDDHHMMSS format
			$tkd=preg_split('/[:\/\s]+/',$ar[7]); //640=8 1000=7
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
			
			$my_date=$my_date."|XL_1000";

			//echo '<br>'.$my_date;
			//only for given sample_id
			$sample_code_to_ex=get_examination_codes($link,$equipment,$ar[1]);
			if(count($sample_code_to_ex)==0)
			{
				echo '<span class="text-success">No entry for sample_id='.$ar[1].'<br></span>';
				continue;
			}
			
			//echo '<pre>';print_r($sample_code_to_ex);echo '</pre>';
			if(array_key_exists($ar[3],$sample_code_to_ex))
			{
				$examination_id=$sample_code_to_ex[$ar[3]];
			}
			else
			{
				$examination_id=FALSE;
			}
			
			if($examination_id!=FALSE)
			{
				if(ctype_digit($ar[1]))
				{
					$sql=	'insert into primary_result
								(sample_id,examination_id,result,uniq)
								values
								(\''.$ar[1].'\',\''.$examination_id.'\',\''.$ar[4].'\',\''.$my_date.'\')
							on duplicate key
							update result=\''.$ar[4].'\'';							
					echo $sql.'<br>';
					if($result=run_query($link,$GLOBALS['database'],$sql))
					{
						echo '<span class="text-success">Records inserted/updated='.rows_affected($link).'<br></span>';
					}
				}
			}
			else
			{
				echo '<span class="text-danger">('.$ar[1].')->('.$ar[3].') have no corresponding code in host_code table / No such examination requested<br></span>';
			}
			
		}
		
		flush();

	}

}

/*
Byte order mark 	Description
EF BB BF 			UTF-8
FF FE 				UTF-16, little endian
FE FF 				UTF-16, big endian
FF FE 00 00 		UTF-32, little endian
00 00 FE FF 		UTF-32, big-endian

to convert XL1000 exported file on command line
	remove first tow byte (morder mark)
	then convert
	
	dd bs=2 skip=1 if=x.txt of=trimmed.txt
	iconv -f UTF16LE -t ASCII trimmed.txt >simple.txt
*/

?>
