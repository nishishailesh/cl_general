<?php

function main_menu()
{
	echo '
		<form method=post class="form-group m-0 p-0">
	
	<div id=main_menu class="dropdown btn-group m-0 p-0">
			<input type=hidden name=session_name value=\''.session_name().'\'>
			<button class="btn btn-primary border-danger m-0 p-0" formaction=new_general.php type=submit name=action value=new_general>New</button>
			<button class="btn btn-primary border-danger m-0 p-0" formaction=view_database_id.php type=submit name=action value=get_dbid>View DbID</button>			
			<button class="btn btn-primary border-danger m-0 p-0" formaction=search.php type=submit name=action value=get_search_condition>Search</button>			
			<button class="btn btn-primary border-danger m-0 p-0" formaction=report.php type=submit name=action value=get_search_condition>Export</button>			
			<!--
			<button class="btn btn-primary dropdown-toggle m-0 p-0" type="button" data-toggle="dropdown">New</button>
			<div class="dropdown-menu m-0 p-0">		
					<button class="btn btn-secondary btn-block m-0 p-0" formaction=new_general.php type=submit name=action value=new_general>New (General)</button>
					<button class="btn btn-secondary btn-block m-0 p-0" formaction=new_opd.php type=submit name=action value=new_opd>New (OPD)</button>
			</div>
			-->
	</div>
		</form>
	';		
}


function mk_select_from_array($name, $select_array,$disabled='',$default='')
{	
	echo '<select  '.$disabled.' name=\''.$name.'\'>';
	foreach($select_array as $key=>$value)
	{
				//echo $default.'?'.$value;
		if($value==$default)
		{
			echo '<option  selected > '.$value.' </option>';
		}
		else
		{
			echo '<option > '.$value.' </option>';
		}
	}
	echo '</select>';	
	return TRUE;
}


function get_one_examination_details($link,$examination_id)
{
	$sql='select * from examination where examination_id=\''.$examination_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	return $ar=get_single_row($result);
}

function view_sample_table($link,$sample_id)
{
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<table class="table table-striped table-bordered">';
	echo '<tr>
			<td>Encounter ID</td>
			<td colspan=2>';
			sample_id_edit_button($sample_id);
			echo '</td></tr>';
	echo '<tr><th>Examination ID</th><th>Name</th><th>Result</th></tr>';
	while($ar=get_single_row($result))
	{
		//print_r($ar);
		$examination_details=get_one_examination_details($link,$ar['examination_id']);
		//print_r($examination_details);
		echo '	<tr><td>'.$examination_details['examination_id'].'</td>
				<td>'.$examination_details['name'].'</td>
				<td>'.$ar['result'].'</td></tr>';
	}
	
	$sql_blob='select * from result_blob where sample_id=\''.$sample_id.'\'';
	$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
	while($ar_blob=get_single_row($result_blob))
	{
		//print_r($ar);
		$examination_blob_details=get_one_examination_details($link,$ar_blob['examination_id']);
		//print_r($examination_details);
		echo '	<tr><td>'.$examination_blob_details['examination_id'].'</td>
				<td>'.$examination_blob_details['name'].'</td>
				<td>';
				echo_download_button_two_pk('result_blob','result',
									'sample_id',$sample_id,
									'examination_id',$examination_blob_details['examination_id'],
									$sample_id.'-'.$examination_blob_details['examination_id'].'-'.$ar_blob['fname'],
									round(strlen($ar_blob['result'])/1024,0));
				echo '</td></tr>';
	}	
		
	echo '</table>';
}

function echo_result_header()
{
	echo '<div class="basic_form">
			<div class=my_label >Examination</div>
			<div>Result</div>
			<div class=help>Ref. Intervals , Units (Method)</div>';
	echo '</div>';	
}

function view_sample($link,$sample_id)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	$profile_wise_ex_list=ex_to_profile($link,$ex_list);
	//echo '<pre>';
	//print_r($profile_wise_ex_list);
	//echo '</pre>';
	echo '<div class="basic_form">
			<div class=my_label >Database ID:'.$sample_id.'</div>
			<div>';
				sample_id_edit_button($sample_id);
				sample_id_view_button($sample_id);
			echo '</div>
			<div class=help>Unique Number to get this data</div>';
	echo '</div>';	
	
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		$div_id=$pinfo['name'].'_'.$sample_id;
		//echo '<h6 data-toggle="collapse" class=sh href=\'#'.$div_id.'\' >X</h6><div></div><div></div>';
		echo '<img src="img/show_hide.png" height=32 data-toggle="collapse" class=sh href=\'#'.$div_id.'\' ><div></div><div></div>';
		echo '<div class="collapse show" id=\''.$div_id.'\'>';
		echo '<h3>'.$pinfo['name'].'</h3><div></div><div></div>';
		if($pinfo['profile_id']>$GLOBALS['max_non_ex_profile'])
		{
			echo_result_header();
		}
		foreach($vp as $ex_id)
		{
			if($ex_id==$GLOBALS['mrd']){$readonly='readonly';}else{$readonly='';}
			
			view_field($link,$ex_id,$ex_list[$ex_id]);	
		}
		echo '</div>';
	}
	
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	//print_r($rblob);
	foreach($rblob as $kblob=>$vblob)
	{
		$sql_blob='select * from result_blob where sample_id=\''.$sample_id.'\' and examination_id=\''.$kblob.'\'';
		$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
		$ar_blob=get_single_row($result_blob);
	
		//print_r($ar);
		$examination_blob_details=get_one_examination_details($link,$kblob);
		
		//print_r($examination_details);
		echo '	<div class="basic_form">
	
				<div class=my_label>'.$examination_blob_details['name'].'</div>
				<div>';
				echo_download_button_two_pk('result_blob','result',
									'sample_id',$sample_id,
									'examination_id',$examination_blob_details['examination_id'],
									$sample_id.'-'.$examination_blob_details['examination_id'].'-'.$vblob
									);
				echo '</div>';
				echo '<div  class=help  >Current File:'.$ar_blob['fname'].'</div>
				</div>';
				
	}
	echo '<br><footer></footer>';	
}


