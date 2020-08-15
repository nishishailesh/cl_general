<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
		  
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);

if($_POST['action']=='get_scan')
{
	get_dbid();
}


//elseif($_POST['action']=='view_dbid')
//{
	////echo_class_button($link,'Haemogram');
	//view_sample($link,$_POST['sample_id']);
//}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function get_dbid()
{
	if(isset($_POST['sample_id_array']))
	{
		$received=unserialize(base64_decode($_POST['sample_id_array']));
	}
	else
	{
		$received=array();
	}

	if(isset($_POST['sample_id']))
	{
		$k=array_search($_POST['sample_id'],$received);
		if($k!==FALSE)
		{
			unset($received[$k]);
			echo $k;
		}
		else
		{
			$received[] = $_POST['sample_id'];	
		}
		$serialized=base64_encode(serialize(array_filter($received)));		
	}
	else
	{
		$serialized=base64_encode(serialize(array_filter($received)));	
	}
	
	echo '<form method=post>';
	echo '<div class="basic_form">';
		echo '	<label class="my_label text-danger" for="mrd">Database ID</label>
				<input type=number name=sample_id autofocus class="form-control text-danger" \>
				<input type=hidden name=sample_id_array value=\''.$serialized.'\'>';
				
				
	echo '</div>';
	echo '<button type=submit class="btn btn-primary form-control" name=action value=get_scan>Add/Remove Sample</button>';
	echo '<button type=submit class="btn btn-secondary form-control" 
				name=action formaction=print_report_barcode_scan.php
				formtarget=_blank
				value=print>Print</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
	echo '<h3 class=text-info>If any sample is in list ,it will be removed on rescan</h3>';
	echo '<pre>';print_r(array_filter($received));echo '</pre>';

}


?>
