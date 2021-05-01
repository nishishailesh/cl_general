<?php

//////////////Single Table Edit Commmon Functions///////////////////////

function show_manage_single_table_button($tname,$label='')
{
	if(strlen($label)==0){$label=$tname;}
	echo '<div class="d-inline-block" ><form method=post class=print_hide>
	<button class="btn btn-outline-primary btn-sm" name=tname value=\''.$tname.'\' >'.$label.'</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=action value=manage_single_table>
	</form></div>';
}

function show_crud_button($tname,$type,$label='')
{
	if(strlen($label)==0){$label=$type;}
	echo '<div class="d-inline-block" ><form method=post class=print_hide>
	<button class="btn btn-outline-primary btn-sm" name=action value=\''.$type.'\' >'.$label.'</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=tname value=\''.$tname.'\'>
	</form></div>';
}

function add($link,$tname)
{
	run_query($link,$GLOBALS['database'],'insert into `'.$tname.'` () values()');
	$id=last_autoincrement_insert($link);
	//edit($link,$tname,$id,$header='yes');
	echo '<table class="table table-striped table-sm table-bordered">';
		view_row($link,$tname,$id,'yes');
	echo '</table>';
}

function add_without_display($link,$tname)
{
	run_query($link,$GLOBALS['database'],'insert into `'.$tname.'` () values()');
	return $id=last_autoincrement_insert($link);
}

function view_row($link,$tname,$pk,$header='no')
{
	$sql='select * FROM `'.$tname.'` where id=\''.$pk.'\'';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	
	if($header=='yes')
	{
		echo '<tr>';
		foreach($ar as $k=>$v)
		{
			echo '<td>'.$k.'</td>';
		}
		echo '</tr>';
	}
	
	echo '<tr>';
	foreach($ar as $k =>$v)
	{
		if($k=='id')
		{
			echo '
			<td>';
		
				ste_id_edit_button($link,$tname,$v);
				ste_id_delete_button($link,$tname,$v);
			echo '<span class="round round-0 bg-warning" >'.$v.'</span></td>';
		}
		elseif(substr(get_field_type($link,$tname,$k),-4)=='blob')
		{
			echo '<td>';
				ste_view_field_blob($link,$tname,$k,$pk);
			echo '</td>';
		}
		else
		{
			echo '<td>'.$v.'</td>';
		}
	}
	echo '</tr>';
}

function get_field_type($link,$tname,$fname)
{
	$ar=get_field_details($link,$tname,$fname);
	return $ar['Type'];
}

function get_field_details($link,$tname,$fname)
{
	$sql='show columns from `'.$tname.'` where Field=\''.$fname.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return $ar=get_single_row($result);	
}

function ste_view_field_blob($link,$tname,$fname,$id)
{
		$sql_blob='select `'.$fname.'` from `'.$tname.'` where id=\''.$id.'\' ';
		$result_blob=run_query($link,$GLOBALS['database'],$sql_blob);
		$ar_blob=get_single_row($result_blob);
		
		echo '<div>';
			ste_echo_download_button($link,$tname,$fname,$id);
		echo '</div>';
				
}

function ste_echo_download_button($link,$tname,$fname,$id)
{
	echo '<form method=post action=ste_download.php class="d-inline" >
			<input type=hidden name=table value=\''.$tname.'\'>
			<input type=hidden name=field value=\''.$fname.'\' >
			<input type=hidden name=primary_key value=\''.$id.'\'>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			
			<button class="btn btn-info  btn-sm"  
			formtarget=_blank
			type=submit
			name=action
			value=download>Download</button>
		</form>';
}