function view_primary_sample($link,$sample_id)
{
	$ex_list=get_primary_result_of_sample_in_array($link,$sample_id);
	$profile_wise_ex_list=ex_to_profile($link,$ex_list);
	//echo '<pre>';
	//print_r($profile_wise_ex_list);
	//echo '</pre>';
	echo '<div class="basic_form">
			<div class=my_label >Database ID:'.$sample_id.'</div>
			<div>';
				sample_id_edit_button($sample_id);
				sample_id_view_button($sample_id);
			echo '</div>
			<div class=help>Unique Number to get this data</div>';
	echo '</div>';	
	
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		$div_id=$pinfo['name'].'_'.$sample_id;
		//echo '<h6 data-toggle="collapse" class=sh href=\'#'.$div_id.'\' >X</h6><div></div><div></div>';
		echo '<img src="img/show_hide.png" height=32 data-toggle="collapse" class=sh href=\'#'.$div_id.'\' ><div></div><div></div>';
		echo '<div class="collapse show" id=\''.$div_id.'\'>';
		echo '<h3>'.$pinfo['name'].'</h3><div></div><div></div>';
		if($pinfo['profile_id']>$GLOBALS['max_non_ex_profile'])
		{
			echo_result_header();
		}
		foreach($vp as $ex_id)
		{
			if($ex_id==$GLOBALS['mrd']){$readonly='readonly';}else{$readonly='';}
			
			view_field($link,$ex_id,$ex_list[$ex_id]);	
		}
		echo '</div>';
	}
	
	echo '<br><footer></footer>';	
}


function view_sample_no_profile($link,$sample_id)
{
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<div class="basic_form">';
	echo '	<div class="my_label border border-dark">ID</div>
			<div class=" border border-dark">';
			sample_id_edit_button($sample_id);
			echo '</div>
			<div class="help border border-dark">Click on ID number (green button) to edit</div>';
			
	echo '<div class="my_label border border-info  data_header">Name</div>
	<div class=" border border-info  data_header">Data</div>
	<div class="help  border border-info  data_header">Help</div>';
	while($ar=get_single_row($result))
	{
		//print_r($ar);
		$examination_details=get_one_examination_details($link,$ar['examination_id']);
		$edit_specification=json_decode($examination_details['edit_specification']);
		$h=isset($edit_specification->{'help'})?($edit_specification->{'help'}):'No help';
		//print_r($edit_specification);
		//print_r($examination_details);
		echo '	<div class="my_label border border-dark text-wrap">'.$examination_details['name'].'</div>
				<div class="border border-dark">'.$ar['result'].'</div>
				<div class="help border border-dark">'.($h).'</div>';
	}
	
	$sql_blob='select * from result_blob where sample_id=\''.$sample_id.'\'';
	$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
	while($ar_blob=get_single_row($result_blob))
	{
		//print_r($ar);
		$examination_blob_details=get_one_examination_details($link,$ar_blob['examination_id']);
		//print_r($examination_details);
		echo '	
				<div class=my_label>'.$examination_blob_details['name'].'</div>
				<div>';
				echo_download_button_two_pk('result_blob','result',
									'sample_id',$sample_id,
									'examination_id',$examination_blob_details['examination_id'],
									$sample_id.'-'.$examination_blob_details['examination_id'].'-'.$ar_blob['fname'],
									round(strlen($ar_blob['result'])/1024,0));
				echo '</div>';
				echo '<div  class=help  >Current File:'.$ar_blob['fname'].'</div>';
	}	
		
	echo '</div>';
}

function sample_id_edit_button($sample_id)
{
	echo '<div class="d-inline-block" ><form method=post action=edit_general.php class=print_hide>
	<button class="btn btn-success btn-sm" name=sample_id value=\''.$sample_id.'\' >'.$sample_id.'(Edit)</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=action value=edit_general>
	</form></div>';
}

function sample_id_view_button($sample_id)
{
	echo '<div class="d-inline-block" ><form method=post action=view_single.php class=print_hide>
	<button class="btn btn-success btn-sm" name=sample_id value=\''.$sample_id.'\' >'.$sample_id.'(View)</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=action value=view_single>
	</form></div>';
}

