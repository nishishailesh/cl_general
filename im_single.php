<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

echo '            <link rel="stylesheet" href="project_common.css">
				<script src="project_common.js"></script>';  
                  
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);

/*
$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);

print_sample($link,$_POST['sample_id'],$pdf);

$output=$pdf->Output('report.pdf', 'S');

$rlink=get_remote_link($GLOBALS['email_db_server'],$GLOBALS['email_user'],$GLOBALS['email_pass']);

$email=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['email']);

echo 'Result will sent to ('.$email.')<br>';
if(strlen($email)==0)
{
  echo 'email address not available';
  exit(0);
}
*/

//				recording_time=now(),
//				recorded_by=\''.$_SESSION['login'].'\'

$GLOBALS['location_id']=1006;

$location=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['location_id']);


//$send_to='shailesh_patel@nchs.gmcsurat.edu.in';
$send_to=$location.'@nchs.gmcsurat.edu.in';

//$message=fetch_lab_report($link,$_POST['sample_id']);

$message=print_sample_for_xmpp($link,$_POST['sample_id']).'\n'.make_link($link,$_POST['sample_id']);


$xmpp_sql='insert into im_message (send_to,message,message_status,recording_time,recorded_by) 
		values
		(
			\''.$send_to.'\',
			\''.$message.'\',
			0,
			now(),
			\''.$_SESSION['login'].'\'
		)';
	
	
//			\''.my_safe_string($link,$message).'\',

//echo $xmpp_sql;

if(run_query($link,$GLOBALS['database'],$xmpp_sql))
{
  echo 'xmpp message sent to main server. It may reach destination after 5-30 minutes, depending on main server configuration<br>';
}
else
{
  echo 'xmpp message can not be sent to main server.';
}
view_sample($link,$_POST['sample_id']);
//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';
function make_link($link,$sample_id)
{
	insert_sample_id_link($link,$sample_id);
	$sql='select  * from sample_link where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	//echo '<pre>';
	//print_r($ar);
	//print_r($_SERVER);
	//echo '</pre>';
	//echo $_SERVER['HTTP_HOST'].'/cl_general/get_linked_report.php?token='.$ar['link'];
	return 'https://gmcsurat.edu.in:12349/cl_general/get_linked_report.php?token='.$ar['link'];
}