function search($link,$tname)
{
	$sql='show columns from `'.$tname.'`';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$all_fields=array();
	while($ar=get_single_row($result))
	{	
		$all_fields[]=$ar;
	}
	
	echo '<form method=post>';
	echo '<table class="table table-striped table-sm table-bordered">';
	echo '<tr><td>Action</td>';
	foreach($all_fields as $field)
	{
		echo '<td>'.$field['Field'].'</td>';
	}
	echo '<td>Action</td>';
	echo '</tr>';
	
	echo '<tr>';
	
	echo '<td><button class="btn btn-info  btn-sm"  
		type=submit
		name=action
		value=and_select>and Search</button>';
	echo '<button class="btn btn-info  btn-sm"  
		type=submit
		name=action
		value=or_select>or Search</button></td>';
		
	foreach($all_fields as $field)
	{
		if(substr($field['Type'],-4)=='blob')
		{
			echo '<td>Blob</td>';
		}
		else
		{	
			echo '<td>';		
				//'yes' to ensure date dropdown is not displayed
				read_field($link,$tname,$field['Field'],'','yes');
				//echo '<td><input type=text name=\''.$field['Field'].'\'></td>';
			echo '</td>';		

		}
	}
	

	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
	echo '<input type=hidden name=tname value=\''.$tname.'\'>';

	echo '</tr>';
			
	echo '</table>';
	echo '</form>';
}

function select($link,$tname,$join='and')
{
	//echo '<pre>';print_r($_POST);echo '</pre>';	
	$sql='select id from `'.$tname.'` where ';
	$w='';
	foreach($_POST  as $k=>$v)
	{
		if(!in_array($k,array('action','tname','session_name')))
		{
			if(strlen($v)>0)
			{
    			$w=$w.' `'.$k.'` like \'%'.$v.'%\' '.$join.' ';
			}
		}
	}
	
	if(strlen($w)>0)
	{
		if($join=='and')
		{
			$w=substr($w,0,-4);
		}
		if($join=='or')
		{
			$w=substr($w,0,-3);
		}
		$sql=$sql.$w.' order by id desc ';
	}
	else
	{
		$sql='select id from `'.$tname.'` order by id desc limit '.$GLOBALS['all_records_limit'];
	}
	
	//echo $sql;
	
	$result=run_query($link,$GLOBALS['database'],$sql);
	$all_fields=array();
	$header='yes';
	echo '<table class="table table-striped table-sm table-bordered">';
	while($ar=get_single_row($result))
	{	
		view_row($link,$tname,$ar['id'],$header);
		$header='no';
	}		
	echo '</table>';
}


function ste_id_edit_button($link,$tname,$id)
{
	echo 
	'<div class="d-inline-block" >
		<form method=post>
			<button class="btn btn-outline-success btn-sm m-0 p-0" name=id value=\''.$id.'\' >
				<img class="m-0 p-0" src=img/edit.png alt=E width="15" height="15">
			</button>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			<input type=hidden name=action value=edit>
			<input type=hidden name=tname value=\''.$tname.'\'>
		</form>
	</div>';
}


function ste_id_delete_button($link,$tname,$id)
{
	echo 
	'<div class="d-inline-block" >
		<form method=post>
			<button class="btn btn-outline-success btn-sm m-0 p-0" 
				onclick="return confirm(\'R U Sure to delete ??\')"
				name=id value=\''.$id.'\' >
				<img class="m-0 p-0" src=img/delete.png alt=X width="15" height="15">
			</button>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			<input type=hidden name=action value=delete>
			<input type=hidden name=tname value=\''.$tname.'\'>
		</form>
	</div>';
}

function ste_id_update_button($link,$tname,$id)
{
	echo 
	'<div class="d-inline-block" >
		<form method=post>
			<button class="btn btn-outline-success btn-sm m-0 p-0" name=id value=\''.$id.'\' >update('.$id.')</button>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			<input type=hidden name=action value=update>
			<input type=hidden name=tname value=\''.$tname.'\'>
		</form>
	</div>';
}

