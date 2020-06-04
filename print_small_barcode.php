<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	
//$sample_id_array=array(1000000,10000010);

//print_r($sample_id_array);
//exit();


$pdf=get_pdf_link_for_barcode();
for($i=$_POST['from']; $i<=$_POST['to']; $i=$i+1)
{
	//prepare_small_sample_barcode_horizontal($i,$pdf);
	prepare_sample_barcode_code_type($i,$pdf,$_POST['code_type']);
}
print_pdf($pdf,'barcode.pdf');


//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_FILES);echo '</pre>';


function prepare_sample_barcode_code_type($sample_id,$pdf,$code_type)
{
		$style = array(
		'position' => '',
		'align' => 'C',
		'stretch' => true,
		'cellfitalign' => '',
		'border' => false,
		'hpadding' => 'auto',
		'vpadding' => '0',
		'fgcolor' => array(0,0,0),
		'bgcolor' => false, //array(255,255,255),
		'text' => true,
		'font' => 'helvetica',
		'fontsize' => 10,
		'stretchtext' => 4
	);
		
		$pdf->AddPage();
                //$pdf->write1DBarcode($sample_id, 'C128', 03, 6 , 43, 15, 0.4, $style, 'N');
		$pdf->write1DBarcode($_POST['append'].$sample_id, $code_type, 03, 6 , 43, 15, 0.4, $style, 'N');
}
	/**
	 * Print a Linear Barcode.
	 * @param $code (string) code to print
	 * @param $type (string) type of barcode (see tcpdf_barcodes_1d.php for supported formats).
	 * @param $x (int) x position in user units (empty string = current x position)
	 * @param $y (int) y position in user units (empty string = current y position)
	 * @param $w (int) width in user units (empty string = remaining page width)
	 * @param $h (int) height in user units (empty string = remaining page height)
	 * @param $xres (float) width of the smallest bar in user units (empty string = default value = 0.4mm)
	 * @param $style (array) array of options:<ul>
	 * <li>boolean $style['border'] if true prints a border</li>
	 * <li>int $style['padding'] padding to leave around the barcode in user units (set to 'auto' for automatic padding)</li>
	 * <li>int $style['hpadding'] horizontal padding in user units (set to 'auto' for automatic padding)</li>
	 * <li>int $style['vpadding'] vertical padding in user units (set to 'auto' for automatic padding)</li>
	 * <li>array $style['fgcolor'] color array for bars and text</li>
	 * <li>mixed $style['bgcolor'] color array for background (set to false for transparent)</li>
	 * <li>boolean $style['text'] if true prints text below the barcode</li>
	 * <li>string $style['label'] override default label</li>
	 * <li>string $style['font'] font name for text</li><li>int $style['fontsize'] font size for text</li>
	 * <li>int $style['stretchtext']: 0 = disabled; 1 = horizontal scaling only if necessary; 2 = forced horizontal scaling; 3 = character spacing only if necessary; 4 = forced character spacing.</li>
	 * <li>string $style['position'] horizontal position of the containing barcode cell on the page: L = left margin; C = center; R = right margin.</li>
	 * <li>string $style['align'] horizontal position of the barcode on the containing rectangle: L = left; C = center; R = right.</li>
	 * <li>string $style['stretch'] if true stretch the barcode to best fit the available width, otherwise uses $xres resolution for a single bar.</li>
	 * <li>string $style['fitwidth'] if true reduce the width to fit the barcode width + padding. When this option is enabled the 'stretch' option is automatically disabled.</li>
	 * <li>string $style['cellfitalign'] this option works only when 'fitwidth' is true and 'position' is unset or empty. Set the horizontal position of the containing barcode cell inside the specified rectangle: L = left; C = center; R = right.</li></ul>
	 * @param $align (string) Indicates the alignment of the pointer next to barcode insertion relative to barcode height. The value can be:<ul><li>T: top-right for LTR or top-left for RTL</li><li>M: middle-right for LTR or middle-left for RTL</li><li>B: bottom-right for LTR or bottom-left for RTL</li><li>N: next line</li></ul>
	 * @author Nicola Asuni
	 * @since 3.1.000 (2008-06-09)
	 * @public
	 */

?>
