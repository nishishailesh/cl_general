<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

////////User code below/////////////////////
//echo '<pre>';print_r($_POST);echo '</pre>';
	
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu();

$qc_levels=array(5,8);
$qc_sample_type=array('QC-QC-BI');
$GLOBALS['qc_eqipment_ex_id']=9000;
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;

echo '<h2>QC</h2>';
get_lj_display_parameter_sample_id($link,$qc_levels);
get_lj_display_parameter_date_time($link,$qc_levels);

if(isset($_POST['show_lj']))
{
	show_lj($link,$_POST);
}

//////////////user code ends////////////////
tail();


//////////////data//////

//////////////Functions///////////////////////

function get_lj_display_parameter_sample_id($link,$qc_levels)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		read_checkbox($qc_levels);
		echo '<input type=text name=qc_equipment placeholder="QC Equipment">';
		echo '<input type=number name=from_sample_id placeholder="from sample_id">';
		echo '<input type=number name=to_sample_id placeholder="to sample_id">';
		get_examination_names($link);
		echo '<input type=submit name=show_lj value="Show LJ">';	
	echo '</form>';
}


function get_lj_display_parameter_date_time($link,$qc_levels)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		read_checkbox($qc_levels);
		echo '<input type=text name=qc_equipment placeholder="QC Equipment">';
		echo '<input type=date name=from_date>';
		echo '<input type=time name=from_time>';
		echo '<input type=date name=to_date>';
		echo '<input type=time name=to_time>';
		get_examination_names($link);
		echo '<input type=submit name=show_lj value="Show LJ">';	
	echo '</form>';
}

function read_checkbox($ar)
{
	foreach ($ar as $v)
	{
		echo '<input type="checkbox" id=\'chk_'.$v.'\' name=\'chk_'.$v.'\'>
				<label for=\'chk_'.$v.'\'>'.$v.'</label>';
	}
}

function get_examination_names($link)
{
	$sql='select examination_id,name from examination where sample_requirement="QC-QC-BI"';
	mk_select_from_sql_kv($link,$sql,'examination_id','name','examination_id','examination_id',$disabled='',$default='',$blank='yes');
}

function get_name_of_ex_id($link,$examination_id)
{
	$sql='select name from examination where examination_id=\''.$examination_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	return $ar['name'];
}

