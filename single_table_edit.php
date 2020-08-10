<?php
//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';
	////////User code below/////////////////////
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>';	
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
$user=get_user_info($link,$_SESSION['login']);
$auth=explode(',',$user['authorization']);
//print_r($auth);



if(in_array('requestonly',$auth))
{
	exit(0);
}

main_menu();

//Tables_in_cl_general
$column_name='Tables_in_'.$GLOBALS['database'];

$sql='select * from '.$GLOBALS['record_tables'];
$result=run_query($link,$GLOBALS['database'],$sql);
while($ar=get_single_row($result))
{
	//print_r($ar);
	show_manage_single_table_button($ar['table_name']);
}

if(isset($_POST['tname']))
{
	echo '<h3>'.$_POST['tname'].'</h3>';
	$tname=$_POST['tname'];
	show_crud_button($tname,'add');
	show_crud_button($tname,'search');	//edit, remove inside it
}

//A done
if($_POST['action']=='add')
{
	echo '<h5>'.$_POST['action'].'</h5>';
	add($link,$_POST['tname']);
}

//B done
elseif($_POST['action']=='edit')
{
	echo '<h5>'.$_POST['action'].'</h5>';
	edit($link,$_POST['tname'],$_POST['id'],'yes');
}

//C done
elseif($_POST['action']=='search')
{
	echo '<h5>'.$_POST['action'].'</h5>';
	search($link,$_POST['tname']);
}


//1 no need, it is balnk insert -> view ->edit
//elseif($_POST['action']=='insert')
//{
//	echo '<h5>'.$_POST['action'].'</h5>';
//}

//2
if($_POST['action']=='update')
{
	echo '<h5>'.$_POST['action'].'</h5>';
	update($link,$_POST['tname']);
	echo '<h5>updated at '.strftime("%Y-%m-%d %H:%M:%S").'</h5>';
	
	echo '<table class="table table-striped table-sm table-bordered">';
		view_row($link,$_POST['tname'],$_POST['id'],'yes');
	echo '</table>';
	
}

//3a done
elseif($_POST['action']=='and_select')
{
	echo '<h5>'.$_POST['action'].'</h5>';	
	select($link,$_POST['tname']);
}
//3b done
elseif($_POST['action']=='or_select')
{
	echo '<h5>'.$_POST['action'].'</h5>';	
	select($link,$_POST['tname'],$join='or');
}

//4 done
elseif($_POST['action']=='delete')
{
	echo '<h5>'.$_POST['action'].'</h5>';
	$sql='delete from `'.$tname.'` where id=\''.$_POST['id'].'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	if($result)
	{
		echo '<h3>Deleted '.$tname.' id='.$_POST['id'].'</h3>';
	}
}	

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);print_r($_FILES);echo '</pre>';

//////////////Functions///////////////////////

function show_manage_single_table_button($tname)
{
	echo '<div class="d-inline-block" ><form method=post class=print_hide>
	<button class="btn btn-outline-primary btn-sm" name=tname value=\''.$tname.'\' >'.$tname.'</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=action value=manage_single_table>
	</form></div>';
}

function show_crud_button($tname,$type)
{
	echo '<div class="d-inline-block" ><form method=post class=print_hide>
	<button class="btn btn-outline-primary btn-sm" name=action value=\''.$type.'\' >'.$type.'</button>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<input type=hidden name=tname value=\''.$tname.'\'>
	</form></div>';
}

function add($link,$tname)
{
	run_query($link,$GLOBALS['database'],'insert into `'.$tname.'` () values()');
	$id=last_autoincrement_insert($link);
	edit($link,$tname,$id,$header='yes');
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
			echo '</td>';
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
	echo '<tr>';
	foreach($all_fields as $field)
	{
		echo '<td>'.$field['Field'].'</td>';
	}
	echo '<td>Action</td>';
	echo '</tr>';
	
	echo '<tr>';
	foreach($all_fields as $field)
	{
		if(substr($field['Type'],-4)=='blob')
		{
			echo '<td>Blob</td>';
		}
		else
		{
			echo '<td><input type=text name=\''.$field['Field'].'\'></td>';
		}
	}
	
	echo '<td><button class="btn btn-info  btn-sm"  
			type=submit
			name=action
			value=and_select>and Search</button>';
		echo '<button class="btn btn-info  btn-sm"  
			type=submit
			name=action
			value=or_select>or Search</button></td>';
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
		$sql='select id from `'.$tname.'` order by id desc limit 50';
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
			<button class="btn btn-outline-success btn-sm" name=id value=\''.$id.'\' >'.$id.'</button>
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
			<button class="btn btn-outline-success btn-sm" name=id value=\''.$id.'\' >X</button>
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
			<button class="btn btn-outline-success btn-sm" name=id value=\''.$id.'\' >update('.$id.')</button>
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

	echo '<table class="table table-striped table-sm table-bordered">';
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
		else
		{
			echo '<td><input type=text name=\''.$k.'\' value=\''.$v.'\'></td>';
		}
	}
	echo '</tr>';
	echo '</table>';

	echo'</form>';

}

function update_one_field($link,$tname,$fname,$pk)
{
		$sql='update `'.$tname.'`
			set 
				`'.$fname.'` =\''.$_POST[$fname].'\'
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

function update_one_field_with_value($link,$tname,$fname,$pk,$value)
{
		$sql='update `'.$tname.'`
			set 
				`'.$fname.'` =\''.$value.'\'
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
	$sql='update `'.$tname.'`
		set 
			`'.$fname.'` =\''.$data.'\'
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
			update_one_field_with_value($link,$tname,$name_fname,$pk,$_FILES[$fname]['name']);				
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
		if(!in_array($k,array('action','tname','session_name','id')))
		{
			update_one_field($link,$tname,$k,$_POST['id']);
		}
	}
	foreach($_FILES as $k=>$v)
	{
		if(!in_array($k,array('action','tname','session_name','id')))
		{
			update_one_field_blob($link,$tname,$k,$k.'_name',$_POST['id']);
		}
	}	
}

?>
