<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
echo '<link rel="stylesheet" type="text/css" media="print" href="bootstrap/css/bootstrap.min.css">';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//print_r($_POST);
main_menu($link);
echo '<div id=response></div>';

if($_POST['action']=='get_search_condition')
{
	get_search_condition($link);
}
elseif($_POST['action']=='set_search')
{
	set_search_report($link);
}
elseif($_POST['action']=='search')
{
	$search_array=prepare_search_array($link);
	//print_r($search_array);
	$first=TRUE;
	$temp=array();
	foreach ($search_array as $sk=>$sv)
	{
		$temp=get_sample_with_condition($link,$sk,$sv,$temp,$first);
		$first=FALSE;
	}
	//print_r($temp);
	if(count($temp)>0)
	{
		$sample_id_csv = implode(',', $temp);
		echo '<h3>Export is ready. click Export Button to download file</h3>';
		echo_report_export_button($sample_id_csv,$_POST['id']);
	}
	else
	{
		echo '<h3>Nothing meaningful provided!!</h3>';
	}
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////


function list_report_types($link)
{
		$sql='select * from report';
		//echo $sql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$sql);
		while($ar=get_single_row($result))
		{
			echo_report_button($ar['id'],$ar['report_name']);
		}
}

function echo_report_button($id,$name)
{
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
		<div class=print_hide><button type=submit class="btn btn-info  border-danger m-0 p-0 d-inline" name=id value=\''.$id.'\'>'.$name.'</button></div>';
}

function set_search_report($link)
{
	$ex_requested=explode(',',$_POST['list_of_selected_examination']);
	echo '<form method=post>';
		foreach($ex_requested as $v)
		{
			$examination_details=get_one_examination_details($link,$v);
			echo '<div class="basic_form">';
			echo '	<label class="my_label" for="'.$examination_details['name'].'">'.$examination_details['name'].'</label>
					<input 
						id="'.$examination_details['name'].'" 
						name="'.$examination_details['examination_id'].'" 
						data-exid="'.$examination_details['examination_id'].'" 
						class="form-control" >
					<p class="help">Enter details for search</p>';
			echo '</div>';
		}
	//echo '<button type=submit class="btn btn-primary form-control" name=action value=search>Search</button>';
	//echo '<button type=submit class="btn btn-primary form-control" name=action value=search>Search</button>';
	list_report_types($link);
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '<input type=hidden name=action value=search>';
	echo '</form>';
}


/*
function get_search_condition($link)
{
	echo '<form method=post>';
	echo '<div class="basic_form">';
	get_examination_data($link);
	echo '</div>';
	echo '<button type=submit class="btn btn-primary form-control" name=action value=set_search>Set Search</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
}



function get_sample_with_condition($link,$exid,$ex_result,$sid_array=array(),$first=FALSE)
{
	$ret=array();
	
	if($first===TRUE)
	{
		$sql='select sample_id from result 
				where 
					examination_id=\''.$exid.'\' and 
					result like \'%'.$ex_result.'%\' ';
		//echo $sql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$sql);
		while($ar=get_single_row($result))
		{
			$ret[]=$ar['sample_id'];
		}
		return $ret;
	}
	
	//else do as follows
	foreach($sid_array as $v)
	{
		$sql='select sample_id from result 
				where 
					examination_id=\''.$exid.'\' and 
					result like \'%'.$ex_result.'%\' and
					sample_id=\''.$v.'\'';
		//echo $sql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$sql);
		if(get_row_count($result)>0)
		{
			$ret[]=$v;
		}
	}
	return $ret;
}
*/
?>
