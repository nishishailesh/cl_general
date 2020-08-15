<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);
echo '<h3>Search and display Sample IDs</h3>';
//echo '<pre>';print_r($GLOBALS);
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
elseif($_POST['action']=='search_summary')
{
	$search_array=prepare_search_array($link);
	if(count($search_array)==0)
	{
		echo '<h3>No meaningful search conditions provided!!</h3>';
		exit(0);
	}
	
	//echo '<pre>';	
	//print_r($_POST);
	//print_r($search_array);

	
	
	$from=' ';
	$counter=0;
	foreach ($search_array as $kd=>$vd)
	{
		$tn='r'.$counter;
		$from=$from.' result '.$tn.' ,';
		$counter++;
	}
	if(substr($from,-1,1)==',')
	{
		$from=substr($from,0,-1);
	}
	
	$counter=0;
	$w=' ';
	foreach ($search_array as $kd=>$vd)
	{
		$tn='r'.$counter;
		
		$w= $w. ' ('.$tn.'.examination_id=\''.$kd.'\' and '.$tn.'.result like \'%'.$vd.'%\' ) and ';
		if($counter>0)
		{
			$tp=' r'.($counter-1);
			$w=$w.' '.$tn.'.sample_id='.$tp.'.sample_id and ';
		}
		$counter++;
	}

	if(substr($w,-4,4)=='and ')
	{
		$w=substr($w,0,-4);
	}
			
	$sql='select * from '.$from.' where '.$w;
	//echo $sql; 
	$ret=array();
	$result=run_query($link,$GLOBALS['database'],$sql);
		while($ar=get_single_row($result))
		{
			show_sid_button_release_status($link,$ar['sample_id']);
		}
	
	//print_r($ret);
	
	//echo '</pre>';
}


elseif($_POST['action']=='search_detail')
{
	$search_array=prepare_search_array($link);
	if(count($search_array)==0)
	{
		echo '<h3>No meaningful search conditions provided!!</h3>';
		exit(0);
	}
	
	//echo '<pre>';	
	//print_r($_POST);
	//print_r($search_array);

	
	
	$from=' ';
	$counter=0;
	foreach ($search_array as $kd=>$vd)
	{
		$tn='r'.$counter;
		$from=$from.' result '.$tn.' ,';
		$counter++;
	}
	if(substr($from,-1,1)==',')
	{
		$from=substr($from,0,-1);
	}
	
	$counter=0;
	$w=' ';
	foreach ($search_array as $kd=>$vd)
	{
		$tn='r'.$counter;
		
		$w= $w. ' ('.$tn.'.examination_id=\''.$kd.'\' and '.$tn.'.result like \'%'.$vd.'%\' ) and ';
		if($counter>0)
		{
			$tp=' r'.($counter-1);
			$w=$w.' '.$tn.'.sample_id='.$tp.'.sample_id and ';
		}
		$counter++;
	}

	if(substr($w,-4,4)=='and ')
	{
		$w=substr($w,0,-4);
	}
			
	$sql='select * from '.$from.' where '.$w;
	//echo $sql; 
	$ret=array();
	$result=run_query($link,$GLOBALS['database'],$sql);
		while($ar=get_single_row($result))
		{
			view_sample($link,$ar['sample_id']);
		}
	
	//print_r($ret);
	
	//echo '</pre>';
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////


?>