function insert_sample_id_link($link,$sample_id)
{
	$sql='insert into sample_link(sample_id,link)
			values (\''.$sample_id.'\',\''.bin2hex(random_bytes(16)).'\')';
	if(!run_query($link,$GLOBALS['database'],$sql))
	{
		return false;
	}	
	else
	{
		return true;
	}
}

function fetch_lab_report($link,$sample_id)
{
	$ret= '\n\nBiochemistry Lab Report\n=====================\n';

	$sql='select sample_id,examination.examination_id,name,result,sample_requirement from result,examination where sample_id=\''.$sample_id.'\' and examination.examination_id=result.examination_id';
    $result=run_query($link,$GLOBALS['database'],$sql);

    $ret=$ret.'sample_id:'. $sample_id.'\n=====================\n';

	$none_ar=array(1000,1001,1002,1003,1004,1005,1006);
	
	while($ar=get_single_row($result))
	{
		if(in_array($ar['examination_id'],$none_ar) && $ar['sample_requirement']=='None')
		{
			$ret=$ret.str_pad($ar['name'],20).':'.$ar['result'].'\n';
			if($ar['examination_id']==1006)
			{
				$ret=$ret."=====================\n";
			}
		}
		else if($ar['sample_requirement']!='None')
		{
			view_field($link,$ex_id,$result);
			$ret=$ret.str_pad($ar['name'],20).':'.$ar['result'].'\n';
		}
	}
	$ret=$ret."=====================\n";
	$ret=$ret."===Detailed Report===\n";

	$ret=$ret.make_link($link,$sample_id);
	return $ret.'\n';

}



function view_sample_p_for_xmpp($link,$sample_id,$profile_wise_ex_list)
{
	$critical_absurd='';
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	echo '\n#####Report Start#####\n';

	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		if($kp==$GLOBALS['pid_profile']){continue;}	//pid is displyed on each page//not needed here

		$pinfo=get_profile_info($link,$kp);
		$profile_edit_specification=json_decode($pinfo['edit_specification'],true);
		$print_hide=isset($profile_edit_specification['print_hide'])?$profile_edit_specification['print_hide']:'';
		$print_style=isset($profile_edit_specification['print_style'])?$profile_edit_specification['print_style']:'';
		
		if($print_hide=='yes'){continue;}	//not to be printed
		
		$display_name=isset($profile_edit_specification['display_name'])?$profile_edit_specification['display_name']:'';

		if($display_name!='no')
		{		
			echo str_pad('****'.$pinfo['name'],30,"*").'\n';
		}
		
		//if($pinfo['profile_id']>$GLOBALS['max_non_ex_profile'])

	
		$header=isset($profile_edit_specification['header'])?$profile_edit_specification['header']:'';
		if($header!='no')
		{
			//echo_result_header_p_for_xmpp();
		}
	
		foreach($vp as $ex_id)
		{

			$examination_details=get_one_examination_details($link,$ex_id);
			$edit_specification=json_decode($examination_details['edit_specification'],true);
			$type=isset($edit_specification['type'])?$edit_specification['type']:'';
			$hide=isset($edit_specification['hide'])?$edit_specification['hide']:'';				
			if($type!='blob'  && $hide!='yes')
			{
				$alert=view_field_p_for_xmpp($link,$ex_id,$ex_list[$ex_id]);
				if(
					$alert==$GLOBALS['absurd_low_message'] ||
					$alert==$GLOBALS['absurd_high_message'] ||
					$alert==$GLOBALS['critical_low_message'] ||
					$alert==$GLOBALS['critical_high_message']
					)
					{
						$critical_absurd=$alert;
					}
{
}
			}
			else if ($type=='blob'  && $hide!='yes')
			{
				//view_field_blob_p($link,$ex_id,$sample_id);
			}
		}

	}
	
	echo '\n#####Report End#####\n';
	return $critical_absurd;
}

function echo_result_header_p_for_xmpp()
{
	echo '\n<Examination><Result><Unit, Ref. Intervals ,(Method)>\n';
}


function view_field_p_for_xmpp($link,$ex_id,$ex_result)
{
		$alert='';
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'';
		$type=isset($edit_specification['type'])?$edit_specification['type']:'';

		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$cinterval_l=isset($edit_specification['cinterval_l'])?$edit_specification['cinterval_l']:'';
		$ainterval_l=isset($edit_specification['ainterval_l'])?$edit_specification['ainterval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		$cinterval_h=isset($edit_specification['cinterval_h'])?$edit_specification['cinterval_h']:'';
		$ainterval_h=isset($edit_specification['ainterval_h'])?$edit_specification['ainterval_h']:'';
		$img=isset($edit_specification['img'])?$edit_specification['img']:'';

		if($img=='dw')
		{
			//$GLOBALS['img_list'][$examination_details['name']]=display_dw_png($ex_result,$examination_details['name']);
		}
		elseif($type=='subsection')
		{		
				echo str_pad('@@@'.$examination_details['name'],20).':\n';
		}
		else
		{		$alert=decide_alert($ex_result,$interval_l,$cinterval_l,$ainterval_l,$interval_h,$cinterval_h,$ainterval_h);
				if($alert==$GLOBALS['critical_low_message'] || $alert==$GLOBALS['critical_high_message'])
				{
					echo str_pad('*'.$examination_details['name'].':*',30).
					str_pad(' '.$ex_result.'  '.$alert,40).
					$help;
				}
				else
				{
					echo str_pad('-'.$examination_details['name'].':',20).
					str_pad(' '.$ex_result.'  '.$alert,40).
					$help;
				}
				echo '\n';
		}
		return $alert;

}		



function print_sample_for_xmpp($link,$sample_id)
{
	$profile_wise_ex_list=get_profile_wise_ex_list($link,$sample_id);
	if($profile_wise_ex_list===false){return;}

	ob_start();
		$final_ret=view_sample_p_for_xmpp($link,$sample_id,$profile_wise_ex_list);
		$myStr = '*Critical/Absurd Alert'.$final_ret.'*'.ob_get_contents();
	ob_end_clean();
	return $myStr;
}

?>
