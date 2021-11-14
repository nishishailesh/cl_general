<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
require_once 'single_table_edit_common.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);

if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu($link);

if($_POST['action']=='get_TAT_search_condition')
{
	get_search_condition($link);
}
elseif($_POST['action']=='set_search')
{
	set_search_single_button($link,'','target=_blank','action','view','view');
	set_search_single_button($link,'action=export_TAT.php','target=_blank','action','export','export');
}
elseif($_POST['action']=='search_summary')
{
	echo '<h2>Click <span class="bg-primary" >Search (Detailed View)"</span></h2>';
	//print_r($search_array);
}

elseif($_POST['action']=='view')
{
	$search_array=prepare_search_array($link);
	echo '<span class=bg-warning>Search Condition:</span>';print_r($search_array);

	if(count($search_array)==0)
	{
		echo '<h3>No meaningful search conditions provided!!</h3>';
		exit(0);
	}

	$result=get_result_of_search_array($link,$search_array);
	
	echo '<h3 class="text-success">Detailed TAT(in hours) of each sample</h3>';
	echo '<table class="table table-striped table-sm table-bordered d-inline">';
	echo '<tr><th>Sample ID</th><th>Location</th><th>Receipt_time</th><th>Collection-Request</th><th>Receipt-Collection</th><th>Release-Receipt</th><th>Total</th><th>Remark</th></tr>';
	while($ar=get_single_row($result))
	{
		$tat=calculate_tat($link,$ar['sample_id'],$print='no');
		$location=get_one_ex_result($link,$tat['sample_id'],$GLOBALS['OPD/Ward']);
		$tat_remark=get_one_ex_result($link,$tat['sample_id'],$GLOBALS['TAT_remark_id']);

		$cr=isset($tat['Collection_Request_TAT'])?$tat['Collection_Request_TAT']:'';
		//print_r($tat);
		echo '<tr>';
			echo '<td>';
				sample_id_view_button_with_tat($tat['sample_id'],$target=' target=_blank ',$label=$tat['sample_id']);
			echo '</td>';
			//echo '<td>'.$tat['sample_id'].'</td>';
			echo '<td>'.$location.'</td>';
			echo '<td>'.(isset($tat['receipt_time'])?$tat['receipt_time']:'???').'</td>';
			echo '<td>'.(isset($tat['Collection_Request_TAT'])?$tat['Collection_Request_TAT']:'').'</td>';
			echo '<td>'.(isset($tat['Receipt_Collection_TAT'])?$tat['Receipt_Collection_TAT']:'').'</td>';
			echo '<td>'.(isset($tat['Release_SampleReciept_TAT'])?$tat['Release_SampleReciept_TAT']:'').'</td>';
			echo '<td>'.(isset($tat['Total_TAT'])?$tat['Total_TAT']:'').'</td>';
			echo '<td>'.$tat_remark.'</td>';

		echo '</tr>';
	}
	echo '</table>';
}


/*
Array
(
    [sample_id] => 1001000
    [request_time] => 2020-04-27 15:24:46
    [collection_time] => 2020-04-27 21:50
    [Collection_Request_TAT] => 6
    [receipt_time] => 2020-04-27 22:24
    [Receipt_Collection_TAT] => 0.6
    [5001] => 04/27/2020 18:04:29
    [5006] => 04/27/2020 18:04:38
    [5009] => 04/27/2020 18:04:46
    [5010] => 04/27/2020 18:04:55
    [5019] => 04/27/2020 17:36:08
    [5020] => 04/27/2020 17:36:08
    [release_time] => 2020-08-26 23:18:03
    [Release_SampleReciept_TAT] => 2904.9
    [Total_TAT] => 2911.9
)

*/
//TAT
//Sample wise
//Date wise
//	for each sample
//	arranged by TAT
//	average
//	more than agreed TAT


//////////////user code ends////////////////
tail();

echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';



function sample_id_view_button_with_tat($sample_id,$target='',$label='View')
{
        echo '<div class="d-inline-block" style="width:100%;"><form method=post action=view_single_with_tat.php class=print_hide '.$target.'>
        <button class="btn btn-outline-success btn-sm text-dark " name=sample_id value=\''.$sample_id.'\' >'.$label.'</button>
        <input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
        <input type=hidden name=action value=view_single>';
        echo '</form></div>';
}

//////////////Functions///////////////////////
?>
