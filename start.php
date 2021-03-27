<?php

require_once 'base/verify_login.php';
	////////User code below/////////////////////
require_once 'project_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	//echo '<div>';
	main_menu($link); 
	//echo '</div>';
	//echo '<div class="btn-group">';
	dashboard($link);
	//echo '</div>';
	//echo '<div class="btn-group">';
	show_dashboard($link);
	//echo '</div>';
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
if(!in_array('requestonly',$auth))
{
	monitor($link);
}
		
				if(isset($_POST['action']))
				{
					if( $_POST['action']=='display_data')
					{
				
					$result=prepare_result_from_view_data_id($link,$_POST['id']);
					
				
					}
				}
						
function monitor($link)
{
	echo '<div id=monitor class="jumbotron m-0 p-0">Wait for update of recent sample status</div>';
}

	//////////////user code ends////////////////
tail();
//echo '<pre>';print_r($_POST);echo '</pre>';

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
	setTimeout(callServer, 2000);
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
	post='<?php echo "session_name=".$_POST["session_name"]; ?>';
	xhttp.open('POST', 'monitor.php', true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post);	
	setTimeout(callServer, 2000);
}

</script>