function edit($link,$tname,$pk,$header='no')
{
	$sql='select * FROM `'.$tname.'` where id=\''.$pk.'\'';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<div class="two_column_one_by_two bg-light">';
			foreach($ar as $k =>$v)
			{
				if($k=='id')
				{
					echo '<div class="border">'.$k.'</div>';
					echo '<div class="border">';
						ste_id_update_button($link,$tname,$v);
					echo '</div>';
				}
				elseif(substr(get_field_type($link,$tname,$k),-4)=='blob')
				{
					echo '<div class="border">'.$k.'</div>';
					echo '<div class="border">';
						echo '<input type=file name=\''.$k.'\' >';
					echo '</div>';
				}
				elseif(in_array($k,array('recording_time','recorded_by')))
				{
					echo '<div class="border">'.$k.'</div>';
					echo '<div class="border">';
						echo $v;
					echo '</div>';
				}
				else
				{
					echo '<div class="border">'.$k.'</div>';
					echo '<div class="border">';
						read_field($link,$tname,$k,$v);
					echo '</div>';
				}
			}
			echo '</div>';
	echo'</form>';

}

function edit_old($link,$tname,$pk,$header='no')
{
	$sql='select * FROM `'.$tname.'` where id=\''.$pk.'\'';
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	$ar=get_single_row($result);
	
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
    echo '<div class="table-responsive">';
		echo '<table class="table table-striped table-sm table-bordered table-condensed">';
			if($header=='yes')
			{
				echo '<tr>';
				foreach($ar as $k=>$v)
				{
					echo '<td>'.$k.'</td>';
				}
				echo '</tr>';
			}
			
			echo '<tr>';
			foreach($ar as $k =>$v)
			{
				if($k=='id')
				{
					echo '<td>';
						ste_id_update_button($link,$tname,$v);
					echo '</td>';
				}
				elseif(substr(get_field_type($link,$tname,$k),-4)=='blob')
				{
					echo '<td>';
						echo '<input type=file name=\''.$k.'\' >';
					echo '</td>';
				}
				elseif(in_array($k,array('recording_time','recorded_by')))
				{
					echo '<td>'.$v.'</td>';
				}
				else
				{
					echo '<td>';		
						read_field($link,$tname,$k,$v);
					echo '</td>';
				}
			}
			echo '</tr>';
		echo '</table>';
	echo '</div>';
	echo'</form>';

}


function multiedit($link,$tname,$pk_ar,$header='no')
{
	$pk_csv='';
	foreach($pk_ar as $v)
	{
		$pk_csv=$pk_csv.'"'.$v.'"'.',';
	}
	$pk_csv=substr($pk_csv,0,-1);
	$sql='select * FROM `'.$tname.'` where id in ('.$pk_csv.')';
	//echo $sql;
	//return;
	//echo $sql;
	$result=run_query($link,$GLOBALS['database'],$sql);
	
	echo '<form method=post class="d-inline" enctype="multipart/form-data">';
	echo '<div class="table-responsive">';
	echo '<table class="table table-striped table-sm table-bordered table-condensed">';
	while($ar=get_single_row($result))
	{

				if($header=='yes')
				{
					echo '<tr>';
					foreach($ar as $k=>$v)
					{
						echo '<td>'.$k.'</td>';
					}
					echo '</tr>';
					$header='no';
				}
				
				echo '<tr>';
				foreach($ar as $k =>$v)
				{
					if($k=='id')
					{
						echo '<td>';
							echo '<input size=4 readonly type=text name=\'id_'.$v.'\' value=\''.$v.'\'>';
						echo '</td>';
					}
					elseif(substr(get_field_type($link,$tname,$k),-4)=='blob')
					{
						echo '<td>';
							echo '<input type=file name=\''.$k.'_'.$ar['id'].'\' >';
						echo '</td>';
					}
					elseif(in_array($k,array('recording_time','recorded_by')))
					{
						echo '<td>'.$v.'</td>';
					}
					else
					{
						echo '<td>';		
							read_field($link,$tname,$k.'_'.$ar['id'],$v);
						echo '</td>';
					}
				}
				echo '</tr>';

	}
	echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

	echo '<tr><td><input type=submit name=action value=save></td></tr>';
	echo '</table>';
	echo '</div>';	
	echo'</form>';
}