function get_lab_reference_value($link,$mrd_num,$examination_id,$dt,$tm)
{
	$str_datetime=$dt.' '.$tm;
	//2020-06-01 14:36:40
	//%Y-%m-%d %H:%i:%s
	$sql='select * from lab_reference_value where 
			mrd=\''.$mrd_num.'\'
				and
			examination_id=\''.$examination_id.'\'
				and
			(str_to_date(\''.$str_datetime.'\',\'%Y-%m-%d %H:%i:%s\') 
						between
							str_to_date(concat(start_date," ",start_time),\'%Y-%m-%d %H:%i:%s\') 
								and
							str_to_date(concat(end_date," ",end_time),\'%Y-%m-%d %H:%i:%s\') 
						)
			';
	//echo $sql.'<br>';
	$result=run_query($link,$GLOBALS['database'],$sql);
	if(rows_affected($link)!=1)
	{
		//echo 'exact one raw for lab_reference_value is required. got (('.rows_affected($link).'))<br>';
		return false;
	}
	$ar=get_single_row($result);
	return $ar;
	//database user is responsible to see that only one such row is avaialble
}


function show_lj($link,$parameters)
{
	$sample_id_array=get_qc_sample_id_from_parameters($link,$parameters);
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';

	echo '<table class="table table-striped table-sm">';
	foreach($sample_id_array as $sample_id)
	{
		display_one_qc($link,$sample_id);
	}
	echo '</table>';
}

function display_one_qc($link,$sample_id)
{

	$mrd_num=get_one_ex_result($link,$sample_id,$GLOBALS['mrd']);
	$sample_requirement=get_one_ex_result($link,$sample_id,$GLOBALS['sample_requirement']);
	$date=get_one_ex_result($link,$sample_id,$GLOBALS['Collection_Date']);
	$time=get_one_ex_result($link,$sample_id,$GLOBALS['Collection_Time']);
	$equipment=get_one_ex_result($link,$sample_id,$GLOBALS['qc_eqipment_ex_id']);

	$sql='select * from primary_result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);

	while($ar=get_single_row($result))
	{
		$lab_ref_val=get_lab_reference_value($link,$mrd_num,$ar['examination_id'],$date,$time);

		echo '<tr>';
			echo '<td>'.$sample_id.'</td>';
			echo '<td>'.$ar['examination_id'].'-'.get_name_of_ex_id($link,$ar['examination_id']).'</td>';
			echo '<td>'.$ar['result'].'</td>';

			//if($lab_ref_val!=false && is_numeric($ar['result']))
			if(!is_numeric($ar['result']))
			{
				//echo $ar['result'].' not numeric<br>';
			}
			if(!$lab_ref_val!=false)
			{
				//echo $ar['result'].' reference value not found<br>';
			}
			
			if($lab_ref_val!=false && is_numeric($ar['result']))
			{
				$sdi=round((($ar['result']-$lab_ref_val['mean'])/$lab_ref_val['sd']),1);
				//012345678901234567890123456789012345678901234567890123456789012345678901234567890
				//|         |         |         |         |         |         |         |         |
				$lj_str=str_repeat(' ',81);
				$lj_str=substr_replace($lj_str,':',40,1);
				$lj_str=substr_replace($lj_str,'|',40+10,1);
				$lj_str=substr_replace($lj_str,'|',40+20,1);
				$lj_str=substr_replace($lj_str,'|',40+30,1);
				$lj_str=substr_replace($lj_str,'|',40+40,1);
				$lj_str=substr_replace($lj_str,'|',40-10,1);
				$lj_str=substr_replace($lj_str,'|',40-20,1);
				$lj_str=substr_replace($lj_str,'|',40-30,1);
				$lj_str=substr_replace($lj_str,'|',40-40,1);
				$x=min($sdi*10+40,80);
				$x=max($x,0);
				if($x>=20 && $x<=60)
				{
					$lj_str=substr_replace($lj_str,'<span class="bg-success">X</span>',$x,1);
				}
				elseif($x>=10 && $x<=70)
				{
					$lj_str=substr_replace($lj_str,'<span class="bg-warning">X</span>',$x,1);
				}
				else
				{
					$lj_str=substr_replace($lj_str,'<span class="bg-danger">X</span>',$x,1);
				}

				echo '<td class="p-0 m-0"><pre>'.$lj_str.'</pre></td>';
				echo '<td>'.$sdi.'</td>';
				echo '<td>'.$lab_ref_val['mean'].'</td>';
				echo '<td>'.$lab_ref_val['sd'].'</td>';				
				echo '<td>'.$date.'</td>';
				echo '<td>'.$time.'</td>';
				echo '<td>'.$equipment.'</td>';
				echo '<td>'.$mrd_num.'</td>';
				echo '<td>'.$sample_requirement.'</td>';
			}
			else
			{
				echo '<td class="p-0 m-0"><pre></pre></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';				

				
				echo '<td>'.$date.'</td>';
				echo '<td>'.$time.'</td>';
				echo '<td>'.$equipment.'</td>';
				echo '<td>'.$mrd_num.'</td>';
				echo '<td>'.$sample_requirement.'</td>';
			}
		echo '</tr>';		
	}
}

function get_qc_sample_id_from_parameters($link,$parameters)
{
	/*
		[qc_equipment] => 

		[from_date] => 
		[from_time] => 
		[to_date] => 
		[to_time] => 

		[from_sample_id] => 
		[to_sample_id] => 

		[examination_id] => 9001
	)*/
	//echo '<pre>';print_r($parameters);echo '</pre>';

	$sql='select mrd.sample_id 
			from 
				result mrd,
				result equipment
			 
			where
				mrd.examination_id=\''.$GLOBALS['mrd'].'\' 
					and
				mrd.result like "QC/%" 
					and
					
				equipment.examination_id=\''.$GLOBALS['qc_eqipment_ex_id'].'\' 
					and	
				equipment.result = \''.$parameters['qc_equipment'].'\'
					and				
					
				(mrd.sample_id between \''.$parameters['from_sample_id'].'\' and \''.$parameters['to_sample_id'].'\')
					and
					
				mrd.sample_id=equipment.sample_id
			
			order by mrd.sample_id	
			limit 500';
				
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$data=array();
	while($ar=get_single_row($result))
	{
		$data[]=$ar['sample_id'];
	}
	//echo '<pre>';print_r($data);echo '</pre>';	
	return $data;
}
?>
