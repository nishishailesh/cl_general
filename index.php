<?php
session_name('sn_'.rand(1000000000,1999999999));
session_start();
require_once 'base/common.php';
require_once 'config.php';
head($GLOBALS['application_name']);
login();

echo '<form method=post action=get_database_id_no_login.php class="text-center jumbotron">
		<button class="btn btn-info">Get PDF Report without Login (for Clinical Residents/Staff)</button>
		<input type=hidden name=login value=9999999999>
		<input type=hidden name=password value=doctor>	
		<input type=hidden name=session_name value=\''.session_name().'\'>
		</form>';
		
tail();

?>
