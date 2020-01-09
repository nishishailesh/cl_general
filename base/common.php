<?php


function login()
{
echo '
				<form method=post action=start.php class="form-group jumbotron">
						<h3>Login</h3>
						<div><input class="form-control" type=text name=login placeholder=Username></div>
						<div><input class="form-control" type=password name=password placeholder=Password></div>
						<input type=hidden name=session_name value=\''.session_name().'\'>
						<button class="form-control btn btn-primary" type=submit name=action value=login>Login</button></div>
				</form>
	';
}

function head($title='blank')
{
	if(!isset($GLOBALS['nojunk']))
	{
		echo '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		  <title>'.$title.'</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		  <script src="bootstrap/jquery-3.3.1.js"></script>
		  <script src="bootstrap/popper.js"></script>
		  <script src="bootstrap/js/bootstrap.min.js"></script> 		  		  
		  <style>
			  #main_container 
				{
					display: grid;
					grid-template-rows: auto auto;
				}
			  #root_menu
				{
					grid-row-start:1;
					grid-row-end:2;
					justify-self:end;
				}
			  #application
				{
					grid-row-start:2;
					grid-row-end:3;
				}	
		  </style>
		</head>
		<body>';
	}
}

function tail()
{
	if(!isset($GLOBALS['nojunk']))
	{
		echo '</body></html>';
	}
}


/////////////////////////////////////


function get_link($u,$p)
{
	$link=mysqli_connect('127.0.0.1',$u,$p);
	if(!$link)
	{
		echo 'error1:'.mysqli_error($link); 
		return false;
	}
	return $link;
}

function get_remote_link($ip,$u,$p)
{
	$link=mysqli_connect($ip,$u,$p);
	if(!$link)
	{
		echo 'error1:'.mysqli_error($link); 
		return false;
	}
	return $link;
}

function run_query($link,$db,$sql)
{
	$db_success=mysqli_select_db($link,$db);
	
	if(!$db_success)
	{
		echo 'error2:'.mysqli_error($link); return false;
	}
	else
	{
		$result=mysqli_query($link,$sql);
	}
	
	if(!$result)
	{
		echo 'error3:'.mysqli_error($link); return false;
	}
	else
	{
		return $result;
	}	
}

function get_single_row($result)
{
		if($result!=false)
		{
			return mysqli_fetch_assoc($result);
		}
		else
		{
			return false;
		}
}



function my_safe_string($link,$str)
{
	return mysqli_real_escape_string($link,$str);
} 

function  last_autoincrement_insert($link)
{
	return mysqli_insert_id($link);
}

function get_row_count($result)
{
  return mysqli_num_rows($result);
}
////////////////////////////////////////

?>
