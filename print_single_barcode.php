<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

$pdf=get_pdf_link_for_barcode();
if($_POST['action']=='two_barcode' || $_POST['action']=='one_barcode')
{
	prepare_sample_barcode($link,$_POST['sample_id'],$pdf);
}
if($_POST['action']=='two_barcode' ||$_POST['action']=='second_barcode')
{
	prepare_sample_barcode_for_tube($link,$_POST['sample_id'],$pdf);
}
print_pdf($pdf,'barcode.pdf');

//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';

?>
