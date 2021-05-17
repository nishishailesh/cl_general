<?php
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;
$GLOBALS['Received_on']=1017;
$GLOBALS['Receipt_time']=1018;
$GLOBALS['remark']=5098;
$GLOBALS['patient_name']=1002;

if(isset($GLOBALS['library'])){goto only_functions;}
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

////////User code below/////////////////////
//echo '<pre>';print_r($_POST);echo '</pre>';
	
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);
echo '<div id=response></div>';



if(isset($_POST['one_by_one_sample_id']))
{
	if(ctype_digit($_POST['one_by_one_sample_id']))
	{
		$one_by_one_sample_id=$_POST['one_by_one_sample_id'];
	}
	else
	{
		$one_by_one_sample_id=0;
	}
}
else
{
	$one_by_one_sample_id=0;
}


if(isset($_POST['get_data']))
{

	if($_POST['get_data']=='one_by_one')
	{
		$one_by_one_sample_id=$one_by_one_sample_id;
	}

	if($_POST['get_data']=='one_by_one_plus')
	{
		$one_by_one_sample_id=$one_by_one_sample_id+1;
	}

	if($_POST['get_data']=='one_by_one_minus')
	{
		$one_by_one_sample_id=$one_by_one_sample_id-1;
	}

}

echo '<h2>QC</h2>';
echo '<form method=post>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<div class="d-inline border border-success rounded p-2" >
	<input type=number name=one_by_one_sample_id value=\''.$one_by_one_sample_id.'\' placeholder="for 1-by-1">
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one_plus>+1</button>
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one>OnebyOne</button>
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one_minus>-1</button>
	</div>
</form>';

if(isset($_POST['get_data']))
{
	if(	$_POST['get_data']=='one_by_one' || $_POST['get_data']=='one_by_one_plus' || $_POST['get_data']=='one_by_one_minus')
	{

		echo '<button class="btn btn-warning btn-sm"  onclick="toggle_display(\'compact\')">extra</button><br>';
		echo '<div class="d-inline-block border rounded p-2 border-primary">';
			show_delta_for_single_sample($link,$one_by_one_sample_id);
		echo '</div>';
	}
}

//////////////user code ends////////////////
tail();


//////////////data//////

//////////////Functions///////////////////////
only_functions:
function get_lj_display_parameter_sample_id($link,$qc_levels)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		//read_checkbox($qc_levels);
		echo '<input type=text name=qc_mrd placeholder="QC MRD" value=\'QC/\'">';
		echo '<input type=text name=qc_equipment placeholder="QC Equipment">';
		echo '<input type=number name=from_sample_id placeholder="from sample_id">';
		echo '<input type=number name=to_sample_id placeholder="to sample_id">';
		//echo '<input type=checkbox name=compact>';
		//get_examination_names($link);
		get_examination_data($link);
		echo '<button type=submit class="btn btn-primary" name=show_lj value="show_lj_sample_id">Show LJ</button>';
		echo '<button type=submit class="btn btn-primary" name=show_lj formaction=export_lj.php formtarget=blank value="export_lj_sample">Export</button>';
		echo '<button type=submit class="btn btn-primary" name=show_lj formaction=chart_lj.php formtarget=blank value="chart_lj_sample">Chart</button>';
		
		//echo '<button type=submit class="btn btn-primary" name=show_lj formaction=export_lj.php formtarget=blank value="export_lj_date">Export</button>';		
	echo '</form>';
}