function get_field_spec($link,$tname,$fname)
{
	$sql='select * from table_field_specification  where tname=\''.$tname.'\' and fname=\''.$fname.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return $ar=get_single_row($result);	//return only first row, if mutiple, only forst one is returned
}

function read_field($link,$tname,$field,$value,$search='no')
{
	$ftype=get_field_details($link,$tname,$field);
	$fspec=get_field_spec($link,$tname,$field);
	//print_r($fspec);
	if($fspec)
	{
		if($fspec['ftype']=='table')
		{
			mk_select_from_sql($link,'select distinct `'.$fspec['field'].'` from `'.$fspec['table'].'`',
					$fspec['field'],$fspec['fname'],$fspec['fname'],'',$value,$blank='yes');
		}
		elseif($fspec['ftype']=='date')
		{
			if($search=='yes')
			{
				echo '<input type=text name=\''.$field.'\' value=\''.$value.'\'>';
			}
			else
			{
				echo '<input type=date id=\''.$field.'\' name=\''.$field.'\' value=\''.$value.'\'>';
				$default=strftime("%Y-%m-%d");
				show_source_button($field,$default);
			}
		}
		elseif($fspec['ftype']=='time')
		{
			if($search=='yes')
			{
				echo '<input type=text  name=\''.$field.'\' value=\''.$value.'\'>';
			}
			else
			{
				echo '<input type=time id=\''.$field.'\' name=\''.$field.'\' value=\''.$value.'\'>';
				$default=strftime("%H:%M");
				show_source_button($field,$default);
			}
		}				
		elseif($fspec['ftype']=='textarea')
		{
			echo '<textarea name=\''.$field.'\' >'.$value.'</textarea>';
		}	
		else
		{
			echo 'not implemented';
		}
	}
	else
	{
		echo '<input type=text name=\''.$field.'\' value=\''.htmlentities($value,ENT_QUOTES).'\'>';
	}
}

function update_one_field($link,$tname,$fname,$pk)
{
	if(strlen($_POST[$fname])==0)
	{
		$value=' NULL ';
	}
	else
	{
		$value=' \''.my_safe_string($link,$_POST[$fname]).'\' ';
	}
	//echo $fname.'<br>';
	update_one_field_with_value($link,$tname,$fname,$pk,$value);
}

function update_one_field_with_value($link,$tname,$fname,$pk,$value)
{
		$sql='update `'.$tname.'`
			set 
				`'.$fname.'` ='.$value.',
				recording_time=now(),
				recorded_by=\''.$_SESSION['login'].'\'
			where 
				id=\''.$pk.'\' ';
		//echo $sql;
	
	if(!$result=run_query($link,$GLOBALS['database'],$sql))
	{
		echo '<p>Data not updated</p>';
	}
	else
	{
		if(rows_affected($link)==1)
		{
			//echo '<p>Saved</p>';				
		}
		else
		{
			//echo '<p>Result need no update</p>';
		}
	}
}

function update_one_field_blob($link,$tname,$fname,$name_fname,$pk)
{
	$data=file_to_str($link,$_FILES[$fname]);
	if(strlen($data)==0){return;}
	$sql='update `'.$tname.'`
		set 
			`'.$fname.'` =\''.$data.'\',
			recording_time=now(),
			recorded_by=\''.$_SESSION['login'].'\'			
		where 
			id=\''.$pk.'\' ';

	if(!$result=run_query($link,$GLOBALS['database'],$sql))
	{
		echo '<p>Data not updated</p>';
	}
	else
	{
		if(rows_affected($link)==1)
		{
			//echo '<p>Saved</p>';
			update_one_field_with_value($link,$tname,$name_fname,$pk,'\''.$_FILES[$fname]['name'].'\'');				
		}
		else
		{
			//echo '<p>Result need no update</p>';
		}
	}
}

