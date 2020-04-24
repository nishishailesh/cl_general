<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	
//$sample_id_array=array(1000000,10000010);

//print_r($sample_id_array);
//exit();


$pdf=get_pdf_link_for_barcode();
for($i=$_POST['from']; $i<$_POST['to']; $i=$i+5)
{
	prepare_small_sample_barcode($i,$pdf);
}
print_pdf($pdf,'barcode.pdf');


//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';


?>
