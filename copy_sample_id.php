<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu($link);

//view_sample($link,$_POST['sample_id']);
echo '<h4>Copy sample id '.$_POST['sample_id'].'</h4>';

if($_POST['action']=='copy_sample_id')
{
	view_copy_types($link);
}
else if($_POST['action']=='copy_type_selected')
{
	copy_sample($link,$_POST['sample_id'],$_POST['copy_type_id']);
}

//////////////user code ends////////////////
tail();


//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function view_copy_types($link)
{
	$sql='select * from copy_sample';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ret=array();
	while($ar=get_single_row($result))
	{
		show_copy_type_button($_POST['sample_id'],$ar);
	}
}


function get_copy_type_details($link,$copy_type_id)
{
	$sql='select * from copy_sample where id=\''.$copy_type_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return $ar=get_single_row($result);
}

function show_copy_type_button($sample_id,$ar)
{
	echo '<div class="d-inline-block" style="width:100%;">
		<form method=post class=print_hide >
		<button class="btn btn-outline-success btn-sm text-dark " name=copy_type_id value=\''.$ar['id'].'\'>'.$ar['name'].'</button>
		<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
		<input type=hidden name=sample_id value=\''.$sample_id.'\'>
		<input type=hidden name=action value=copy_type_selected>';
	echo '</form></div>';
}

function copy_sample($link,$sample_id,$copy_type_id)
{
	$old=get_result_of_sample_in_array($link,$sample_id);
	//echo '<pre>';print_r($old);echo '</pre>';
	$ar=get_copy_type_details($link,$copy_type_id);
	//echo '<pre>';print_r($ar);echo '</pre>';

	$keep_ex=explode(',',$ar['keep_ex_list']);
	//echo '<pre>';print_r($keep_ex);echo '</pre>';
	$add_ex=explode(',',$ar['add_ex_list']);
	//echo '<pre>';echo($ar['add_ex_with_result']);echo '</pre>';
	$add_ex_with_result=json_decode($ar['add_ex_with_result'],true);
	//echo '<pre>--->';print_r($add_ex_with_result);echo '</pre>';
		
	$sample_id_array=save_insert_specific_with_parameters($link,$ar['keep_ex_list'].','.$ar['add_ex_list']);
	
	if(count($sample_id_array)==0){echo '<h3>No sample required // Nothing to be done</h3>'; return;}
	foreach($sample_id_array as $sample_id)
	{
			foreach($keep_ex as $k=>$v)
			{
				if(isset($old[$v]))
				{
					insert_update_one_examination_with_result($link,$sample_id,$v,$old[$v]);
				}
			}

			foreach($add_ex_with_result as $k=>$v)
			{
				if($v[0]=='$')
				{
					if(substr($v,1)=='current_date'){$derived_v=strftime("%Y-%m-%d");}
					elseif(substr($v,1)=='current_time'){$derived_v=strftime("%H:%M");}
					insert_update_one_examination_with_result($link,$sample_id,$k,$derived_v);					
				}
				else
				{
					insert_update_one_examination_with_result($link,$sample_id,$k,$v);
				}
			}	
			view_sample($link,$sample_id);
	}
}

//echo '<pre>';print_r($GLOBALS);echo '</pre>';

?>
