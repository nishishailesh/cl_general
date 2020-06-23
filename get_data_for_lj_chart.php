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
echo '<div id=response></div>';

$qc_levels=array(5,8);
$qc_sample_type=array('QC-QC-BI');
$GLOBALS['qc_eqipment_ex_id']=9000;
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;
$GLOBALS['remark']=5098;

echo '<h2>QC</h2>';
echo '<form method=post>
<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
<button type=submit name=get_data value=sample_id_wise>Sample ID wise</button>
<button type=submit name=get_data value=today>Today</button>
<button type=submit name=get_data value=date_wise>Date wise</button>
</form>';

if(isset($_POST['get_data']))
{
	if(	$_POST['get_data']=='sample_id_wise')
	{
		echo '<div class="d-inline-block border rounded p-2 border-info">';
			get_lj_display_parameter_sample_id($link,$qc_levels);
		echo '</div>';
	}
	elseif(	$_POST['get_data']=='today')
	{
		echo '<div class="d-inline-block border rounded p-2 border-primary">';
		//get_lj_display_parameter_date_time($link,$qc_levels);
			get_lj_display_parameter_today($link);
		echo '</div>';
	}
	else if(	$_POST['get_data']=='date_wise')
	{
		echo '<div class="d-inline-block border rounded p-2 border-primary">';
		//get_lj_display_parameter_date_time($link,$qc_levels);
			get_lj_display_parameter_date($link);
		echo '</div>';
	}
}

if(isset($_POST['show_lj']))
{
		echo '<button onclick="toggle_display(\'compact\')">extra</button>';

	if($_POST['show_lj']=='show_lj_sample_id')
	{
		show_lj($link,$_POST);
	}

	if($_POST['show_lj']=='show_lj_today')
	{
		echo '<h2>'.strftime("%Y-%m-%d").'</h2>';
		show_lj_today($link);
	}

	if($_POST['show_lj']=='show_lj_date')
	{	
		echo '<h2>'.$_POST['from_date'].' to '.$_POST['from_date'].'</h2>';
		show_lj_date_range($link,$_POST['from_date'],$_POST['to_date'],$_POST);
	}
}

//////////////user code ends////////////////
tail();


//////////////data//////

//////////////Functions///////////////////////

function get_lj_display_parameter_sample_id($link,$qc_levels)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		//read_checkbox($qc_levels);
		echo '<input type=text name=qc_equipment placeholder="QC Equipment">';
		echo '<input type=number name=from_sample_id placeholder="from sample_id">';
		echo '<input type=number name=to_sample_id placeholder="to sample_id">';
		echo '<input type=checkbox name=compact>';
		//get_examination_names($link);
		get_examination_data($link);
		echo '<button type=submit class="btn btn-primary" name=show_lj value="show_lj_sample_id">Show LJ</button>';
		//echo '<button type=submit class="btn btn-primary" name=show_lj formaction=export_lj.php formtarget=blank value="export_lj_date">Export</button>';		
	echo '</form>';
}


function get_lj_display_parameter_date($link)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		echo '<input type=date name=from_date>';
		echo '<input type=date name=to_date>';
		get_examination_data($link);
		echo '<button type=submit class="btn btn-primary" name=show_lj value="show_lj_date">Show LJ</button>';
		echo '<button type=submit class="btn btn-primary" name=show_lj formaction=export_lj.php formtarget=blank value="export_lj_date">Export</button>';
	echo '</form>';
}


function get_lj_display_parameter_today($link)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		echo '<button type=submit class="btn btn-primary" name=show_lj value="show_lj_today">Show Today\'s LJ</button>';
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


