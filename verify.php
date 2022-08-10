<?php

function verify_sample($link,$sample_id)
{
	//echo '<pre>';print_r($_POST);echo '</pre>';
	$ex_result_array=get_result_of_sample_in_array($link,$sample_id);
	//print_r($ex_result_array);
	$ret=0;
	foreach ($ex_result_array as $eid=>$eval)
	{
		$temp_ret=any_examination_id($link,$sample_id,$eid,$eval);
		if($ret==-1){$ret=-1;}else{$ret=$temp_ret;}

		if(function_exists('f_'.$eid))
		{
			$fun_name='f_'.$eid;
			$fun_name($link,$sample_id,$eid);
		} 
	}
	return $ret;
}


function any_examination_id($link,$sample_id,$eid,$eval)
{
	$examination_details=get_one_examination_details($link,$eid);

	if(strlen($eval)==0)
	{
		echo '<span class="text-danger d-block">('.$eid.'-'.$examination_details['name'].') result is empty. [NOT OK]</span>';return -1;
	}

	if($GLOBALS['critical_autoinsert']=='yes')
	{
		$edit_specification=json_decode($examination_details['edit_specification'],true);

		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$cinterval_l=isset($edit_specification['cinterval_l'])?$edit_specification['cinterval_l']:'';
		$ainterval_l=isset($edit_specification['ainterval_l'])?$edit_specification['ainterval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		$cinterval_h=isset($edit_specification['cinterval_h'])?$edit_specification['cinterval_h']:'';
		$ainterval_h=isset($edit_specification['ainterval_h'])?$edit_specification['ainterval_h']:'';

		$alert=decide_alert($eval,$interval_l,$cinterval_l,$ainterval_l,$interval_h,$cinterval_h,$ainterval_h);
		if($alert==$GLOBALS['critical_low_message'] || $alert==$GLOBALS['critical_high_message'])
		{
			echo '<span class="text-danger d-block">('.$eid.'-'.$examination_details['name'].') result is critical.[Inform and update remark]</span>';

			//insert, or update(but actually donot change existing value)
			//upto user to decide what to write, email/Phone to_whom , date,time etc
			$cr=get_one_ex_result($link,$sample_id,$GLOBALS['Critical_Alert']);
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['Critical_Alert'],$cr);
		}
	}

}

//Plasma Glucose
function f_5031($link,$sample_id,$ex_id)
{
	echo 'Verification of examination_id=5031 (GLC, plasma) is under process........<br>';
	if($GLOBALS['plasma_glucose']!=$ex_id){echo '<span class="text-danger">Plasma Glucose code is not 5031. Not verified</span>';return;}
}

//serum Total Bilirubin
function f_5009($link,$sample_id,$ex_id)
{
	echo 'Verification of examination_id=5009 (TBIL, serum) is under process........<br>';
	if($GLOBALS['serum_TBIL']!=$ex_id){echo '<span class="text-danger">Serum TBIL code is not 5009. Not verified</span>';return;}
}