function get_lj_display_parameter_date($link)
{
	echo '<form method=post>';
		echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
		echo '<input type=text name=qc_mrd placeholder="QC MRD" value=\'QC/\'">';
		echo '<input type=text name=qc_equipment placeholder="QC Equipment">';
		
		echo '<input type=date name=from_date>';
		echo '<input type=date name=to_date>';
		get_examination_data($link);
		echo '<button type=submit class="btn btn-primary" name=show_lj value="show_lj_date">Show LJ</button>';
		echo '<button type=submit class="btn btn-primary" name=show_lj formaction=export_lj.php formtarget=blank value="export_lj_date">Export</button>';
		echo '<button type=submit class="btn btn-primary" name=show_lj formaction=chart_lj.php formtarget=blank value="chart_lj_date">Chart</button>';
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
	echo '<table class="table table-sm" id=qc_table>';
	echo '<tr>
		<td>MRD</td>
		<td>Name</td>
		<td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,2,\'qc_table\')" data-sorting=1>Sample_ID</button></td>
		<td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,3,\'qc_table\')" data-sorting=1>Examination</button></td>
		<td>Result</td>
		<!-- <td><button type=button class="btn btn-sm btn-info" onclick="my_sort(this,5,\'qc_table\')" data-sorting=1>Analysis Time</button></td>-->
		<td class="compact collapse">Receipt Date</td>
		<td class="compact collapse">Receipt Time</td>
		<td class="compact collapse">Sample Type</td>
		';

			
	echo '</tr>';
	foreach($sample_id_array as $sample_id)
	{
		display_one_qc($link,$sample_id,$ex_requested);
	}
	echo '</table>';	
}

function show_delta_for_single_sample($link,$sample_id,$ex_requested=array())
{
	//Never use $mrd, it is a global
	$this_mrd=get_one_ex_result($link,$sample_id,$GLOBALS['mrd']);
	 
	$sql='select sample_id from result 
			where 
				examination_id=\''.$GLOBALS['mrd'].'\' 
				and
				result=\''.$this_mrd.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$sample_id_array=array();		
	while($ar=get_single_row($result))
	{
		$sample_id_array[]=$ar['sample_id'];
	}
	
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	show_lj_for_sample($link,$sample_id_array);
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
	$sample_id_array=get_date_range_sample_id($link,$from_date,$to_date,$parameters);
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	$ex_requested=explode(',',$parameters['list_of_selected_examination']);
	show_lj_for_sample($link,$sample_id_array,$ex_requested);

}

function display_one_qc($link,$sample_id,$ex_requested)
{

	$mrd_num=get_one_ex_result($link,$sample_id,$GLOBALS['mrd']);
	$sample_requirement=get_one_ex_result($link,$sample_id,$GLOBALS['sample_requirement']);
	$date=get_one_ex_result($link,$sample_id,$GLOBALS['Received_on']);
	$time=get_one_ex_result($link,$sample_id,$GLOBALS['Receipt_time']);
	$patient_name_local=get_one_ex_result($link,$sample_id,$GLOBALS['patient_name']);
	//never give $name, it is global
	
	//$sql='select * from primary_result where sample_id=\''.$sample_id.'\' order by uniq';
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);

	$current_ex_id=0;
	while($ar=get_single_row($result))
	{
		//echo '<pre>';print_r($ar);
		$ex_requested=array_filter($ex_requested);
		if(in_array($ar['examination_id'],$ex_requested) || count($ex_requested)==0)
		{		
			if($sample_id%2==0){$sample_class='text-danger';}
			else{$sample_class='text-info';}

			if($current_ex_id==$ar['examination_id'])
			{
				$border='border border-top-0 border-bottom-0';
			}
			else
			{
				$border='border  border-top-0 border-bottom-0';
				$current_ex_id=$ar['examination_id'];
			}
			
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

			$tr_class=$tr_class_list[$ar['examination_id']%10].' '.$border;

			//compact allow toggle of display from .js file, collapse allow hide on loading
			echo '<tr class=\''.$tr_class.'\'>';
				
			echo '<td>'.$mrd_num.'</td>';
				echo '<td>'.$patient_name_local.'</td>';		
				echo '<td  class=\''.$sample_class.'\'>'.$sample_id.'</td>';
				echo '<td>'.$ar['examination_id'].'-'.get_name_of_ex_id($link,$ar['examination_id']).'</td>';
				echo '<td>'.$ar['result'].'</td>';
				//echo '<td>'.$ar['uniq'].'</td>';
				//echo '<td></td>';

			
			
				if(strftime("%Y-%m-%d")==$date)
				{				
					echo '<td class="border border-dark compact collapse">'.$date.'</td>';
				}
				else
				{
					echo '<td class="compact collapse" >'.$date.'</td>';
				}


				echo '<td class="compact collapse">'.$time.'</td>';
	
				echo '<td   class="compact collapse" >'.$sample_requirement.'</td>';

			
				
			echo '</tr>';		
		}
	}
}

?>
