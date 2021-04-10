<?php

//curl -X POST -H 'Content-Type: application/json'  -d '{"chat_id": "-1001338261960", "text": "====Sample ID: '$1'====\n'"$x"'" , "disable_notification": true}' https://api.telegram.org/bot1691350169:AAGepYfuQP4jbjZDyOnhHA7bKVrBWZP2Uf4/sendMessage
//curl -F chat_id="-xxxxxxxxxx" -F document=@"/home/telegram/someFile.pdf" -F caption="Text Message with attachment" https://api.telegram.org/bot<token>/sendDocument

//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

echo '            <link rel="stylesheet" href="project_common.css">
				<script src="project_common.js"></script>';  
                  
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);
$pdf = new ACCOUNT1('P', 'mm', 'A4', true, 'UTF-8', false);

print_sample($link,$_POST['sample_id'],$pdf);

$output=$pdf->Output('report.pdf', 'S');

$res=get_result_of_sample_in_array_with_ex_name($link,$_POST['sample_id']);
$res_str='<pre>Sample_ID:'.$_POST['sample_id'].'</pre><pre>'.print_r($res,true).'</pre>';
//$res_str='<pre>Sample_ID:'.$_POST['sample_id'].'<br>'.print_r($res,true).'</pre>';

$token = "1691350169:AAGepYfuQP4jbjZDyOnhHA7bKVrBWZP2Uf4";
$chatid = "-1001338261960";
sendMessage($chatid, $res_str, $token);
//echo '<br>';
//sendAttachment($chatid, $output, $token);
view_sample($link,$_POST['sample_id']);


//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';



function sendMessage($chatID, $messaggio, $token) {
    echo "sending message to " . $chatID . "\n";

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=HTML&chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function sendAttachment($chatID, $attachment, $token) {
    echo "sending message to " . $chatID . "\n";

    //$url = "https://api.telegram.org/bot" . $token . "/sendDocument?chat_id=" . $chatID;
    $url = "https://api.telegram.org/bot" . $token . "/sendDocument?chat_id=" . $chatID;
	//CURLOPT_POSTFIELDS		=>array('document'=>$attachment)

    //$url = $url . "&document=" . urlencode($attachment);
    $ch = curl_init();
    
    $file = tempnam(sys_get_temp_dir(), 'POST');
    echo $file;
	file_put_contents($file, $attachment);
    $pf['files']=curl_file_create('@'.$file,'application/pdf','document');
	//$curlfile = new CURLStringFile($attachment, 'application/pdf', 'report.pdf');
	//$curlfile = new CURLFile('@'.$attachment, 'application/pdf', 'report.pdf');
	//CURLOPT_POSTFIELDS     	=>array('file' =>$curlfile),
    $optArray = array(
						CURLOPT_URL => $url,
						CURLOPT_RETURNTRANSFER 	=> true,
						CURLOPT_POST           	=> true,
						CURLOPT_UPLOAD			=> true,
						CURLOPT_HTTPHEADER	   	=>array('Content-Type: multipart/form-data'),
						CURLOPT_POSTFIELDS     	=>$pf,
					);
					
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


?>
