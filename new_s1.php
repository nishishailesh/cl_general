<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
		  
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';
		  	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

main_menu();

if($_POST['action']=='direct')
{
	get_data_specific($link);
}


elseif($_POST['action']=='insert')
{
	$sample_id_array=save_insert_specific($link);
	if(count($sample_id_array)==0){echo '<h3>No sample required // Nothing to be done</h3>';}
	foreach($sample_id_array as $sample_id)
	{
		view_sample($link,$sample_id);
	}
}


function get_data_specific($link)
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
	
		echo '<div id=basic class="tab-pane active">';
			get_basic_specific();
			get_one_field_for_insert($link,1002);
			get_one_field_for_insert($link,1004);
			get_one_field_for_insert($link,1005);
			get_one_field_for_insert($link,1006);
			get_one_field_for_insert($link,1017);
			get_one_field_for_insert($link,1018);
			//get_one_field_for_insert($link,84);
		echo '</div>';	
		get_examination_data($link);
		get_profile_data($link);
	echo '</div>';

	echo '</form>';			
}


function get_basic_specific()
{
	$YY=strftime("%y");

echo '<div class="basic_form">';
	echo '	<label class="my_label text-danger" for="mrd">MRD</label>
			<input size=13 id=mrd name=\'__ex__'.$GLOBALS['mrd'].'\' class="form-control text-danger" required="required" type=text pattern="SUR/[0-9][0-9]/[0-9]{8}" placeholder="MRD" value="SUR/'.$YY.'/"\>
			<p class="help"><span class=text-danger>Must have</span> 8 digit after SUR/YY/</p>';			
echo '</div>';
}

function get_one_field_for_insert($link,$examination_id)
{
	$examination_details=get_one_examination_details($link,$examination_id);
	$edit_specification=json_decode($examination_details['edit_specification'],true);
	if(!$edit_specification){$edit_specification=array();}

		$result='';
		
	$type=isset($edit_specification['type'])?$edit_specification['type']:'text';
	$readonly=isset($edit_specification['readonly'])?$edit_specification['readonly']:'';
	$help=isset($edit_specification['help'])?$edit_specification['help']:'';
	$pattern=isset($edit_specification['pattern'])?$edit_specification['pattern']:'';
	$placeholder=isset($edit_specification['placeholder'])?$edit_specification['placeholder']:'';
	
	$element_id='r_id_'.$examination_id;

	if($type=='yesno')
	{
				//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
					echo '
							<button 
							
							id="'.$element_id.'" 
								name="__ex__'.$examination_id.'" 
								class="form-control btn btn-info mb-1"
								type=button
								>'.$result.'
					</button>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	}
	else if($type=='select')
	{
		$option=isset($edit_specification['option'])?explode(',',$edit_specification['option']):array();
		$option_html='';
		
		foreach($option as $v)
		{
				$option_html=$option_html.'<option>'.$v.'</option>';
		}
		
				//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block  no-gutters">';	
				
			echo '
					<select  
					id="'.$element_id.'" 
						name="__ex__'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						
						
						class="form-control">'.$option_html.'</select>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	}
	
	elseif($type=='number')
	{
		$step=isset($edit_specification['step'])?$edit_specification['step']:1;
		
				//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block  no-gutters">';	
				
			echo '
					<input 
						
					id="'.$element_id.'" 
						name="__ex__'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						
						
						class="form-control" 
						type=\''.$type.'\' 
						step=\''.$step.'\' 
						>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	}
	elseif($type=='date' || $type=='time')
	{
		//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block  no-gutters">';			
			echo '
						<input 
						
					id="'.$element_id.'" 
						name="__ex__'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						
						class="form-control" 
						type=\''.$type.'\' 
						>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	}
	elseif($type=='datetime-local')
	{
		$step=isset($edit_specification['step'])?$edit_specification['step']:1;
		//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block  no-gutters">';
			echo '
						<input 
						
					id="'.$element_id.'" 
						name="__ex__'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						
					pattern="'.$pattern.'" 
						class="form-control autosave" 
						type=\''.$type.'\' 
						>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	}
	elseif($type=='dw')
	{
		//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block no-gutters">';
				
					echo '<textarea rows=1
					
					id="'.$element_id.'" 
					name="__ex__'.$examination_id.'" 
					data-exid="'.$examination_id.'" 
					
					pattern="'.$pattern.'" 
					class="form-control p-0 m-0 no-gutters" 
					type=\''.$type.'\' ></textarea>';
					
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	} 

	elseif($type=='json')
	{
		//////
		
		$json=isset($edit_specification['json'])?$edit_specification['json']:'';
		//$json_array=json_decode($json,true);
		//$type=isset($edit_specification['type'])?$edit_specification['type']:'text';
				
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';
			////
			echo '<div class="m-0 p-0 no-gutters">';
				////
				echo '<div class="d-inline-block no-gutters">';
					//print_r($json_array);
					echo '<pre>';print_r($edit_specification['json']);echo '</pre>';
					echo '<textarea rows=1
					
					id="'.$element_id.'" 
					name="__ex__'.$examination_id.'" 
					data-exid="'.$examination_id.'" 
					
					pattern="'.$pattern.'" 
					class="form-control autosave p-0 m-0 no-gutters" 
					type=\''.$type.'\' ></textarea>';
				echo '</div>';
				echo '<div class="d-inline  no-gutters">';
					//get_primary_result($link,$sample_id,$examination_id);
				echo '</div>';
			echo '</div>';
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	} 			
	else  
	{
		//////
		echo '<div class="basic_form  m-0 p-0 no-gutters">';
			////
				echo '<div  class="my_lable">';
					echo $examination_details['name'];
				echo '</div>';
			////
				echo '<div class="m-0 p-0 no-gutters">';
					////
					echo '<div class="d-inline-block no-gutters">';
					echo '<textarea rows=1
						
						id="'.$element_id.'" 
						name="__ex__'.$examination_id.'" 
						data-exid="'.$examination_id.'" 
						
						pattern="'.$pattern.'" 
						class="form-control autosave p-0 m-0 no-gutters" 
						type=\''.$type.'\' ></textarea>';
					echo '</div>';
					echo '<div class="d-inline  no-gutters">';
						//get_primary_result($link,$sample_id,$examination_id);
					echo '</div>';
				echo '</div>';
			////
			echo '<p class="help">'.$help.'</p>';	
		echo '</div>';
	} 
}


