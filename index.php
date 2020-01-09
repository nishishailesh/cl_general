<?php
session_name('sn_'.rand(1000000000,1999999999));
session_start();
require_once 'base/common.php';
require_once 'config.php';
head($GLOBALS['application_name']);
login();
tail();
?>
