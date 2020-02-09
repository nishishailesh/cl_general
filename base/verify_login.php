<?php
session_name($_POST['session_name']);
session_start();
//print_r($_POST);
//print_r($_SESSION);
//The script require three post, session_name, login,password
//the script need login and passord	 eighter as post or as session
require_once 'config.php';	
require_once 'common.php';
require_once $GLOBALS['main_user_location'];

if(isset($_POST['login']))
{
	$_SESSION['login']=$_POST['login'];
}

if(isset($_POST['password']))
{
	$_SESSION['password']=$_POST['password'];
}
		
if(!isset($_SESSION['login']) && !isset($_POST['login']))
{
		exit(0);
}

if(!isset($_SESSION['password']) && !isset($_POST['password']))
{
		exit(0);
}

//any action will exit(0)
if(isset($_POST['action']))
{
	if($_POST['action']=='update_password')
	{
		//donot use session data
		if(!update_password($GLOBALS['main_user'],$GLOBALS['main_pass'],
						$GLOBALS['user_database'],$GLOBALS['user_table'],
						$GLOBALS['user_id'],$_POST['login'] ,
						$GLOBALS['user_pass'],$_POST['password'] ,
						$GLOBALS['expirydate_field'],
						$_POST['password1'],$_POST['password2'],$GLOBALS['expiry_period']))
			{
				head($GLOBALS['application_name']);
				echo '<h3>password not updated</h3>';
				login();
				tail();
				exit(0);
			}
			else
			{
				head($GLOBALS['application_name']);
				echo '<h3>password updated</h3>';
				login();
				tail();
				exit(0);
			}
	}
	
	if($_POST['action']=='change_password')
	{
		//echo 'requested password change';
		head($GLOBALS['application_name']);
		read_new_passoword();
		tail();
		exit(0);
	}
	if($_POST['action']=='logout')
	{
		echo '<h3>Heavy Rain Outside. close this browser window for your safety.</h3>';
		exit(0);
	}
}

//Reach here only if action not defined
$verification_code=verify_login($GLOBALS['main_user'],$GLOBALS['main_pass'],
					$GLOBALS['user_database'],$GLOBALS['user_table'],
					$GLOBALS['user_id'],$_SESSION['login'] ,
					$GLOBALS['user_pass'],$_SESSION['password'],
					$GLOBALS['expirydate_field']);
					
if($verification_code===FALSE)
{
	echo '<h3>could not connect mysql? could not use database? could not verify user?</h3>';
	head($GLOBALS['application_name']);
	login();
	tail();
	exit(0);
}					
if($verification_code==101)
{
	echo '<h3>password expired</h3>';
	head($GLOBALS['application_name']);
	read_new_passoword();
	tail();
	exit(0);
}

//will reach here if there is no action and  succeessful unexpired password given
//only html displayed if login successful
//bypass it if tcpdf complains about it by setting $nojunk
if($verification_code==100 && !isset($GLOBALS['nojunk']))
{
	//echo 'user verified';
	head($GLOBALS['application_name']);
	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	$user=get_user_info($link,$_SESSION['login']);
	$name=isset($user['name'])?$user['name']:'';
	
	echo '<form id=root_menu method=post class="form-group">
			<input type=hidden name=session_name value=\''.session_name().'\'>
			<button class="btn btn-primary" type=submit name=action value=change_password>Change Password</button>
			<button class="btn btn-primary" type=submit name=action value=logout>Logout ('.$name.')</button>
		</form>';		
}

//Over to start.php (or any calling script)
//such script must use following in all forms
/*
	<input type=hidden name=session_name value=\''.session_name().'\'>
*/

///script seecific functions

////Controller functions
function verify_login($mainu,$mainp,$logind,$logint,$uf,$uv,$pf,$pv,$exf)
{
    if(!$link=get_link($mainu,$mainp)){return false;}
    
    $sql='select * from `'.$logint.'` where `'.$uf.'` = \''.$uv.'\'';
    $result=run_query($link,$logind,$sql);
    if($result===FALSE)
    {
		//echo mysqli_error($link);
		return false;
	}
    
    $result_array=get_single_row($result);
    if(!password_verify($pv,$result_array[$pf])){return false;}
    
    if(strtotime($result_array[$exf]) < strtotime(date("Y-m-d")))
    {
		return 101;
	}
    return 100;
}

function update_password($du,$dp,$ud,$ut,$uf,$uv,$pf,$pv,$exf,$p1,$p2,$expiry_period)
{
	if(verify_login($du,$dp,$ud,$ut,$uf,$uv,$pf,$pv,$exf)===false){return false;}
	if($p1!=$p2){return false;}
	if(strlen($p2)<8){echo 'Minimum password Length:8';return false;}
	
	$link=get_link($du,$dp);
	$old_eDate = date('Y-m-d');
    $eDate = date('Y-m-d', strtotime($expiry_period, strtotime($old_eDate)));
	$sqli='update  `'.$ut.'` set `'.$pf.'` =\''.password_hash($p1,PASSWORD_BCRYPT).'\',`'.$exf.'`=\''.$eDate.'\' where `'.$uf.'`=\''.$uv.'\'';	
	$user_pwd=run_query($link,$ud,$sqli);
	if($user_pwd>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}


//////Viewer functions
function read_new_passoword()
{
	echo '
				<form method=post class="form-group jumbotron">
						<h3>Change Password</h3>
						<input class="form-control" readonly type=text name=login placeholder=Username value=\''.$_SESSION['login'].'\'>
						<input class="form-control" type=password name=password placeholder=\'Current Password\'>
						<input class="form-control" type=password name=password1 placeholder=\'New Password, min length=8\'>
						<input class="form-control" type=password name=password2 placeholder=\'New Passord again\'>
						<input type=hidden name=session_name value=\''.session_name().'\'>
						<button class="form-control btn btn-primary" type=submit name=action value=update_password>Update Password</button>
				</form>
	';
}


function get_user_info($link,$user)
{
	$sql='select * from user where user=\''.$user.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}
?>
