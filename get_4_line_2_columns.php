<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

/////Note////
//it is not by mrd
//it is by databaase ID
main_menu($link);
echo '<div id=response></div>';

if($_POST['action']=='get_4_line_2_columns')
{
	get_4_line($link);
}



//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////

function get_4_line()
{

echo '<form method=post action=print_4_line_label_2_columns.php target=_blank>';
echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="line1">Line1</label>
			<input type=text id=line1 name=line1 class="form-control text-danger"\>
			<div>Barcode:<input type=checkbox name=barcode1>Range:<input type=radio name=range value=line1></div>';
	echo '	<label class="my_label text-danger" for="line2">Line2</label>
			<input type=text id=line2 name=line2 class="form-control text-danger"\>
			<div>Barcode:<input type=checkbox name=barcode2>Range:<input type=radio name=range  value=line2></div>';
	echo '	<label class="my_label text-danger" for="line3">Line3</label>
			<input type=text id=line3 name=line3 class="form-control text-danger"\>
			<div>Barcode:<input type=checkbox name=barcode3>Range:<input type=radio name=range  value=line3></div>';
	echo '	<label class="my_label text-danger" for="line4">Line4</label>
			<input type=text id=line4 name=line4 class="form-control text-danger"\>
			<div>Barcode:<input type=checkbox disabled name=barcode4>Range:<input type=radio name=range  value=line4></div>';
			
	echo '	<label class="my_label text-danger" for="from">Range</label>
			<div>From:<input type=number id=line1 name=from class="form-control text-danger"\>
			To:<input type=number id=line1 name=to class="form-control text-danger"\></div>
			<div>Give Start and End</div>';
echo '</div>';
echo '<button type=submit class="btn btn-primary form-control" name=action value=print_4_line>Print label</button>';
echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
echo '</form>';
}

?>


<h5>4 Line Label Help</h5>
<ul>
	<li>If Barcode is tick marked, that perticular line will be barcoded --> Barcode:<input type=checkbox></li>
	<li>If Range is selected, that perticular line will have <b>data^X</b> printed -->Range:<input type=radio></li>
	<li>If Range (from and to) is given, incremental <b>line^X</b>  will be printed</li>
	<li>Line following barcode will be ignored to accomodate barcode</li>
</ul>