//serum direct bilirubin
function f_5010($link,$sample_id,$ex_id)
{
	echo 'Verification of examination_id=5010 (DBIL, serum)is under process........<br>';
	$ex_result_array=get_result_of_sample_in_array($link,$sample_id);
	
	//is examination id correct?
	if($GLOBALS['serum_DBIL']!=$ex_id){echo '<span class="text-danger">Serum DBIL code is not 5010. Not verified</span>';return;}
	
	//is it's result a number?
	if(!is_numeric($ex_result_array[$GLOBALS['serum_DBIL']]))
	{
		echo '<span class="text-danger">DBIL is not numeric. Not verified</span>';return;
	}
	else
	{
		echo '<span class="text-success d-block">DBIL is numeric. Going next step</span>';
	}
	
	//is tbil id correct?
	if($GLOBALS['serum_TBIL']!=5009){echo '<span class="text-danger">Serum TBIL code is not 5009. Not verified</span>';return;}
	
	
	if(isset($ex_result_array[$GLOBALS['serum_TBIL']]))
	{
		//is tbil result a number?
		echo 'TBIL is available...<br>';
		if(!is_numeric($ex_result_array[$GLOBALS['serum_TBIL']]))
		{
			echo '<span class="text-danger">TBIL is not numeric. TBIL - DBIL relations not verified</span>';
		}
		else
		{
			echo '<span class="text-success d-block">TBIL is numeric. Going next step</span>';				
			if(	$ex_result_array[$GLOBALS['serum_TBIL']] >= $ex_result_array[$GLOBALS['serum_DBIL']] )
			{
				echo '<span class="text-success">TBIL > DBIL [OK]</span>';
			}
			else
			{
				echo '<span class="text-danger">TBIL < DBIL [NOT OK], IBIL and Remarks updated, as applicable</span>';
				if($GLOBALS['serum_IBIL']!=5024)
				{
					echo '<span class="text-danger">Serum IBIL code is not 5024. IBIL Not updated</span>';
				}
				else
				{
					update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_IBIL'],'Not Calculated, See Remarks');
				}
				
				if($GLOBALS['Remark']!=5098)
				{
					echo '<span class="text-danger">Remark code is not 5098. Remark Not inserted / updated</span>';
				}
				else
				{
$remark=
'Analytical value of Total bilirubin is less than Direct Bilirubin.
Ignore if both are in reference range
Ignore if difference is <20%
Otherwise, Result may be considered absurd and repeat sample collection is advised';
					insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['Remark'],$remark);
				}				
				
			}
		}
	}	
}

function examination_id_verified($which_id,$required_id,$display_name)
{
	if($required_id!=$which_id)
	{
		echo '<span class="text-danger">'.$display_name.' code provided ('.$which_id.') is not same as required code('.$required_id.').</span>';return false;
	}
	else
	{
		echo '<span class="text-success d-block">'.$display_name.' id is verified.</span>';return true;
		return true;
	}
}

function examination_result_numeric($result,$display_text)
{
	//echo '<span>Checking if result of '.$display_text.' is numeric</span>';
	if(!is_numeric($result))
	{
		echo '<span class="text-danger">'.$display_text.' result is not numeric.</span>';return false;
	}
	else
	{
		echo '<span class="text-success d-block">'.$display_text.' result is numeric.</span>';return true;
	}
	
	
}
//serum Total Cholesterol
function f_5015($link,$sample_id,$ex_id)
{
	echo '......Verification of examination_id=5015 (Cholesterol, serum).....<br>';
	if(!examination_id_verified($ex_id,$GLOBALS['serum_CHOL'],'serum cholesterol')){return false;}
	
	$ex_result_array=get_result_of_sample_in_array($link,$sample_id);
	if( !examination_result_numeric($ex_result_array[$GLOBALS['serum_CHOL']],'serum cholesterol')){return false;}
	
	$cho=$ex_result_array[$GLOBALS['serum_CHOL']];
	$tg=$ex_result_array[$GLOBALS['serum_TG']];
	if($cho>240)
	{
		echo '<span class="text-success d-block">Cholesterol is more than 240 mg/dL</span>';
		if($tg<400)
		{
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_HDL'],$ex_result_array[$GLOBALS['serum_HDL']]);
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_VLDL'],$ex_result_array[$GLOBALS['serum_VLDL']]);
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_LDL'],$ex_result_array[$GLOBALS['serum_LDL']]);
			echo '<span class="badge badge-danger d-inline">HDL, VLDL, LDL reflexly added</span><br>';

		}
		else
		{
			echo '<span class="text-success d-block">TG >400 mg/dL. LDL not reliable.</span>';
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_HDL'],'see LDL remark');
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_VLDL'],'see LDL remark');
			insert_update_one_examination_with_result($link,$sample_id,$GLOBALS['serum_LDL'],'TG>400, LDL unreliable, Homogeneous assay advised');
		}	
		return true;
	}
}

?>