function show_lj_for_sample($link,$sample_id_array,$ex_requested=array())
{
	echo '<table class="table table-striped table-sm" id=qc_table>';
	echo '<tr>
		<td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,0,\'qc_table\')" data-sorting=1>MRD</button></td>
		<td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,1,\'qc_table\')" data-sorting=1>Sample_ID</button></td>
		<td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,2,\'qc_table\')" data-sorting=1>Examination</button></td>
		<td>Result</td>
		<td><pre>4---------3---------2---------1---------0---------1---------2---------3---------4</pre></td>';
		
		if(!isset($_POST['compact']))
		{
			echo '
			<td  class="compact collapse" ><button type=button class="btn btn-sm btn-info" onclick="my_sort_float(this,5,\'qc_table\')" data-sorting=1>SDI</button></td>
			<td  class="compact collapse" >Mean</td>
			<td  class="compact collapse" >SD</td>
			<td  class="compact collapse" ><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,8,\'qc_table\')" data-sorting=1>Date</button></td>
			<td  class="compact collapse" ><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,9,\'qc_table\')" data-sorting=1>Time</button></td>
			<td  class="compact collapse" ><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,10,\'qc_table\')" data-sorting=1>Equipment</button></td>
			<td  class="compact collapse" ><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,11,\'qc_table\')" data-sorting=1>Analysis Time</button></td>
			';
		}
			
	echo '</tr>';
	foreach($sample_id_array as $sample_id)
	{
		display_one_qc($link,$sample_id,$ex_requested);
	}
	echo '</table>';	
}

function show_lj($link,$parameters)
{
	$sample_id_array=get_qc_sample_id_from_parameters($link,$parameters);
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	$ex_requested=explode(',',$parameters['list_of_selected_examination']);
	show_lj_for_sample($link,$sample_id_array,$ex_requested);
}

function show_lj_today($link)
{
	
	$sample_id_array=get_today_sample_id($link);
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	show_lj_for_sample($link,$sample_id_array);

}

function show_lj_date_range($link,$from_date,$to_date,$parameters)
{
	$sample_id_array=get_date_range_sample_id($link,$from_date,$to_date);
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	$ex_requested=explode(',',$parameters['list_of_selected_examination']);
	show_lj_for_sample($link,$sample_id_array,$ex_requested);

}

