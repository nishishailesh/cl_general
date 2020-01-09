<?php
$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////

require_once('tcpdf/tcpdf.php');
//require_once('Numbers/Words.php');

class ACCOUNT1 extends TCPDF {

	public function Header() 
	{
	}
	
	public function Footer() 
	{
	    $this->SetY(-10);
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}	
}	
//print_r($_POST);
//print_r($action);
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

$sql='select * from result where sample_id=\''.$_POST['sample_id'].'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	 echo'<table border="1" width="30%" align="center"><tr><td>Sample ID</td><td>'.$_POST['sample_id'].'</td></tr></table><br><br>';
			
			
			
	echo '<table border="1" align="center"><tr><td>Name</td><td>Data</td></tr>';
	while($ar=get_single_row($result))
	{
		//print_r($ar);
		$examination_details=get_one_examination_details($link,$ar['examination_id']);
		$edit_specification=json_decode($examination_details['edit_specification']);
		//print_r($edit_specification);
		//print_r($examination_details);
		echo '<tr><td>'.$examination_details['name'].'</td>
				<td>'.$ar['result'].'</td></tr>';
	}
	
	
		
	echo '</table>';
		



  $myStr = ob_get_contents();
  ob_end_clean();
  
//  echo $myStr;
 // exit(0);
    

	
	     $pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);
//	     $pdf->SetFont('dejavusans', '', 9);
	     //$pdf->SetFont('dejavusans', '', $_POST['fontsize']);
//	     $pdf->SetFont('courier', '', 8);
	     $pdf->SetMargins(10, 10, 10);
	     $pdf->AddPage();
	     $pdf->writeHTML($myStr, true, false, true, false, '');
	    $pdf->Output('print_dc.pdf', 'I');
	 







?>



