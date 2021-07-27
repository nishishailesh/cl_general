<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	
//$sample_id_array=array(1000000,10000010);

//print_r($sample_id_array);
//exit();


$pdf=get_pdf_link_for_barcode();
for($i=$_POST['from']; $i<=$_POST['to'];$i=$i+6)
{
	prepare_cup_barcode($i,$pdf);
}

print_pdf($pdf,'barcode.pdf');


//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';


function prepare_cup_barcode($sample_id,$pdf)
{
$style=array(
                'fitwidth' => false,
                'text' => true,
                'font' => 'helvetica',
                'fontsize' => 6
);

$stylee=array('module_width'=>1,'module_height'=>1);

                $w=18;
                $h=7;
                $rx=26.5;
                $ry=23.5;
                $delta=6;
                $code='C128';
                //$code='EAN8';
                //$code='EAN13';
                //$code='C39';
                //$code='S25';

                $pdf->AddPage();

                //$pdf->write2DBarcode($sample_id,  'QRCODE,L', 10, 10  , 10 , 10,$stylee,'N');
                $pdf->SetFont('helveticaB', '', 9);

                $pdf->SetXY(3,3);
                $pdf->Cell($w,$h,$sample_id,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);
                $pdf->SetXY(28,3);
                $pdf->Cell($w,$h,$sample_id+1,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);

                $pdf->SetXY(3,9);
                $pdf->Cell($w,$h,$sample_id+2,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);
                $pdf->SetXY(28,9);
                $pdf->Cell($w,$h,$sample_id+3,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);

                $pdf->SetXY(3,15);
                $pdf->Cell($w,$h,$sample_id+4,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);
                $pdf->SetXY(28,15);
                $pdf->Cell($w,$h,$sample_id+5,$border=0, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false);

}



?>
