<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
	////////User code below/////////////////////


$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);

//echo '<pre>';print_r($_POST);echo '</pre>';
//exit();

if (isset($_POST['action']) && isset($_POST['sample_id']))
{
	update_sample_status($link,$_POST['sample_id'],$_POST['action']);
}	

	$to=strlen($_POST['to'])>0?$_POST['to']:$_POST['from'];
	$ow_post=isset($_POST['\'__ex__'.$GLOBALS['OPD/Ward']])?$_POST['\'__ex__'.$GLOBALS['OPD/Ward']]:'';

		$extra_post='
			<input type=hidden name=from value=\''.$_POST['from'].'\'>
			<input type=hidden name=to value=\''.$_POST['to'].'\'>
			<input type=hidden 
				name=\'__ex__'.$GLOBALS['OPD/Ward'].'\' 
				value=\''.$ow_post.'\'>';
					
	for ($i=$_POST['from'];$i<=$to;$i++)
	{
		$ow=get_one_ex_result($link,$i,$GLOBALS['OPD/Ward']);
		$location_post='__ex__'.$GLOBALS['OPD/Ward'];
		

		if(strlen($_POST[$location_post])>0)
		{
			if($ow==$_POST[$location_post])
			{
				if($_POST['action']=='view_dbid_detail')
				{	
					view_sample($link,$i);
				}
				else
				{
					show_sid_button_release_status($link,$i,$extra_post);
				}
			}
		}
		else
		{
			if($_POST['action']=='view_dbid_detail')
			{	
				view_sample($link,$i);
			}
			else
			{
				show_sid_button_release_status($link,$i,$extra_post);
			}
		}	
	}
				

//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
