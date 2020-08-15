<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
//echo '<link rel="stylesheet" type="text/css" media="print" href="bootstrap/css/bootstrap.min.css">';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);

//echo '<pre>';print_r($_POST);
//echo '</pre>';

echo '<div id=response></div>';

if($_POST['action']=='get_search_condition')
{
	get_search_condition($link);
}
elseif($_POST['action']=='set_search')
{
	set_search($link);
}
elseif($_POST['action']=='search')
{
	$search_array=prepare_search_array($link);
	//print_r($_POST);
	//print_r($search_array);
	$first=TRUE;
	$temp=array();
	foreach ($search_array as $sk=>$sv)
	{
	//print_r($temp);
		$temp=get_sample_with_condition($link,$sk,$sv,$temp,$first);
	//print_r($temp);
		$first=FALSE;
	}
	//print_r($temp);
	if(count($temp)>0)
	{
		

		//$sample_id_csv = implode(',', $temp);
		//echo_export_button($sample_id_csv);
		//echo_class_button($link,'OGDC')	;
		foreach ($temp as $sid)
		{
			view_sample($link,$sid);
			echo '<br>';
		}	
	}
	else
	{
		echo '<h3>No Sample matching // Nothing meaningful provided!!</h3>';
	}
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