function echo_download_button_two_pk($table,$field,$primary_key,$primary_key_value,$primary_key2,$primary_key_value2,$postfix='')
{
	echo '<form method=post action=download2.php>
			<input type=hidden name=table value=\''.$table.'\'>
			<input type=hidden name=field value=\''.$field.'\' >
			<input type=hidden name=primary_key value=\''.$primary_key.'\'>
			<input type=hidden name=primary_key2 value=\''.$primary_key2.'\'>
			<input type=hidden name=fname_postfix value=\''.$postfix.'\'>
			<input type=hidden name=primary_key_value value=\''.$primary_key_value.'\'>
			<input type=hidden name=primary_key_value2 value=\''.$primary_key_value2.'\'>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			
			<button class="btn btn-info btn-block"  
			formtarget=_blank
			type=submit
			name=action
			value=download>Download</button>
		</form>';
}

function ex_to_profile($link,$ex_array)
{
	$sql='select * from profile';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ret=array();
	while($ar=get_single_row($result))
	{
		$ex_of_profile=explode(',',$ar['examination_id_list']);
		foreach($ex_of_profile as $v)
		{
			if(array_key_exists($v,$ex_array))
			{
				$ret[$ar['profile_id']][]=$v;
			}
		}
	}
	return $ret;
}

function edit_sample($link,$sample_id)
{
	$ex_list=get_result_of_sample_in_array($link,$sample_id);
	$profile_wise_ex_list=ex_to_profile($link,$ex_list);
	//echo '<pre>';
	//print_r($profile_wise_ex_list);
	//echo '</pre>';
	echo 
	'<div class="position-fixed bg-secondary ">
		<button 
		type=button
		class="btn btn-warning btn-sm"
		 data-toggle="collapse" 
		data-target="#advice" href="#advice">Paste-Bin</button>
		<div class="p-3 collapse" id="advice">';
		echo $GLOBALS['advice'];
		echo '</div>
	</div>';
		
	//echo '<div class="basic_form">
			//<div class=my_label >Edit ID</div>
			//<div>'.$sample_id.'</div>
			//<div class=help>Unique Number to get this data</div>';	
	//echo '</div>';
	echo '<div class="basic_form">
			<div class=my_label >Database ID:'.$sample_id.'</div>
			<div>';
				sample_id_edit_button($sample_id);
				sample_id_view_button($sample_id);
				echo '<button class="btn btn-sm btn-warning" onclick="sync_all()">Sync All</button>';
			echo '</div>
			<div class=help>Unique Number to get this data</div>';
	echo '</div>';	
	
	foreach($profile_wise_ex_list as $kp=>$vp)
	{
		$pinfo=get_profile_info($link,$kp);
		echo '<h3>'.$pinfo['name'].'</h3><div></div><div></div>';
		foreach($vp as $ex_id)
		{
			if($ex_id==$GLOBALS['mrd']){$readonly='readonly';}else{$readonly='';}
			edit_field($link,$ex_id,$ex_list,$sample_id,$readonly);	
		}
	}
	
	$rblob=get_result_blob_of_sample_in_array($link,$sample_id);
	
	foreach($rblob as $kblob=>$vblob)
	{
		edit_blob_field($link,$kblob,$rblob,$sample_id);	
	}
    add_get_data($link,$sample_id);
   
}

function get_result_of_sample_in_array($link,$sample_id)
{
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$result_array=array();
	while($ar=get_single_row($result))
	{
		$result_array[$ar['examination_id']]=$ar['result'];
	}
	//print_r($result_array);
	return $result_array;
}

function get_primary_result_of_sample_in_array($link,$sample_id)
{
	$sql='select * from primary_result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$result_array=array();
	while($ar=get_single_row($result))
	{
		$result_array[$ar['examination_id']]=$ar['result'];
	}
	//print_r($result_array);
	return $result_array;
}

function get_result_blob_of_sample_in_array($link,$sample_id)
{
	$sql='select * from result_blob where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$result_array=array();
	while($ar=get_single_row($result))
	{
		$result_array[$ar['examination_id']]=$ar['fname'];	//no blob as result
	}
	//print_r($result_array);
	return $result_array;
}
function edit_basic($link,$result_array)
{
	if(array_key_exists('1',$result_array)){$mrd=$result_array['1'];}else{$mrd='';}
	
	echo '<div id=basic class="tab-pane active">';
	echo '<div class="basic_form">';
		echo '	<label class="my_label text-danger" for="mrd">MRD</label>
				<input size=13 id=mrd name=mrd class="form-control text-danger" 
				required="required" type=text pattern="SUR/[0-9][0-9]/[0-9]{8}" placeholder="MRD"
				value=\''.$mrd.'\'>
				<p class="help"><span class=text-danger>Must have</span> 8 digit after SUR/YY/</p>';			
	echo '</div>';
	echo '</div>';
}
function delete_examination($link,$sample_id,$examination_id)
{
	if($examination_id>=100001)
	{
		$sql='DELETE FROM `result_blob`
          WHERE `sample_id` = \''.$sample_id.'\' AND `examination_id` = \''.$examination_id.'\'';
	}
	else{
		$sql='DELETE FROM `result`
          WHERE `sample_id` = \''.$sample_id.'\' AND `examination_id` = \''.$examination_id.'\'';
	    }
		$result=run_query($link,$GLOBALS['database'],$sql);
		//echo $sql;
		if($result==false)
			{
					echo '<h3 style="color:green;"> record not Deleted</h3>';
			}
			else
			{
					echo '<h3 style="color:green;"> 1 record  Deleted</h3>';
			}
		
     edit_sample($link,$sample_id);     
}

