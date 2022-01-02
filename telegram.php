<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

	////////User code below/////////////////////
require_once('tcpdf/tcpdf.php');

echo '            <link rel="stylesheet" href="project_common.css">
				<script src="project_common.js"></script>';  
                  
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);
insert_sample_id_link($link,$_POST['sample_id']);
ob_start();

view_sample_telegram($link,$_POST['sample_id']);
echo "\nDetailed PDF:\n";
make_link($link,$_POST['sample_id']);

$x = ob_get_contents();
ob_end_clean();

//echo $x;

$token = $GLOBALS['_telegram_token_'];

$chatid = $GLOBALS['_telegram_chatid_'];

sendMessage($chatid, $x, $token);
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

function view_sample_telegram($link,$sample_id)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	//print_r($ex_list);
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	//print_r($rblob);
	$result_plus_blob_requested=$ex_list+$rblob;
	//print_r($result_plus_blob_requested);

	$profile_wise_ex_list=ex_to_profile($link,$result_plus_blob_requested);

	if(count($result_plus_blob_requested)!=0)
	{
		$sr=get_one_ex_result($link,$sample_id,$GLOBALS['sample_requirement']);
		//echo $sr;
		$sr_array=explode('-',$sr);
		//print_r($sr_array);
		$header=$GLOBALS[$sr_array[2]];
		//echo "<b>".$header["name"]."</b>\n";
		//echo "<b>".$header["section"]."</b>\n";
		//echo "<b>".$header["address"]."</b>\n";
		//echo "<b>".$header["phone"]."</b>\n";
		//echo "\n================\n";
		echo "<b>Sample_ID:<u>".$sample_id."</u></b>";
		//echo "\n================\n";
	}

	
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		echo "\n<code>".str_pad($pinfo['name'],25,'-')."</code>\n";
		$profile_edit_specification=json_decode($pinfo['edit_specification'],true);
		$print_style=isset($profile_edit_specification['print_style'])?$profile_edit_specification['print_style']:'';		
		foreach($vp as $ex_id)
		{
			
			$examination_details=get_one_examination_details($link,$ex_id);
			$edit_specification=json_decode($examination_details['edit_specification'],true);
			$img=isset($edit_specification['img'])?$edit_specification['img']:'';
			$type=isset($edit_specification['type'])?$edit_specification['type']:'';
			if($print_style=='horizontal')
			{					
				if($type!='blob')
				{
					view_field_telegram_horizontal($link,$ex_id,$ex_list[$ex_id]);	
				}
			}
			else
			{					
				if($type!='blob')
				{
					view_field_telegram($link,$ex_id,$ex_list[$ex_id]);	
				}
			}
		}
	}
}



function view_field_telegram($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'';
		$type=isset($edit_specification['type'])?$edit_specification['type']:'';
		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$cinterval_l=isset($edit_specification['cinterval_l'])?$edit_specification['cinterval_l']:'';
		$ainterval_l=isset($edit_specification['ainterval_l'])?$edit_specification['ainterval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		$cinterval_h=isset($edit_specification['cinterval_h'])?$edit_specification['cinterval_h']:'';
		$ainterval_h=isset($edit_specification['ainterval_h'])?$edit_specification['ainterval_h']:'';
		$img=isset($edit_specification['img'])?$edit_specification['img']:'';
			echo "<b>".$examination_details["name"].": </b>".htmlspecialchars($ex_result)."\n";
}

function view_field_telegram_horizontal($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		echo "<b>".$examination_details["name"].": </b>".htmlspecialchars($ex_result)."\n";
}				





function view_sample_telegram_extra($link,$sample_id)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	//print_r($ex_list);
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	//print_r($rblob);
	$result_plus_blob_requested=$ex_list+$rblob;
	//print_r($result_plus_blob_requested);

	$profile_wise_ex_list=ex_to_profile($link,$result_plus_blob_requested);

	if(count($result_plus_blob_requested)!=0)
	{

	}

	
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		//echo "<code>".$pinfo['name']."-------</code>\n";
		$profile_edit_specification=json_decode($pinfo['edit_specification'],true);
		$print_style=isset($profile_edit_specification['print_style'])?$profile_edit_specification['print_style']:'';		
		foreach($vp as $ex_id)
		{
			
			$examination_details=get_one_examination_details($link,$ex_id);
			$edit_specification=json_decode($examination_details['edit_specification'],true);
			$img=isset($edit_specification['img'])?$edit_specification['img']:'';
			$type=isset($edit_specification['type'])?$edit_specification['type']:'';
			if($print_style=='horizontal')
			{					
				if($type!='blob')
				{
					view_field_telegram_horizontal_extra($link,$ex_id,$ex_list[$ex_id]);	
				}
			}
			else
			{					
				if($type!='blob')
				{
					view_field_telegram_extra($link,$ex_id,$ex_list[$ex_id]);	
				}
			}
		}
	}
}



