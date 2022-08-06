<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
echo '  <link rel="stylesheet" href="project_common.css">
                  <script src="project_common.js"></script>';   

main_menu($link);
echo '<h3>Moving Average</h3>';
read_ma_input($link);

function read_ma_input($link)
{
	echo '<form method=post action=ma_graph.php target=_blank>';
        echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
		echo '<input placeholder=examination_id type=text name=examination_id>';
		echo '<input placeholder=limit type=text name=limit>';
		echo '<input placeholder=offset type=text name=offset>';
		echo '<input type=submit name=action value=view>';
	echo '</form>';

}
?>