function get_primary_result($link,$sample_id,$examination_id)
{
	$sql='select * from primary_result where sample_id=\''.$sample_id.'\' and examination_id=\''.$examination_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$result_array=array();
	
	$values='';
	while($ar=get_single_row($result))
	{
		//$values=$values.$ar['result'].',';
		$element_id='pr_id_'.$sample_id.'_'.$examination_id;
		echo '<button onclick="sync_result(this)"
					class="btn btn-sm btn-outline-dark  no-gutters align-top"
					id=\''.$element_id.'\' 
					data-sid=\''.$sample_id.'\' 
					data-exid=\''.$examination_id.'\' 
					value=\''.$ar['result'].'\' >'.$ar['result'].'</button>';
	}
	//return $values;
}

function edit_field($link,$examination_id,$result_array,$sample_id,$readonly='')
{
	if(array_key_exists($examination_id,$result_array)){$result=$result_array[$examination_id];}else{$result='';}
	$examination_details=get_one_examination_details($link,$examination_id);
	$edit_specification=json_decode($examination_details['edit_specification'],true);
	if(!$edit_specification){$edit_specification=array();}
	
	$type=isset($edit_specification['type'])?$edit_specification['type']:'text';
	$help=isset($edit_specification['help'])?$edit_specification['help']:'No help';
	$pattern=isset($edit_specification['pattern'])?$edit_specification['pattern']:'';
	$placeholder=isset($edit_specification['placeholder'])?$edit_specification['placeholder']:'';
	
	$element_id='r_id_'.$sample_id.'_'.$examination_id;
	if($type=='yesno')
	{
		echo '<div class="basic_form  no-gutters">';
		set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '
					<button 
						'.$readonly.'
						id="'.$examination_details['name'].'" 
						name="'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						data-sid="'.$sample_id.'" 
						data-user="'.$_SESSION['login'].'" 
						class="form-control btn btn-info mb-1 autosave-yesno"
						value=\''.$result.'\'
						type=button
						>'.$result.'</button>
					<p class="help">'.$help.'</p>';
		echo '</div>';
	}
	else if($type=='select')
	{
		$option=isset($edit_specification['option'])?explode(',',$edit_specification['option']):array();
		$option_html='';
		
		foreach($option as $v)
		{
			if($v==$result)
			{
				$option_html=$option_html.'<option selected>'.$v.'</option>';
			}
			else
			{
				$option_html=$option_html.'<option>'.$v.'</option>';
			}
		}
		
		echo '<div class="basic_form">';
		set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '
					<select '.$readonly.' 
						id="'.$examination_details['name'].'" 
						name="'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						data-sid="'.$sample_id.'" 
						data-user="'.$_SESSION['login'].'" 
						class="form-control autosave-select">'.$option_html.'</select>
					<p class="help">'.$help.'</p>';
		echo '</div>';
	}
	
	elseif($type=='number')
	{
		$step=isset($edit_specification['step'])?$edit_specification['step']:1;
		echo '<div class="basic_form">';
		set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '
					<input 
						'.$readonly.'
						id="'.$examination_details['name'].'" 
						name="'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						data-sid="'.$sample_id.'" 
						data-user="'.$_SESSION['login'].'" 
						class="form-control autosave" 
						type=\''.$type.'\' 
						step=\''.$step.'\' 
						value=\''.$result.'\'>
					<p class="help">'.$help.'</p>';
		echo '</div>';
	}
	elseif($type=='date')
	{
		$step=isset($edit_specification['step'])?$edit_specification['step']:1;
		echo '<div class="basic_form">';
		set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '
						<input 
						'.$readonly.'
						id="'.$examination_details['name'].'" 
						name="'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						data-sid="'.$sample_id.'" 
						data-user="'.$_SESSION['login'].'" 
						class="form-control autosave" 
						type=\''.$type.'\' 
						value=\''.$result.'\'>
					<p class="help">'.$help.'</p>';
		echo '</div>';
	}
	elseif($type=='datetime-local')
	{
		$step=isset($edit_specification['step'])?$edit_specification['step']:1;
		echo '<div class="basic_form">';
		set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '
						<input 
						'.$readonly.'
						id="'.$examination_details['name'].'" 
						name="'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						data-sid="'.$sample_id.'" 
						data-user="'.$_SESSION['login'].'" 
						class="form-control autosave" 
						type=\''.$type.'\' 
						value=\''.$result.'\'>
					<p class="help">'.$help.'</p>';
		echo '</div>';
	}		
	else  
	{
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
			echo '<div class="m-0 p-0 no-gutters">';
				echo '<div class="d-inline-block  no-gutters">';
				echo '<textarea rows=1
					'.$readonly.'
					id="'.$element_id.'" 
					name="'.$examination_id.'" 
					data-exid="'.$examination_id.'" 
					data-sid="'.$sample_id.'" 
					data-user="'.$_SESSION['login'].'" 
					pattern=\'"'.$pattern.'\'" 
					class="form-control autosave p-0 m-0 no-gutters" 
					type=\''.$type.'\' >'.
					htmlspecialchars($result,ENT_QUOTES).'</textarea>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	} 
}

function decide_alert($result,$interval)
{
	if(strlen($interval)==0){return '';}
	$is=explode('-',$interval);
	//100-1000-4000-11000-20000-200000
	if($result<$is[2])
	{
		if($result<$is[1])
		{
			if($result<$is[0])
			{
				return '<<<Absurd Low>>>';
			}
			else
			{
				return '<<<Critical Low>>>';
			}
		}
		else
		{
			return '<<<Abnormal Low>>>';
		}
	}
	elseif($result>$is[3])
	{
		if($result>$is[4])
		{
			if($result>$is[5])
			{
				return '<<<Absurd High>>>';
			}
			else
			{
				return '<<<Critical High>>>';
			}
		}
		else
		{
			return '<<<Abnormal High>>>';
		}
	}
	else
	{
		return '';
	}	
}

function view_field($link,$ex_id,$ex_result)
{
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$help=isset($edit_specification['help'])?$edit_specification['help']:'No help';
		$interval=isset($edit_specification['interval'])?$edit_specification['interval']:'';
		
				echo '<div class="basic_form " id="ex_'.$ex_id.'">';
		echo '	<div class="my_label border border-dark text-wrap">'.$examination_details['name'].'</div>
				<div class="border border-dark"><pre class="m-0 p-0 border-0">'.htmlspecialchars($ex_result.' '.decide_alert($ex_result,$interval)).'</pre></div>
				<div class="help border border-dark">'.$help.'</div>';
				echo '</div>';
}				

function edit_blob_field($link,$examination_id,$result_array,$sample_id)
{
	//get examination details
	
	$examination_details=get_one_examination_details($link,$examination_id);
	//get result_blob details
	$sql_blob='select * from result_blob where sample_id=\''.$sample_id.'\' and examination_id=\''.$examination_id.'\' ';
	$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
	$ar_blob=get_single_row($result_blob);

	echo '<div class="basic_form">';
	set_lable($_POST['session_name'],$_POST['sample_id'],$examination_details,$examination_id);
	//echo '	<div class=my_label>'.$examination_details['name'].'</div>
	echo'<div>';	
	echo_download_button_two_pk('result_blob','result',
								'sample_id',$sample_id,
								'examination_id',$examination_details['examination_id'],
								$sample_id.'-'.$examination_details['examination_id'].'-'.$ar_blob['fname'],
								round(strlen($ar_blob['result'])/1024,0));
	
	echo_upload_two_pk($sample_id,$examination_id);							
	//echo
	echo '</div>';
	echo '<div  class=help  >Current File:'.$ar_blob['fname'].'</div>';
	echo '</div>';
}

function echo_upload_two_pk($sample_id,$examination_id)
{
	echo '<form method=post enctype="multipart/form-data">';
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=hidden readonly size=8  name=examination_id value=\''.$examination_id.'\'>';
	echo '<input type=hidden name=sample_id value=\''.$sample_id.'\'>';		
	echo '<input type=file name=fvalue >';
	echo '<button  class="btn btn-success" type=submit name=action value=upload>Upload</button>';
	echo'</form>';
}

function file_to_str($link,$file)
{
	if($file['size']>0)
	{
		$fd=fopen($file['tmp_name'],'r');
		$size=$file['size'];
		$str=fread($fd,$size);
		return my_safe_string($link,$str);
	}
	else
	{
		return false;
	}
}

function save_result_blob($link)
{
		$blob=file_to_str($link,$_FILES['fvalue']);
		if(strlen($blob)!=0)
		{
		$sql='update result_blob 
				set 
					fname=\''.$_FILES['fvalue']['name'].'\'	,
					result=\''.$blob.'\'	
				where 
					sample_id=\''.$_POST['sample_id'].'\' 
					and
					examination_id=\''.$_POST['examination_id'].'\'';
		
			if(!$result=run_query($link,$GLOBALS['database'],$sql))
			{
				echo '<br>Data not updated';
			}
			else
			{
				echo '<p>'.$_FILES['fvalue']['name'].' Saved</p>';				
			}	
		}
		else
		{
			echo '<p>0 size file. data not updated</p>';				
		}
}


function get_basic()
{
	$YY=strftime("%y");

echo '<div id=basic class="tab-pane active">';
echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="mrd">MRD</label>
			<input size=13 id=mrd name=mrd class="form-control text-danger" required="required" type=text pattern="SUR/[0-9][0-9]/[0-9]{8}" placeholder="MRD" value="SUR/'.$YY.'/"\>
			<p class="help"><span class=text-danger>Must have</span> 8 digit after SUR/YY/</p>';
/*			
	echo '	<label  class="my_label text-danger" for="name">Name</label>
			<input class="form-control text-danger" type=text required="required" pattern="[a-zA-Z\s]{2,}" id=name name=name placeholder=name>
			<p class="help"><span class=text-danger>Must have</span> atleast two characters</p>';

	echo '	<label  class="my_label" for="group_id">Request ID</label>
			<input class="form-control" type=text id=request_id name=request_id placeholder=request_id>
			<p class="help">Give single Request ID to all today\'s samples from this patient</p>';
*/
			
echo '</div>';
echo '</div>';	

}

function get_more_basic()
{

echo '<div id=more_basic class="tab-pane ">'; //donot mix basic_form(grid) with bootsrap class
echo '<div class="basic_form">';
	echo '	<label  class="my_label"  for="department">Department:</label>';
			mk_select_from_array('department',$GLOBALS['department']);
			echo '<p class="help">Select Department</p>';
			
	echo '	<label  class="my_label"  for="unit">Unit</label>';
			mk_select_from_array('unit',$GLOBALS['unit']);
			echo '<p class="help">Select Unit</p>';
			
	echo '	<label  class="my_label"  for="location3">Ward/OPD</label>
			<div class="form-control">
					<label class="radio-inline"><input type="radio" name="wardopd" value=OPD >OPD</label>
					<label class="radio-inline"><input type="radio" name="wardopd" value=Ward >Ward</label>
			</div>
			<p class="help">Ward/OPD</p>';
			
	echo '	<label  class="my_label"  for="ow_no">OPD/Ward No:</label>';
			mk_select_from_array('ow_no',$GLOBALS['ow_no']);
			echo '<p class="help">OPD/Ward Number</p>';

			
	echo '	<label  class="my_label" for="unique_id">AADHAR:</label>
			<input class="form-control" type=text id=unique_id name=unique_id placeholder=AADHAR>
			<p class="help">Full 12 Digit AADHAR number</p>';

	echo '	<label  class="my_label" for="unique_id">Mobile</label>
			<input class="form-control" type=text id=mobile name=mobile placeholder=Mobile>
			<p class="help">10 digit Mobile number</p>';
						
	echo '	<label  class="my_label" for="sex">Sex:</label>
			<select class="form-control" id=sex name=sex><option></option><option>M</option><option>F</option><option>O</option></select>
			<p class="help"> O for others</p>';
			
	echo '	<label   class="my_label" for="dob">DOB:</label>
			<input type=date id=dob name=dob>
			<p class="help">Approximate DOB</p>';

	echo '	<label  class="my_label" for="age">Age</label>
			<input class="form-control" type=text id=age name=age placeholder=Age>
			<p class="help">Write age in what ever way you like</p>';
			
	echo '	<label  class="my_label"  for="extra">Extra:</label>
			<input class="form-control" type=text id=extra name=extra placeholder=Extra>
			<p class="help">Any other extra details</p>';
echo '</div>';
echo '</div>';

}


function get_data($link)
{
	echo '<form method=post class="bg-light jumbotron">';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';

	echo '<ul class="nav nav-pills nav-justified">
			<li class="active" ><button class="btn btn-secondary" type=button data-toggle="tab" href="#basic">Basic</button></li>
			<li><button class="btn btn-secondary" type=button  data-toggle="tab" href="#examination">Examinations</button></li>
			<li><button class="btn btn-secondary" type=button  data-toggle="tab" href="#profile">Profiles</button></li>
			<li><button type=submit class="btn btn-primary form-control" name=action value=insert>Save</button></li>
		</ul>';
	echo '<div class="tab-content">';
		get_basic();
		get_examination_data($link);
		get_profile_data($link);
	echo '</div>';

	echo '</form>';			
}
function add_get_data($link,$sample_id)
{
		
	echo '<form method=post class="bg-light">';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
   echo '<input type=hidden name=sample_id value=\''.$sample_id.'\'>';
   echo'<div class="text-info"><h3>Insert New Fields</h3></div>';
	echo '<ul class="nav nav-pills nav-justified">
			<li><button class="btn btn-secondary" type=button  data-toggle="tab" href="#examination">Examinations</button></li>
			<li><button class="btn btn-secondary" type=button  data-toggle="tab" href="#profile">Profiles</button></li>
			<li><button type=submit class="btn btn-primary form-control" name=action value=insert>Save</button></li>
		</ul>';
	echo '<div class="tab-content">';
		get_examination_data($link);
		get_profile_data($link);
	echo '</div>';

	echo '</form>';			
}


function get_examination_data($link)
{
	$sql='select * from examination';
	$result=run_query($link,$GLOBALS['database'],$sql);
	echo '<div id=examination class="tab-pane">';
	echo '<div class="ex_profile">';
	while($ar=get_single_row($result))
	{
		my_on_off_ex($ar['name'],$ar['examination_id']);
	}
	echo '<input type=text name=list_of_selected_examination id=list_of_selected_examination>';
	echo '</div>';
	echo '</div>';
}

function get_profile_data($link)
{
	$sql='select * from profile';
	$result=run_query($link,$GLOBALS['database'],$sql);
	echo '<div id=profile  class="tab-pane">';
	echo '<div class="ex_profile">';
	while($ar=get_single_row($result))
	{
		my_on_off_profile($ar['name'],$ar['profile_id']);
	}
	echo '<input type=text name=list_of_selected_profile id=list_of_selected_profile>';
	echo '</div>';
	echo '</div>';
}

function get_profile_info($link,$profile_id)
{
	$sql='select * from profile where profile_id=\''.$profile_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}

function get_examination_blob_data($link)
{
	$sql='select * from examination where examination_id>10000';
	$result=run_query($link,$GLOBALS['database'],$sql);
	echo '<div id="examination_blob" class="tab-pane ">';
	while($ar=get_single_row($result))
	{
		my_on_off_ex_blob($ar['name'],$ar['examination_id']);
	}
	echo '<input type=text name=list_of_selected_examination_blob id=list_of_selected_examination_blob>';
	echo '</div>';
}

function my_on_off_ex($label,$id)
{
	
	echo '<button 
			class="btn btn-sm btn-outline-primary"
			type=button 
			onclick="select_examination_js(this, \''.$id.'\',\'list_of_selected_examination\')"
			>'.$label.'</button>';
}
function my_on_off_ex_blob($label,$id)
{
	
	echo '<button 
			class="btn btn-sm btn-outline-primary"
			type=button 
			onclick="select_examination_blob_js(this, \''.$id.'\',\'list_of_selected_examination_blob\')"
			>'.$label.'</button>';
}
function my_on_off_profile($label,$id)
{
	
	echo '<button 
			class="btn btn-sm btn-outline-primary"
			type=button 
			onclick="select_profile_js(this, \''.$id.'\',\'list_of_selected_profile\')"
			>'.$label.'</button>';
}

function save_insert($link)
{
	//find list of examinations requested//////////////////////////////
	$requested=array();
	$ex_requested=explode(',',$_POST['list_of_selected_examination']);
	$requested=array_merge($requested,$ex_requested);
	
	$profile_requested=explode(',',$_POST['list_of_selected_profile']);
	foreach($profile_requested as $value)
	{
		$psql='select * from profile where profile_id=\''.$value.'\'';
		$result=run_query($link,$GLOBALS['database'],$psql);
		$ar=get_single_row($result);
		$profile_ex_requested=explode(',',$ar['examination_id_list']);
		$requested=array_merge($requested,$profile_ex_requested);
	}

	$requested=array_filter(array_unique($requested));
	
//1	//must to link samples from single patients
	$sample_id=get_new_sample_id($link,$_POST['mrd']);

	//echo '<pre>following is requested:<br>';print_r($requested);echo '</pre>';
	foreach ($requested as $ex)
	{
			if($ex==$GLOBALS['mrd'])
			{
				//mrd inserted, do nothing
			}
			elseif($ex<100000)
			{
				insert_one_examination_without_result($link,$sample_id,$ex);
			}
			else  //blob as attachment 
			{
				insert_one_examination_blob_without_result($link,$sample_id,$ex);
			}
	}
	
	return $sample_id;
}
function add_new_examination_and_profile($link,$sample_id,$list_of_selected_examination='',$list_of_selected_profile='')
{
	
	$requested=array();
	$ex_requested=explode(',',$list_of_selected_examination);
	$requested=array_merge($requested,$ex_requested);
	
	$profile_requested=explode(',',$list_of_selected_profile);
	foreach($profile_requested as $value)
	{
		$psql='select * from profile where profile_id=\''.$value.'\'';
		$result=run_query($link,$GLOBALS['database'],$psql);
		$ar=get_single_row($result);
		$profile_ex_requested=explode(',',$ar['examination_id_list']);
		$requested=array_merge($requested,$profile_ex_requested);
	}

	$requested=array_filter(array_unique($requested));
	$list_of_selected_examination=$list_of_selected_examination;
	foreach ($requested as $ex_requested)
	{
			if($ex_requested==$GLOBALS['mrd'])
			{
				//mrd inserted, do nothing
			}
			elseif($ex_requested<100000)
			{
				insert_one_examination_without_result($link,$sample_id,$ex_requested);
			}
			else  //blob as attachment 
			{
				insert_one_examination_blob_without_result($link,$sample_id,$ex_requested);
			}
	}
}

function set_lable($session_name,$sample_id,$examination_details,$examination_id)
{
		echo '
			<div class="my_lable">';
			
		if($examination_details['examination_id']!=$GLOBALS['mrd'])
		{
		echo '
				<form method=post class="d-inline">
					<input type=hidden name=session_name value=\''.$session_name.'\'>
					<input type=hidden name=sample_id value=\''.$sample_id.'\'>
					<input type=hidden name=examination_id value=\''.$examination_id.'\'>
					
					<button type=submit  class="btn btn-danger btn-sm d-inline m-0 p-0" name=action value=delete title=Delete>X</button>	
				</form>
				';
		}
				
		echo '<label for="'.$examination_details['name'].'">'.$examination_details['name'].'</label>
			</div>';
	
}
function get_new_sample_id($link,$mrd)
{
	$sample_id=find_next_sample_id($link);
	$sql='insert into result (sample_id,examination_id,result,recording_time,recorded_by)
			values (\''.$sample_id.'\', \''.$GLOBALS['mrd'].'\',\''.$mrd.'\',now(),\''.$_SESSION['login'].'\')';
	if(!run_query($link,$GLOBALS['database'],$sql))
		{echo 'Data not inserted(with)<br>'; return false;}
	else
	{
		return $sample_id;
	}
}

function find_next_sample_id($link)
{
	$sqls='select ifnull(max(sample_id)+1,1) as next_sample_id from result';
	//echo $sqls;
	$results=run_query($link,$GLOBALS['database'],$sqls);
	$ars=get_single_row($results);
	return $ars['next_sample_id'];
}

function insert_one_examination_without_result($link,$sample_id,$examination_id)
{
	$sql='insert into result (sample_id,examination_id)
			values ("'.$sample_id.'","'.$examination_id.'")';
	//echo $sql.'(without)<br>';
	if(!run_query($link,$GLOBALS['database'],$sql))
	{
		//echo $sql.'(without)<br>';
		//echo 'Data not inserted(without)<br>'; 
		return false;
	}	else{return true;}
}

function insert_one_examination_blob_without_result($link,$sample_id,$examination_id)
{
	$sql='insert into result_blob (sample_id,examination_id)
			values ("'.$sample_id.'","'.$examination_id.'")';
	if(!run_query($link,$GLOBALS['database'],$sql))
	{	
		//echo $sql.'(without)<br>';
		//echo 'Data not inserted(without)<br>'; 
		return false;
	}
	else{return true;}
}

function echo_export_button($sample_id_csv)
{
	echo'<form method=post id=export_button action=export.php class="d-inline-block">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=sample_id value=\''.$sample_id_csv.'\'>
	<div class=print_hide><button type=submit class="btn btn-info  border-danger m-0 p-0" name=export>Export</button></div></form>';
}


function echo_report_export_button($sample_id_csv,$report_id)
{
	echo'<form method=post id=export_button action=export2.php class="d-inline-block">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=sample_id value=\''.$sample_id_csv.'\'>
	<input type=hidden name=report_id value=\''.$report_id.'\'>
	<div class=print_hide><button type=submit class="btn btn-info  border-danger m-0 p-0" name=export>Export</button></div></form>';
}

function echo_class_button($link,$class)
{
	$sql='select * from report where report_name=\''.$class.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	$ex_list=explode(',',$ar['examination_id']);
	$jarray=json_encode($ex_list);
	//echo $jarray;
	echo '<div class="d-inline-block "><div class=print_hide><button type=button class="btn btn-info d-inline-block border-danger m-0 p-0" onclick="set_print_class(\''.htmlspecialchars($jarray).'\')">'.$class.'</button></div></div>';
}



function get_search_condition($link)
{
	echo '<form method=post>';
	echo '<div class="basic_form">';
	get_examination_data($link);
	echo '</div>';
	echo '<button type=submit class="btn btn-primary form-control" name=action value=set_search>Set Search</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
}

function set_search($link)
{
	$ex_requested=explode(',',$_POST['list_of_selected_examination']);
	//print_r($ex_requested);
	echo '<form method=post>';
		foreach($ex_requested as $v)
		{
			$examination_details=get_one_examination_details($link,$v);
			echo '<div class="basic_form">';
			echo '	<label class="my_label" for="'.$examination_details['name'].'">'.$examination_details['name'].'</label>
					<input 
						id="'.$examination_details['name'].'" 
						name="'.$examination_details['examination_id'].'" 
						data-exid="'.$examination_details['examination_id'].'" 
						class="form-control" >
					<p class="help">Enter details for search</p>';
			echo '</div>';
		}
	echo '<button type=submit class="btn btn-primary form-control" name=action value=search>Search</button>';
	echo '<input type=hidden name=session_name value=\''.session_name().'\'>';
	echo '</form>';
}

function prepare_search_array($link)
{
	$ret=array();
	foreach($_POST as $k=>$v)
	{
		if(is_int($k) && strlen($v)>0)
		{
			$ret[$k]=$v;
		}
	}	
	return $ret;
}

function get_sample_with_condition($link,$exid,$ex_result,$sid_array=array(),$first=FALSE)
{
	$ret=array();
	
	if($first===TRUE)
	{
		$sql='select sample_id from result 
				where 
					examination_id=\''.$exid.'\' and 
					result like \'%'.$ex_result.'%\' ';
		//echo $sql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$sql);
		while($ar=get_single_row($result))
		{
			$ret[]=$ar['sample_id'];
		}
		return $ret;
	}
	
	//else do as follows
	foreach($sid_array as $v)
	{
		$sql='select sample_id from result 
				where 
					examination_id=\''.$exid.'\' and 
					result like \'%'.$ex_result.'%\' and
					sample_id=\''.$v.'\'';
		//echo $sql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$sql);
		if(get_row_count($result)>0)
		{
			$ret[]=$v;
		}
	}
	return $ret;
}

?>
