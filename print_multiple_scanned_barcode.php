<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

?>

<script>
function clear_list()
{
//	alert("hi");
//	var xhr = new XMLHttpRequest();
//	xhr.open("POST", 'print_report_barcode_scan.php', true);
//	xhr.setRequestHeader('Content-Type','application/json');
	//xhr.send(JSON.stringify({"sample_id_array":"YToxOntpOjA7czo3OiIxMDAxMDAwIjt9"}));
//	xhr.send();
}

</script>

<?php

main_menu($link);
if($_POST['action']=='get_scan')
{
	get_dbid();
}

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

	//echo '<form id=xyz  fname=wqeq&lname=qwe method=post>';
	echo '<form id=xyz  target=_blank method=post>';
	echo '<div class="basic_form">';
		echo '	<label class="my_label text-danger" for="mrd">Database ID</label>
			<input type=text name=sample_id autofocus class="form-control text-danger" \>';
		echo '<input type=hidden id=sample_id_array name=sample_id_array value=\''.$serialized.'\'>';
		echo '<input type=hidden id=sample_id_array2 name=sample_id_array2 value=\''.$serialized.'\'>';

	echo '</div>';
	echo '<button type=submit  class="btn btn-primary form-control" name=action value=get_scan>Add/Remove Sample</button>';
	echo '<button type=submit id=print_action onclick="clear_list();" class="btn btn-secondary form-control" 
				name=action formaction=print_report_barcode_scan.php
				value=print>Print</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
	echo '<h3 class=text-info>If any sample is in list ,it will be removed on rescan</h3>';
	echo '<pre>';print_r(array_filter($received));echo '</pre>';
}

//formtarget=_blank

?>
