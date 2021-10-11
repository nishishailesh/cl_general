<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
//print_r($auth);
main_menu($link);

if($_POST['action']=='Save_TAT_remark')
{
	insert_update_one_examination_with_result(
							$link,
							$_POST['sample_id'],
							$GLOBALS['TAT_remark_id'],
							$_POST['tat_remark']
						);
}


if(in_array('lock',$auth))
{
	//delete_examination($link,$_POST['sample_id'],$GLOBALS['released_by']);
	//insert_one_examination_with_result($link,$_POST['sample_id'],
	//		$GLOBALS['released_by'],$user['name'].' ('.strftime("%Y-%m-%d %H:%M").')');

	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['released_by'],$user['name'].' ('.strftime("%Y-%m-%d %H:%M").')');
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['release_date'],strftime("%Y-%m-%d"));
	insert_update_one_examination_with_result($link,$_POST['sample_id'],$GLOBALS['release_time'],strftime("%H:%M"));

	$tat=calculate_tat($link,$_POST['sample_id'],$print='no');
	if($tat['Total_TAT']>$GLOBALS['TAT_warn_hours'])
	{
                $tat_result=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['TAT_remark_id']);
		echo '<h3 class="text-danger d-inline">Total TAT exceed 4 hours. Add remark if required.</h3>';
		echo '<form class="d-inline"  method=post>
		                <input type=hidden name=session_name value=\''.session_name().'\'>
		                <input type=hidden name=sample_id value=\''.$_POST['sample_id'].'\'>
				<textarea name=tat_remark>'.$tat_result.'</textarea>
				<input type=submit name=action value=\'Save_TAT_remark\'>
			</form>';
	}
}
else
{
	echo '<h3>You are not authorized to release report</h3>';
}
view_sample($link,$_POST['sample_id']);
//calculate_tat($link,$_POST['sample_id']);
echo '<pre>';print_r($tat);echo '</pre>';

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

?>
