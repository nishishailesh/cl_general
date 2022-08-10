<?php
//$GLOBALS['nojunk']='';

require_once 'project_common.php';
require_once 'base/common.php';
require_once 'config.php';

head('NCHSLS Surat');

		  
echo 	'<link rel="stylesheet" href="project_common.css">
		 <script src="project_common.js"></script>';

echo '</head>';

require_once $GLOBALS['main_user_location'];
	////////User code below/////////////////////
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);


if(isset($_GET['m']))
{
	echo '<h3>'.$_GET['m'].'</h3>';
	get_data_specific($link,$_GET['m']);
}
else
{
	echo 'insert';
	//$sample_id_array=save_insert_specific($link);
	//if(count($sample_id_array)==0){echo '<h3>No sample required // Nothing to be done</h3>';}
	//foreach($sample_id_array as $sample_id)
	//{
		//view_sample($link,$sample_id);
	//}
}

function get_data_specific($link,$ex_list)
{
	echo '<form method=post class="bg-light jumbotron">';
	echo '<button type=submit class="btn btn-primary form-control" name=action value=insert>Save</button>';
		get_super_profile_mini($link);
	echo '</form>';			
}

//////////////user code ends////////////////
tail();

echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////
function get_super_profile_mini($link)
{
	$sql='select * from super_profile';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<div class="ex_profile">';
	while($ar=get_single_row($result))
	{
					$sinfo=get_super_profile_info($link,$ar['super_profile_id']);
					$s_specification=json_decode($sinfo['edit_specification'],true);
					$group=isset($s_specification['group'])?$s_specification['group']:'general';

					$div_id='s_profile_'.$sinfo['super_profile_id'];
					
					$div_id_for_group='"'.$div_id.'_'.$group.'"';
					$div_class_for_group='s_'.$group;
					
					
					echo '<div id='.$div_id_for_group.' '.$div_class_for_group.'">';
					
					my_on_off_super_profile($ar['name'],$ar['super_profile_id']);

					echo '</div>';
					///
	}
	echo '<input type=text readonly name=list_of_selected_super_profile id=list_of_selected_super_profile>';
	echo '</div>';
}


?>