function update($link,$tname)
{
	foreach($_POST as $k=>$v)
	{
		if(!in_array($k,array('action','tname','session_name','id','recording_time','recorded_by')))
		{
			//echo $k.'#<br>';
			update_one_field($link,$tname,$k,$_POST['id']);
		}
	}
	foreach($_FILES as $k=>$v)
	{
		if(!in_array($k,array('action','tname','session_name','id','recording_time','recorded_by')))
		{
			update_one_field_blob($link,$tname,$k,$k.'_name',$_POST['id']);
		}
	}	
}

function list_available_tables($link)
{
	$sql_level='select distinct level from '.$GLOBALS['record_tables'].' order by level';
	$result_level=run_query($link,$GLOBALS['database'],$sql_level);
	echo '<h3>List of Available Tables</h3>';
	while($ar_level=get_single_row($result_level))
	{
		$sql='select * from '.$GLOBALS['record_tables'].' where level=\''.$ar_level['level'].'\'';
		$result=run_query($link,$GLOBALS['database'],$sql);

		while($ar=get_single_row($result))
		{
			//print_r($ar);
			show_manage_single_table_button($ar['table_name']);
		}
		echo '<hr>';
	}
}

function manage_stf($link,$post)
{
	if(isset($post['tname']))
	{
		echo '<div class="border border-dark m-2 p-2" >';
		echo '<h3>'.$post['tname'].': Choose any action below</h3>';
		$tname=$post['tname'];
		
		show_crud_button($tname,'add', 'Add Blank');
		show_crud_button($tname,'search');	//edit, remove inside it
		show_crud_button($tname,'list');	//edit, remove inside it
		echo '</div>';
	}

	//A done
	if($post['action']=='add')
	{
		echo '<h5>'.$post['action'].'</h5>';
		add($link,$post['tname']);
	}

	//B done
	elseif($post['action']=='edit')
	{
		echo '<h5>'.$post['action'].'</h5>';
		edit($link,$post['tname'],$post['id'],'yes');
		
		
	}

	//C done
	elseif($post['action']=='search')
	{
		echo '<h5>'.$post['action'].'</h5>';
		search($link,$post['tname']);
	}


	//1 no need, it is balnk insert -> view ->edit
	//elseif($post['action']=='insert')
	//{
	//	echo '<h5>'.$post['action'].'</h5>';
	//}

	//2
	if($post['action']=='update')
	{
		echo '<h5>'.$post['action'].'</h5>';
		update($link,$post['tname']);
		echo '<h5>updated at '.strftime("%Y-%m-%d %H:%M:%S").'</h5>';
		
		echo '<table class="table table-striped table-sm table-bordered">';
			view_row($link,$post['tname'],$post['id'],'yes');
		echo '</table>';
		
	}

	//3a done
	elseif($post['action']=='and_select')
	{
		echo '<h5>'.$post['action'].'</h5>';	
		select($link,$post['tname']);
	}
	//3b done
	elseif($post['action']=='or_select')
	{
		echo '<h5>'.$post['action'].'</h5>';	
		select($link,$post['tname'],$join='or');
	}
	//3c
	elseif($post['action']=='list')
	{
		echo '<h5>'.$post['action'].'</h5>';	
		select($link,$post['tname']);
	}

	//4 done
	elseif($post['action']=='delete')
	{
		echo '<h5>'.$post['action'].'</h5>';
		$sql='delete from `'.$tname.'` where id=\''.$post['id'].'\'';
		$result=run_query($link,$GLOBALS['database'],$sql);
		if($result)
		{
			echo '<h3>Deleted '.$tname.' id='.$post['id'].'</h3>';
		}
	}	

	
}

?>