function view_field_telegram_extra($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'';
		$type=isset($edit_specification['type'])?$edit_specification['type']:'';
		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$cinterval_l=isset($edit_specification['cinterval_l'])?$edit_specification['cinterval_l']:'';
		$ainterval_l=isset($edit_specification['ainterval_l'])?$edit_specification['ainterval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		$cinterval_h=isset($edit_specification['cinterval_h'])?$edit_specification['cinterval_h']:'';
		$ainterval_h=isset($edit_specification['ainterval_h'])?$edit_specification['ainterval_h']:'';
		$img=isset($edit_specification['img'])?$edit_specification['img']:'';
		echo "<b>".$examination_details["name"].":</b>".htmlspecialchars($help)."\n";
}

function view_field_telegram_horizontal_extra($link,$ex_id,$ex_result)
{

}				

/*
function view_sample_telegram($link,$sample_id)
{

	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	//print_r($ex_list);
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	//print_r($rblob);
	$result_plus_blob_requested=$ex_list+$rblob;
	//print_r($result_plus_blob_requested);

	$profile_wise_ex_list=ex_to_profile($link,$result_plus_blob_requested);

	if(count($result_plus_blob_requested)!=0)
	{
		$sr=get_one_ex_result($link,$sample_id,$GLOBALS['sample_requirement']);
		//echo $sr;
		$sr_array=explode('-',$sr);
		//print_r($sr_array);
		$header=$GLOBALS[$sr_array[2]];
		echo '**'.$header['name'].'**
		<b>'.$header['section'].'</b>
		<b>'.$header['address'].'</b>
		<b>'.$header['phone'].'</b>
		<hr>';
	
	
		echo '<div class="basic_form">
			<div class=my_label ><span class="badge badge-primary ">Sample ID</span>
			<span class="badge badge-info"><h5>'.$sample_id.'</h5></span></div>			<div>';
			show_all_buttons_for_sample($link,$sample_id);
			echo '</div>
			<div class="help print_hide">Unique Number to get this data</div>';
		echo '</div>';	
	}
	else
	{
		sample_id_prev_button($sample_id);
		sample_id_next_button($sample_id);
	}
	
	if(count($result_plus_blob_requested)==0)
	{
		echo '<h3>No such sample with sample_id='.$sample_id.'</h3>';
		return;
	}
		
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		$div_id=$pinfo['name'].'_'.$sample_id;
		echo '<img src="img/show_hide.png" height=32 data-toggle="collapse" class=sh href=\'#'.$div_id.'\' ><div></div><div></div>';
		echo '<div class="collapse show" id=\''.$div_id.'\'>';
		echo '<h3>'.$pinfo['name'].'</h3><div></div><div></div>';
		$profile_edit_specification=json_decode($pinfo['edit_specification'],true);
		$print_style=isset($profile_edit_specification['print_style'])?$profile_edit_specification['print_style']:'';		
	
		if($print_style=='horizontal')
		{
			echo '<div class=horiz>';
			foreach($vp as $ex_id)
			{
				$examination_details=get_one_examination_details($link,$ex_id);
				$edit_specification=json_decode($examination_details['edit_specification'],true);
				$img=isset($edit_specification['img'])?$edit_specification['img']:'';
				$type=isset($edit_specification['type'])?$edit_specification['type']:'';
				
				
				if($type!='blob')
				{
					view_field_hr($link,$ex_id,$ex_list[$ex_id]);	
				}
				else
				{
					view_field_blob_hr($link,$ex_id,$sample_id);
					if($img=='dw')
					{
						$ex_result=get_one_ex_result_blob($link,$sample_id,$ex_id);
						display_dw($ex_result,$examination_details['name']);
					}	
				}
			}
			echo '</div>';			
		}
		
		elseif($print_style=='vertical')
		{
			foreach($vp as $ex_id)
			{
				$examination_details=get_one_examination_details($link,$ex_id);
				$edit_specification=json_decode($examination_details['edit_specification'],true);
				$type=isset($edit_specification['type'])?$edit_specification['type']:'';					
				if($type!='blob')
				{
					view_field_vr($link,$ex_id,$ex_list[$ex_id]);	
				}
				else
				{
					view_field_blob_vr($link,$ex_id,$sample_id);	
				}
			}
		}
		
		else
		{
			echo_result_header();
		
			foreach($vp as $ex_id)
			{
				
				$examination_details=get_one_examination_details($link,$ex_id);
				$edit_specification=json_decode($examination_details['edit_specification'],true);
				$img=isset($edit_specification['img'])?$edit_specification['img']:'';
				$type=isset($edit_specification['type'])?$edit_specification['type']:'';
						
				if($type!='blob')
				{
					view_field($link,$ex_id,$ex_list[$ex_id]);	
				}
				else
				{
					view_field_blob($link,$ex_id,$sample_id);
					if($img=='dw')
					{
						$ex_result=get_one_ex_result_blob($link,$sample_id,$ex_id);
						display_dw($ex_result,$examination_details['name']);
					}
				}
			}
		}		
		echo '</div>';
	}
	
	echo '<br><footer></footer>';	
}
*/
//$output=$pdf->Output('report.pdf', 'S');

//$res=get_result_of_sample_in_array_with_ex_name($link,$_POST['sample_id']);
//$res_str='<pre>Sample_ID:'.$_POST['sample_id'].'</pre><pre>'.print_r($res,true).'</pre>';

//$res_str=strip_tags($x).'xx';
//$res_str='<pre>Sample_ID:'.$_POST['sample_id'].'</pre><pre>'.print_r($res,true).'</pre>';

?>
