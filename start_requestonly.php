<?php
require_once 'base/verify_login.php';
	////////User code below/////////////////////
require_once 'project_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//echo '<div>';
main_menu($link); 

$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
if(!in_array('requestonly',$auth))
{
	foreach($GLOBALS['sample_status'] as $k=>$v)
	{
		echo '<span  style=" margin:2px; background-color:'.$v[2].'" >'.$v[0].'</span>';
	}
	monitor($link);
}

if (isset($_POST['action']) && isset($_POST['sample_id']))
{
	update_sample_status($link,$_POST['sample_id'],$_POST['action']);
}					

//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($_SESSION);echo '</pre>';

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
	post='session_name=<?php echo $_POST["session_name"];?>;'
	xhttp.open('POST', 'monitor.php', true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post);	
	setTimeout(callServer, 10000);
}

</script>
