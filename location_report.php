<?php
//	$GLOBALS['nojunk']='';

require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
	main_menu($link);

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if($_POST['action']=='get_location_list')
{
	echo '<h3>Search and print Sample IDs</h3>';
	get_location_list($link);
}
elseif($_POST['action']=='search')
{
	echo '<h3 class="text-success" >Samples from '.$_POST['__ex__1006'].' on '.$_POST['__ex__1017'].'</h3>';
						
	$search_sql='select loc_r.sample_id 
					from result loc_r, result rec_r
					where 
					
					loc_r.examination_id=1006
					and
					rec_r.examination_id=1017
					
					and
					loc_r.sample_id=rec_r.sample_id
					
					and
					(
						loc_r.result=\''.$_POST['__ex__1006'].'\'
						and
						rec_r.result=\''.$_POST['__ex__1017'].'\'
					)
					';
		//print($search_sql);
		$result=run_query($link,$GLOBALS['database'],$search_sql);
		while($ar=get_single_row($result))
		{
			//echo $ar['sample_id'];
			show_sid_button_release_status_and_pid($link,$ar['sample_id']);
			echo '<br>';
		}

}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////
function get_location_list($link)
{
	echo '<form method=post>';
	
	get_one_field_for_insert($link,1006);
	get_one_field_for_insert($link,1017);
	echo '<button type=submit class="btn btn-primary form-control m-1" name=action value=search>Search</button>';		
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	
	echo '</form>';
}
?>