function save_insert_specific($link)
{
			//find list of examinations requested
			//determine sample-type required
			//find sample_id to be given
			//insert all examinations/non-examinations in result table
			
	//find list of examinations requested//////////////////////////////
	$requested=array();
	$ex_requested=array_filter(explode(',',$_POST['list_of_selected_examination']));
	$requested=$requested+$ex_requested;
	//echo '<pre>following is requested:<br>';print_r($requested);echo '</pre>';
	
	$profile_requested=explode(',',$_POST['list_of_selected_profile']);
	foreach($profile_requested as $value)
	{
		$psql='select * from profile where profile_id=\''.$value.'\'';
		$result=run_query($link,$GLOBALS['database'],$psql);
		$ar=get_single_row($result);
		$profile_ex_requested_main=explode(',',$ar['examination_id_list']);
		
		$profile_ex_requested=$profile_ex_requested_main;
		$requested=array_merge($requested,$profile_ex_requested);
	}

	$with_result=array();
	foreach($_POST as $k=>$v)
	{
		$tok=explode('__',$k);
		if(isset($tok[1])=='ex')
		{
			$with_result_id=$tok[2];
			//echo $tok[2].'<br>';
			$with_result[]=$tok[2];
		}
	}
	$requested=array_merge($requested,$with_result);
	$requested=array_filter(array_unique($requested));
//1	
	//echo '<pre>following is requested:<br>';print_r($requested);echo '</pre>';

	//determine sample-type required for each and also distinct types////////////////////////////////////
	$sample_required=array();
	//echo '<pre>following samples are required:<br>';print_r($sample_required);echo '</pre>';
	$stype_for_each_requested=array();
	
	foreach($requested as $ex)
	{
		$psql='select sample_requirement from examination where examination_id=\''.$ex.'\'';
		//echo $psql.'<br>';
		$result=run_query($link,$GLOBALS['database'],$psql);
		$ar=get_single_row($result);
		$sample_required[]=$ar['sample_requirement'];
		$stype_for_each_requested[$ex]=$ar['sample_requirement'];
		//echo '<pre>following samples are required:<br>';print_r($sample_required);echo '</pre>';
	}

//2	
	//echo '<pre>following are sample_requirements for each:<br>';print_r($stype_for_each_requested);echo '</pre>';
	//echo '<pre>following samples are required:<br>';print_r($sample_required);echo '</pre>';
	
	$sample_required=array_unique($sample_required);
//3	
	//echo '<pre>following samples are required:<br>';print_r($sample_required);echo '</pre>';
	
	//determine sample_id to be given/////////////////////////////////
	$sample_id_array=set_sample_id($link,$sample_required);
//4	
	//echo '<pre>following samples ids are alloted:<br>';print_r($sample_id_array);echo '</pre>';

//insert examinations////////////////////////////////////////////
	
	foreach($sample_id_array as $stype=>$sid)
	{
		foreach($stype_for_each_requested as $ex=>$exreq)
		{
			//echo $ex.'<br>';
			if($stype==$exreq)
			{
				if($ex<100000)
				{
					if(array_key_exists('__ex__'.$ex,$_POST))
					{
						//echo $_POST['__ex__'.$ex].'<br>';
						insert_one_examination_with_result($link,$sid,$ex,$_POST['__ex__'.$ex]);
					}
					else
					{					
						insert_one_examination_without_result($link,$sid,$ex);
					}
				}
				else
				{
					insert_one_examination_blob_without_result($link,$sid,$ex);
				}
			}
			if($exreq=='None')
			{
				////echo '__ex__'.$ex.'<br>';
					//if($ex==$GLOBALS['mrd'])
					//{
						//insert_one_examination_with_result($link,$sid,$ex,$_POST['mrd']);
					//}

					if(array_key_exists('__ex__'.$ex,$_POST))
					{
						//echo $_POST['__ex__'.$ex].'<br>';
						insert_one_examination_with_result($link,$sid,$ex,$_POST['__ex__'.$ex]);
					}
					elseif($ex==$GLOBALS['sample_requirement'])
					{
						//already inserted during set_sample_id()
					}
					else
					{
						if($ex<100000)
						{
							insert_one_examination_without_result($link,$sid,$ex);
						}
						else
						{
							insert_one_examination_blob_without_result($link,$sid,$ex);
						}
					}
			}
		}
	}

	return $sample_id_array	;
}

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////Functions///////////////////////


?>
