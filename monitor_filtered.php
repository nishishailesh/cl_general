<?php
session_name($_POST['session_name']);
session_start();
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';
require_once $GLOBALS['main_user_location'];
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if(isset($_POST['login']))
{
	$_SESSION['login']=$_POST['login'];
}

if(isset($_POST['password']))
{
	$_SESSION['password']=$_POST['password'];
}

if(!isset($_SESSION['login']) && !isset($_POST['login']))
{
	exit(0);
}

if(!isset($_SESSION['password']) && !isset($_POST['password']))
{
	exit(0);
}

echo '
<style>

.two_column 
{
  display: grid;
  grid-template-columns: auto auto;
}

.ten_column 
{
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto auto auto auto;
  grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
  justify-items: start;
  gap: 0px 0px;
  margin: 3px;
  border: 3px solid red;
}
</style>

';

$lh_id=explode("-",$_SESSION['id_range']);

$one='select distinct sample_id from result where 
			sample_id between \''.$lh_id[0].'\' and \''.$lh_id[1].'\' 
			order by sample_id desc limit '.$_SESSION['sample_limit'].' offset '.$_SESSION['sample_offset'];

//echo $one;
$result=run_query($link,$GLOBALS['database'],$one);


while($ar=get_single_row($result))
{
	//check sample requirement
	if(strlen($_SESSION['sample_requirement'])>0)
	{
		$sr=get_one_ex_result($link,$ar['sample_id'],$GLOBALS['sample_requirement']);
		if($sr==$_SESSION['sample_requirement'])
		{
			$show_sample_sr=True;
		}
		else
		{
			$show_sample_sr=False;
		}
	}
	else
	{
		$show_sample_sr=True;
	}

	//check sample status
	if(strlen($_SESSION['sample_status'])>0)
	{
		$ss=get_sample_status($link,$ar['sample_id']);
		if($GLOBALS['sample_status'][$ss][0]==$_SESSION['sample_status'])
		{
			$show_sample_ss=True;
		}
		else
		{
			$show_sample_ss=False;
		}
	}
	else
	{
		$show_sample_ss=True;
	}


	//check sample location
	if(strlen($_SESSION['sample_location'])>0)
	{
		$sl=get_one_ex_result($link,$ar['sample_id'],$GLOBALS['OPD/Ward']);
		if($_SESSION['sample_location']==$sl)
		{
			$show_sample_sl=True;
			//echo 'True'.$ar['sample_id'];
		}
		else
		{
			$show_sample_sl=False;
		}
	}
	else
	{
		$show_sample_sl=True;
	}


        ////////check sexamination_id
        if(strlen($_SESSION['examination_id'])>0 ||$_SESSION['examination_id']==0)
        {
                $sx=get_one_ex_result($link,$ar['sample_id'],$_SESSION['examination_id']);
                if($sx!==False || $_SESSION['examination_id']==0)
                {
                        $show_ex=True;
                }
                else
                {
                        $show_ex=False;
                }
        }

	////////////////////////////////

	//check sample location
	if(strlen($_SESSION['receipt_date'])>0)
	{
		$rd=get_one_ex_result($link,$ar['sample_id'],$GLOBALS['receipt_date']);
		//echo $rd,'=>'.$_SESSION['receipt_date'].'<br>';
		if($_SESSION['receipt_date']==$rd)
		{
			$show_sample_rd=True;
			//echo 'True';
		}
		else
		{
			$show_sample_rd=False;
		}
	}
	else
	{
		$show_sample_rd=True;
	}


	//if($show_ex==True)
	//{
	//	echo '<h1>$show_ex=True</h1>';
	//}
	//else
	//{
	//	echo '<h1>$show_ex=False</h1>';
	//}

	if($show_sample_sr==True && $show_sample_ss==True && $show_sample_sl==True && $show_ex==True && $show_sample_rd==True)
	{
		show_sid_button_release_status($link,$ar['sample_id']);
	}
}


echo '<pre>monitor:session';print_r($_SESSION);echo '</pre>';
//echo '<pre>monitor:post';print_r($_POST);echo '</pre>';
//echo '<pre>';print_r($GLOBALS['sample_status']);echo '</pre>';

function get_user_info($link,$user)
{
	$sql='select * from user where user=\''.$user.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}

function get_sample_status($link,$sample_id)
{
	$final_status=0;
	foreach ($GLOBALS['sample_status'] as $k=>$v)
	{
		$ss=get_one_ex_result($link,$sample_id,$v[1][0]);
		if(strlen($ss)>0)
		{
			$final_status=$k;
		}
	}
	return $final_status;
}
?>
