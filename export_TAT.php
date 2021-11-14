<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'project_common.php';

////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);



$fp = fopen('php://output', 'w');
if ($fp) 
{
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="TAT_export.csv"');
}


	$search_array=prepare_search_array($link);
	fputcsv($fp,array('Search Condition',implode(",",$search_array)));

	if(count($search_array)==0)
	{
		echo '<h3>No meaningful search conditions provided!!</h3>';
		exit(0);
	}

	$result=get_result_of_search_array($link,$search_array);
	
	fputcsv($fp,array('Sample ID','Location','Receipt_time','Collection-Request','Receipt-Collection','Release-Receipt','Total','Remark'));
	while($ar=get_single_row($result))
	{
		
		$tat=calculate_tat($link,$ar['sample_id'],$print='no');
		$location=get_one_ex_result($link,$tat['sample_id'],$GLOBALS['OPD/Ward']);
		$tat_remark=get_one_ex_result($link,$tat['sample_id'],$GLOBALS['TAT_remark_id']);

		$cr=isset($tat['Collection_Request_TAT'])?$tat['Collection_Request_TAT']:'';
		$result_data=
			array(
				$tat['sample_id'],
				$location,
				isset($tat['receipt_time'])?$tat['receipt_time']:'',
				isset($tat['Collection_Request_TAT'])?$tat['Collection_Request_TAT']:'',
				isset($tat['Receipt_Collection_TAT'])?$tat['Receipt_Collection_TAT']:'',
				isset($tat['Release_SampleReciept_TAT'])?$tat['Release_SampleReciept_TAT']:'',
				isset($tat['Total_TAT'])?$tat['Total_TAT']:'',
				$tat_remark
				);
		fputcsv($fp, $result_data);
	}



//prepare_result_for_export($link,$_POST['id']);
//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////user code ends////////////////
tail();

?>
