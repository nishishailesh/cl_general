<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');


$GLOBALS['img_list']=array();


$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

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

	
//$pdf->Output('report-'.$_POST['sample_id'].'.pdf', 'I');
$output=$pdf->Output('report.pdf', 'S');
//echo 'xxx';

$rlink=get_remote_link('11.207.1.1',$GLOBALS['email_user'],$GLOBALS['email_pass']);
//run_query($rlink,'email','update email set att=\''.my_safe_string($link,$output).'\' where id=1');

$email=get_one_ex_result($link,$_POST['sample_id'],$GLOBALS['email']);
echo 'Result will sent to ('.$email.')<br>';
if(strlen($email)==0)
{
  echo 'email address not available';
  exit(0);
}

$subject='Biochemistry_Sample_ID_'.$_POST['sample_id'];
$content='<h5>Please Find the report attached herewith</h5>';

//run_query($rlink,'email','update email set att=\''.my_safe_string($link,$output).'\' where id=1');

$mail_sql='insert into email (`to`,subject,content,sent,att,att_name) 
		values(\''.$email.'\',\''.$subject.'\',\''.$content.'\',0,\''.my_safe_string($rlink,$output).'\',\''.$subject.'.pdf\')';
//echo $mail_sql;

if(run_query($rlink,'email',$mail_sql))
{
  echo 'email sent to main server. It may reach destination after 5-30 minutes, depending on main server configuration<br>';
}
else
{
  echo 'email can not be sent to main server.';
}
//////////////user code ends////////////////
//tail();

//echo '<pre>';print_r($_POST);echo '</pre>';


?>