function display_one_qc($link,$sample_id,$ex_requested)
{

	$mrd_num=get_one_ex_result($link,$sample_id,$GLOBALS['mrd']);
	$sample_requirement=get_one_ex_result($link,$sample_id,$GLOBALS['sample_requirement']);
	$date=get_one_ex_result($link,$sample_id,$GLOBALS['Collection_Date']);
	$time=get_one_ex_result($link,$sample_id,$GLOBALS['Collection_Time']);
	$equipment=get_one_ex_result($link,$sample_id,$GLOBALS['qc_eqipment_ex_id']);
	$comment=get_one_ex_result($link,$sample_id,$GLOBALS['remark']);

	$sql='select * from primary_result where sample_id=\''.$sample_id.'\' order by uniq';
	$result=run_query($link,$GLOBALS['database'],$sql);

	while($ar=get_single_row($result))
	{
		$ex_requested=array_filter($ex_requested);
		if(in_array($ar['examination_id'],$ex_requested) || count($ex_requested)==0)
		{
			$lab_ref_val=get_lab_reference_value($link,$mrd_num,$ar['examination_id'],$date,$time,$equipment);
			
			if($sample_id%2==0){$sample_class='text-danger';}
			else{$sample_class='text-info';}


			$tr_class_list=array(
			'text-primary',
			'text-secondary',
			'text-success',
			'text-info',
			'text-danger',
			'text-info',
			'text-primary',
			'text-secondary',
			'text-muted',
			'text-success'
			);

			$tr_class=$tr_class_list[$ar['examination_id']%10];

			
			echo '<tr class=\''.$tr_class.'\'>';
			
			if(substr($mrd_num,0,strlen($GLOBALS['normal_qc_str']))==$GLOBALS['normal_qc_str'])
			{
				$modified_mrd_num=substr_replace(
						$mrd_num,'<span class="bg-warning text-dark">'.$GLOBALS['normal_qc_str'].'</span>',
						0,strlen($GLOBALS['normal_qc_str'])
						);
				$tick='X';
			}
			else
			{
				$modified_mrd_num=substr_replace(
						$mrd_num,'<span class="bg-light text-dark">'.$GLOBALS['abnormal_qc_str'].'</span>',
						0,strlen($GLOBALS['abnormal_qc_str'])
						);
				$tick='Y';
			}					
			echo '<td>'.$modified_mrd_num.'</td>';
			//sample_id button for remark modal popup		
				echo '<td  class=\''.$sample_class.'\'>';
				echo '<button id=\'button_'.$sample_id.'\'
						class="btn btn-sm '.$sample_class.' "
						data-toggle="modal" 
						data-target=\'#modal_'.$sample_id.$ar['examination_id'].'\'   >'.$sample_id.'</button>';
				echo '<div id=\'modal_'.$sample_id.$ar['examination_id'].'\' class="modal">';
					echo '<div class="modal-dialog">';
						echo 
						'<div class="modal-content">
						
							<div class="modal-header">
								<h4 class="modal-title">Comment for QC ID:'.$sample_id.'<br>
								Refresh main page for reflecting changes</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							
							<div class="modal-body">';
							  $remark_result=get_one_ex_result($link,$sample_id,$GLOBALS['remark']);
							  edit_field($link,$GLOBALS['remark'],array($GLOBALS['remark']=>$remark_result),$sample_id,$readonly='');						  
							echo '</div>
							
							<div class="modal-footer">
							  <button class="btn btn-danger" data-dismiss="modal">Save</button>
							</div>';
												
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '</td>';
			//end of sample_id button for remark modal popup
			
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
						$lj_str=substr_replace($lj_str,'<span class="bg-success">'.$tick.'</span>',$x,1);
					}
					elseif($x>=10 && $x<=70)
					{
						$lj_str=substr_replace($lj_str,'<span class="bg-warning">'.$tick.'</span>',$x,1);
					}
					else
					{
						$lj_str=substr_replace($lj_str,'<span class="bg-danger">'.$tick.'</span>',$x,1);
					}

					echo '<td class="p-0 m-0"><pre>'.$lj_str.'</pre></td>';
					
					if(!isset($_POST['compact']))
					{
						echo '<td  class="compact collapse" >'.$sdi.'</td>';
						echo '<td  class="compact collapse" >'.$lab_ref_val['mean'].'</td>';
						echo '<td  class="compact collapse" >'.$lab_ref_val['sd'].'</td>';
						if(strftime("%Y-%m-%d")==$date)
						{				
							echo '<td class="compact collapse border border-dark">'.$date.'</td>';
						}
						else
						{
							echo '<td  class="compact collapse" >'.$date.'</td>';
						}
						echo '<td  class="compact collapse" >'.$time.'</td>';
						echo '<td  class="compact collapse" >'.$equipment.'</td>';
						//echo '<td>'.$sample_requirement.'</td>';
						echo '<td  class="compact collapse" >'.$ar['uniq'].'</td>';			
					}	
					
				}
				else
				{
					echo '<td class="p-0 m-0"><pre></pre></td>';
					
					if(!isset($_POST['compact']))
					{
						echo '<td  class="compact collapse" ></td>';
						echo '<td  class="compact collapse" ></td>';
						echo '<td  class="compact collapse" ></td>';				
						
						if(strftime("%Y-%m-%d")==$date)
						{				
							echo '<td class="compact collapse border border-dark">'.$date.'</td>';
						}
						else
						{
							echo '<td  class="compact collapse" >'.$date.'</td>';
						}
						echo '<td  class="compact collapse" >'.$time.'</td>';
						echo '<td  class="compact collapse" >'.$equipment.'</td>';
						//echo '<td>'.$sample_requirement.'</td>';
						echo '<td  class="compact collapse" >'.$ar['uniq'].'</td>';
					}
				}
				
			echo '</tr>';		
		}
	}
}

function echo_sample_id_button_for_remark($link,$sample_id)
{
	echo '<div class="modal>'.$sample_id.'</div>';
	//echo'<form method=post action=export.php class="d-inline-block">
	//<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	//<input type=hidden name=sample_id value=\''.$sample_id_csv.'\'>
	//<div class=print_hide><button type=submit class="btn btn-info  border-danger m-0 p-0" name=export>Export</button></div></form>';	
}
/*
function get_date_range_sample_id($link,$from_date,$to_date)
{
	$sql='select mrd.sample_id 
			from 
				result mrd,
				result date_range
			 
			where
				mrd.examination_id=\''.$GLOBALS['mrd'].'\' 
					and
				mrd.result like "QC/%" 
					and
					
				date_range.examination_id=\''.$GLOBALS['Collection_Date'].'\' 
					and	
				(date_range.result between 
						\''.$from_date.'\'
							and				
						\''.$to_date.'\'
				)	
					and					
					
				mrd.sample_id=date_range.sample_id
			
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
}*/


?>
