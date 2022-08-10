<?php
require_once('tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf_barcodes_2d.php');

class MyQRCode extends TCPDF {
	public $MRD;
	
	public function Header() 
	{

		
	}
	
	public function Footer() 
	{

	}
}

	$style = array(
	'border' => 1,
	'vpadding' => '3',
	'hpadding' => '3',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 2, // width of a single module in points
	'module_height' => 2 // height of a single module in points
	

	);

	$patient_mrd='SUR2212121212';
	$my_web_ink='https://12.207.10.145/cl_general/q1.php?m='.$patient_mrd;
	$pdf = new MyQRCode('L', 'mm', array("50","25"), true, 'UTF-8', false);
	//$pdf->SetMargins(2,2); //will take effect from next page onwards
	//$pdf->AddPage();
	//$pdf->SetXY(20,0);
	$pdf->Cell(20,5,$patient_mrd,$border=1, $ln=0, $align='', $fill=false, $link='', $stretch=2, $ignore_min_height=false, $calign='T', $valign='M');	
	$pdf->write2DBarcode($my_web_ink, 'QRCODE,H', 5, 2.5, 20, 20, $style, 'T',True); // N L
    $pdf->Output('QR.pdf', 'I');

/*
 * 
 * /**
	 * Print 2D Barcode.
	 * @param $code (string) code to print
	 * @param $type (string) type of barcode (see tcpdf_barcodes_2d.php for supported formats).
	 * @param $x (int) x position in user units
	 * @param $y (int) y position in user units
	 * @param $w (int) width in user units
	 * @param $h (int) height in user units
	 * @param $style (array) array of options:<ul>
	 * <li>boolean $style['border'] if true prints a border around the barcode</li>
	 * <li>int $style['padding'] padding to leave around the barcode in barcode units (set to 'auto' for automatic padding)</li>
	 * <li>int $style['hpadding'] horizontal padding in barcode units (set to 'auto' for automatic padding)</li>
	 * <li>int $style['vpadding'] vertical padding in barcode units (set to 'auto' for automatic padding)</li>
	 * <li>int $style['module_width'] width of a single module in points</li>
	 * <li>int $style['module_height'] height of a single module in points</li>
	 * <li>array $style['fgcolor'] color array for bars and text</li>
	 * <li>mixed $style['bgcolor'] color array for background or false for transparent</li>
	 * <li>string $style['position'] barcode position on the page: L = left margin; C = center; R = right margin; S = stretch</li>
	 * @param $align (string) Indicates the alignment of the pointer next to barcode insertion relative to barcode height. The value can be:<ul><li>T: top-right for LTR or top-left for RTL</li><li>M: middle-right for LTR or middle-left for RTL</li><li>B: bottom-right for LTR or bottom-left for RTL</li><li>N: next line</li></ul>
	 * @param $distort (boolean) if true distort the barcode to fit width and height, otherwise preserve aspect ratio
	 * @author Nicola Asuni
	 * @since 4.5.037 (2009-04-07)
	 * @public
	 *

	$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
	);

	$patient_mrd='SUR2212121212';
	//$my_web_ink='https://gmcsurat.edu.in:12349/new_via_mrd_qr_code.php?get_qr=yes&mrd='.$patient_mrd;
	$my_web_ink='https://12.207.10.145/cl_general/new_via_mrd_qr_code.php?read_qr=yes&mrd='.$patient_mrd;
	$barcodeobj = new TCPDF2DBarcode($my_web_ink,'QRCODE,H');
	$png=$barcodeobj->getBarcodePngData(3, 3, array(0,0,0));
	//echo $png;
	$encoded_image=base64_encode($png);
	//$img = '<html><body><h4>Hi</h4> </body></html>';
	//echo $img;
	$img = '<html><body><img src="@'.$encoded_image.'" width=30 /> </body></html>';
	//echo $img;
	//echo $img;
	//exit(0);
	//$pdf = new MYPDF_BARCODE('', 'mm', array("50","25"), true, 'UTF-8', true);

	$pdf = new MyQRCode('L', 'mm', array("50","25"), true, 'UTF-8', false);

	$pdf->SetMargins(3,3,3); //will take effect from next page onwards
	$pdf->AddPage();
	$pdf->write2DBarcode($my_web_ink, 'QRCODE,H', 2, 2, 18, 18, $style, 'T'); // N L

    //$pdf->writeHTML($img, true, false, true, false, '');
    $pdf->Output('QR.pdf', 'I');


*/
?>
