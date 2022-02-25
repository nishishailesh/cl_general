<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
        ////////User code below/////////////////////
echo '            <link rel="stylesheet" href="project_common.css">
                  <script src="project_common.js"></script>';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);

if(in_array('requestonly',$auth))
{
        exit(0);
}

main_menu($link);
get_import_file();
if($_POST['action']=='import')
{
	import_csv_send_sms($_FILES['fvalue']);
}
//$result=send_sms('Hi Hello Testing','9664555812');

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////
/*
function send_sms($sms,$num)
{
        $str=$GLOBALS['sms_site'].'?';
        $getdata = http_build_query
                (
                array(
                        'UserID' => $GLOBALS['sms_UserID'],
                        'UserPass' => $GLOBALS['sms_UserPass'],
                        'Message'=>$sms,
                        'MobileNo'=>$num,
                        'GSMID'=>$GLOBALS['sms_GSMID']
                        )
                );
        $hdr = "Content-Type: application/x-www-form-urlencoded";
        $opts = array('http' =>
                                        array(
                                                'method'  => 'GET',
                                                'content' => $getdata,
                                                'header'  => $hdr
                                                )
                                );

        $context  = stream_context_create($opts);
        //echo $str;
        //echo $context;
        $ret=file_get_contents($str,false,$context);
        return $ret;
}
*/

function import_csv_send_sms($file_data)
{
	$f=fopen($file_data['tmp_name'],'r');
	while($ar=fgetcsv($f,'',","))
	{
		echo '<pre>';print_r($ar);echo '</pre>';
		$res=send_sms($ar[1],$ar[0]);
		echo $res;
		echo '<hr>';
		sleep(1);
	}
}


function get_import_file()
{
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=file name=fvalue >';
	echo '<button  class="btn btn-success" type=submit name=action value=import>Import SMS</button>';
	echo'</form>';
}

?>
