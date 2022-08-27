<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
	

//echo '<pre>';print_r($_POST);echo '</pre>';
//exit();

/*


Array
(
    [line1] => rew89
    [line2] => rew7
    [range] => line2
    [line3] => rew6
    [line4] => dfg
    [from] => 1
    [to] => 5
    [action] => view_dbid
    [session_name] => sn_1692785306
)

*/

function get_pdf_link_for_barcode_2C()
{
	class MYPDF_BARCODE extends TCPDF 
	{
		public function Header() {}		//to prevent default header 
		public function Footer() {}		//to prevent default footer
	}



	//$pdf = new MYPDF_BARCODE('', 'mm', array("50","25"), true, 'UTF-8', true);
	$pdf = new MYPDF_BARCODE('', 'mm', array("100","25"), true, 'UTF-8', true);
	
	$pdf->SetMargins(0,0, $right=-1, $keepmargins=false);
	$pdf->setPrintFooter(false);
	$pdf->setPrintHeader(false);
	$pdf->SetAutoPageBreak(TRUE, 0);
	$pdf->setCellPaddings(0,0,0,0);

	return $pdf;	
}

$pdf=get_pdf_link_for_barcode_2C();

	if(is_numeric($_POST['from']) && is_numeric($_POST['to']))
	{
		$from=$_POST['from'];
		$to=$_POST['to'];
	}
	else
	{
		$from=false;
		$to=false;
	}

prepare_label($pdf,$from,$to);
print_pdf($pdf,'barcode.pdf');


function prepare_label($pdf,$from,$to)
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
		'fontsize' => 8,
		'stretchtext' => 4
	);
		if($from!=False && $to!=false && isset($_POST['range']))
		{
			for($counter=$from;$counter<=$to;$counter++)
			{
				$pdf->AddPage();
				$pdf->SetFont('helveticaB', '', 9);

				for($i=0;$i<4;$i++)
				{
					if($_POST['range']=='line'.($i+1))
					{
						$text=$_POST['line'.($i+1)].'^'.$counter;
					}
					else
					{
						$text=$_POST['line'.($i+1)];
					}
					
					
					$pdf->SetXY(5,($i+1)*4);
					if(isset($_POST['barcode'.($i+1)]))
					{
						$pdf->write1DBarcode($text, 'C128',5,($i+1)*4 , 40, 9, 0.4, $style, 'N');
					}
					else
					{
						//$pdf->Cell (40,4,$text,$border=0, $ln=1, $align='', $fill=false, 
						$pdf->Cell (40,4,$text,$border=0, $ln=1, $align='', $fill=false,
						$link='', $stretch=1, $ignore_min_height=false, $calign='T', $valign='M');
					}
					
					$pdf->SetXY(55,($i+1)*4);					
					if(isset($_POST['barcode'.($i+1)]))
					{
						$pdf->write1DBarcode($text, 'C128',55,($i+1)*4 , 40, 9, 0.4, $style, 'N');
						$i++;
					}
					else
					{
						$pdf->Cell (40,4,$text,$border=0, $ln=1, $align='', $fill=false, 
						$link='', $stretch=1, $ignore_min_height=false, $calign='T', $valign='M');	
					}
					
				}
			}
		}
		
		else
		{
			$pdf->AddPage();
			$pdf->SetFont('helveticaB', '', 9);

			for($i=0;$i<4;$i++)
			{
			
				$pdf->SetXY(5,($i+1)*4);
				if(isset($_POST['barcode'.($i+1)]))
				{
					$pdf->write1DBarcode($_POST['line'.($i+1)], 'C128',5,($i+1)*4 , 40, 8, 0.4, $style, 'N');
					//$pdf->write1DBarcode($_POST['line'.($i+1)], 'C39',5,($i+1)*4 , 40, 8, 0.4, $style, 'N');
					//$pdf->write1DBarcode($_POST['line'.($i+1)], 'I25',5,($i+1)*4 , 40, 8, 0.4, $style, 'N');
					//$i++;
				}
				else
				{
					$pdf->Cell (40,4,$_POST['line'.($i+1)],$border=0, $ln=1, $align='', $fill=false, 
					$link='', $stretch=1, $ignore_min_height=false, $calign='T', $valign='M');	
				}
				
				
				if(isset($_POST['barcode'.($i+1)]))
				{
					$pdf->write1DBarcode($_POST['line'.($i+1)], 'C128',55,($i+1)*4 , 40, 8, 0.4, $style, 'N');
					$i++;
				}
				else
				{
					$pdf->SetXY(55,($i+1)*4);
					$pdf->Cell (0,4,$_POST['line'.($i+1)],$border=0, $ln=1, $align='', $fill=false, 
					$link='', $stretch=1, $ignore_min_height=false, $calign='T', $valign='M');	
				}
			
			}			
		}

}

?>
