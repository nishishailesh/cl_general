<?php
require_once 'base/verify_login.php';
	////////User code below/////////////////////
require_once 'project_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//echo '<div>';
main_menu($link); 
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);

$offset=isset($_POST['offset'])?$_POST['offset']:0;
foreach($GLOBALS['sample_status'] as $k=>$v)
{
	echo '<span  style=" margin:2px; background-color:'.$v[2].'" >'.$v[0].'</span>';
}

echo '<div><button 
			id=offset_button1 
			type=button 
			class="btn btn-sm m-1 p-0 btn-secondary"
			onclick=manage_offset(\'minus\')
		>(-)</button>';
echo '<button 
			id=offset_button2 
			type=button 
			class="btn btn-sm m-1 p-0 btn-secondary"			
			onclick=manage_offset(\'plus\')
		>(+)</button>';
echo '<button 
			id=offset_button3 
			type=button 
			class="btn btn-sm m-1 p-0 btn-secondary"
			onclick=manage_offset(\'zero\')
		>(0)</button>';
echo '<span class="bg-warning">Current Offset:</span><span class="bg-warning" id=current_offset>0</span></div>';

monitor($link);


if (isset($_POST['action']) && isset($_POST['sample_id']))
{
	update_sample_status($link,$_POST['sample_id'],$_POST['action']);
}					

//////////////user code ends////////////////
tail();
//echo '<pre>start:post';print_r($_POST);echo '</pre>';
//echo '<pre>start:session';print_r($_SESSION);echo '</pre>';

///////////////////Functions////////////////
function monitor($link)
{
	echo '<div id=monitor class="jumbotron m-0 p-0">Wait for update of recent sample status</div>';
}

?>

<script>

jQuery(document).ready(
	function() 
	{
		console.log( "ready!" );
		start();
		show_offset=0;
	}
);


function start()
{
	setTimeout(callServer, 0);
}

function callServer()
{
	//console.log( new Date() );
	//alert(new Date())
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById('monitor').innerHTML = xhttp.responseText;
		}
	};
	post='session_name=<?php echo $_POST["session_name"];?>&login=<?php echo $_SESSION["login"];?>&password=<?php echo $_SESSION["password"];?>&show_offset='+show_offset;
	xhttp.open('POST', 'monitor.php', true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post);	
	setTimeout(callServer, 10000);
}

function manage_offset(math_sign)
{
	if(math_sign=='plus')
	{
		show_offset=show_offset+100;	
	}
	if(math_sign=='minus')
	{
		show_offset=show_offset-100;	
	}
	if(math_sign=='zero')
	{
		show_offset=0;	
	}	
	
	document.getElementById('current_offset').innerHTML=show_offset;
}
</script>
