<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

$sample_id_array=unserialize(base64_decode($_POST['sample_id_array']));
//print_r($sample_id_array);
//exit();
$pdf=get_pdf_link_for_barcode();
foreach($sample_id_array as $sample_id)
{
	prepare_sample_barcode($link,$sample_id,$pdf);
	if($_POST['action']=='two_barcode')
	{	
		prepare_sample_barcode_for_tube($link,$sample_id,$pdf);
	}
}
print_pdf($pdf,'barcode.pdf');


//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';

?>
