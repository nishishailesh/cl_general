<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/common.php';
require_once 'config.php';
//echo $GLOBALS['mrd'].'<br>';
require_once $GLOBALS['main_user_location'];
	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');
//echo '<pre>';print_r($_POST);echo '</pre>';

$GLOBALS['img_list']=array();

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$mmrd=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['mrd']);

if($mmrd!=$_POST['__ex__'.$GLOBALS['mrd']] ){echo '<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
						<h3><span class="bg-warning">MRD and Sample ID donot match</span></h3>';exit(0);}

$released=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['released_by']);
$interim_released=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['interim_released_by']);

//echo 'xxx'.$i.$released_by;
if(strlen($released)==0 && strlen($interim_released)==0)
{
	echo '	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<h3><span class="bg-warning">Sample ID='.$_POST['sample_id'].' of MRD='.$_POST['__ex__'.$GLOBALS['mrd']].' is not released/interim-released by the lab</span></h3>';exit(0);
}
$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);

print_sample($link,$_POST['sample_id'],$pdf);

///arrange for blobs
$sql='select * from result_blob where sample_id=\''.$_POST['sample_id'].'\'';
$result=run_query($link,$GLOBALS['database'],$sql);

$png=array();
while($ar=get_single_row($result))
{
	$ex_result=get_one_ex_result_blob($link,$_POST['sample_id'],$ar['examination_id']);
	$ex_details=get_one_examination_details($link,$ar['examination_id']);

	//only type=blob,img=dw will be printed this way
	$edit_specification=json_decode($ex_details['edit_specification'],true);
	if(!$edit_specification){$edit_specification=array();}
	$type=isset($edit_specification['type'])?$edit_specification['type']:'text';
	$img=isset($edit_specification['img'])?$edit_specification['img']:'';
	if($type=='blob' && $img=='dw')
	//if($type=='blob')
	{
		$png[]=display_dw_png($ex_result,$ex_details['name']);
	}
}

$i=0;
$x=$pdf->GetX();
$y=$pdf->GetY();

foreach($png as $v)
{
	$pdf->Image('@'.$v,$x,$y,40,20,$type='', $link='', $align='', $resize=true,
			$dpi=300, $palign='', $ismask=false, $imgmask=false, $border=1);	
	$x=$x+40;
}

	
$pdf->Output('report-'.$_POST['sample_id'].'.$pdf', 'I');

//////////////user code ends////////////////
//tail();



?>
