<script>

function init(all_data)
{
	//all_result=[[5,10],[2,8]]	
	var c = document.getElementById("canvas");
	var ctx = c.getContext("2d");
	ctx.font = "Serif"
	var c = document.getElementById("output");
	//c.innerHTML=all_data
	//console.log(x)
	ss=["#FF0000","#00FF00","#0000FF","#FFFF99","#FF0666","#FF0666","#FF0666"];
	ss_count=0;
	
	ctx.moveTo(0,200);
	ctx.lineTo(800,200);

	ctx.moveTo(0,250);
	ctx.lineTo(800,250);

	ctx.moveTo(0,300);
	ctx.lineTo(800,300);

	ctx.moveTo(0,150);
	ctx.lineTo(800,150);

	ctx.moveTo(0,100);
	ctx.lineTo(800,100);
					
	text_x=0
	text_y=10
	for( var one_chart in all_data)	//one cahrt is key
	{
		
		ctx.strokeStyle=ss[ss_count];
		console.log(one_chart+'--\>' + ss[ss_count])
		ctx.strokeText(one_chart,text_x,text_y)
		text_y=text_y+12
		
		ss_count=ss_count+1;
		//console.log(x[one_chart])
		
		start=true
		prev_x=0
		prev_y=0
		

		for( var one_point in all_data[one_chart])
		{
			if(start==true)
			{
				start_x=one_point
				start=false	
			}
			
			//one day 86400 seconds =24 pixel
			xpoint=((one_point-start_x)*24)/86400
			
			//xpoint_day=Math.abs(Math.round(one_point/1000000)-start_x)
			//xpoint_hour=Math.abs(Math.round(one_point/1000000)-start_x)
			ypoint=200-all_data[one_chart][one_point]*50
			console.log(xpoint + '--\>' + ypoint)
			//ctx.moveTo(prev_x,prev_y);
			//ctx.lineTo(xpoint,ypoint);
			//prev_x=xpoint			
			//prev_y=ypoint			
			//height=400, width=800
			//one sd=50
			//20200624093012
			//2020062409 (same hour , same place)
			//one day, 24 pixel
			//30 days=720 pixel
			//ctx.moveTo(xpoint,ypoint);
			//ctx.lineTo(j * 20 +i*5, all_result[i][j]*40);
			ctx.strokeText('x',xpoint,ypoint) 
		}
		ctx.stroke();
	}
	/*
	var c = document.getElementById("canvas");
	var ctx = c.getContext("2d");
	//ctx.font = "30px Arial";
	//ctx.fillText(all_result, 10, 50); 
	
	ctx.beginPath();
	
	ctx.strokeStyle="#FF0666";
	for (i=0;i<all_result.length;i++) 
	{
		for(j=0;j<all_result[i].length;j++) 
		{
			ctx.moveTo(j*20 +i*5 , 0);
			ctx.lineTo(j * 20 +i*5, all_result[i][j]*40);
		}
	}
	ctx.stroke();
	*/
}
</script>
<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'project_common.php';

//print_r($_POST);
/*
Array (
[session_name] => sn_1631566223 
[qc_equipment] => XL_1000 
[from_date] => 2020-06-10 
[to_date] => 2020-06-10 
[list_of_selected_examination] => 5009 
[show_lj] => export_lj_date 
) 
*/
//exit();
////////User code below/////////////////////	
$qc_sample_type=array('QC-QC-BI');
$GLOBALS['qc_equipment_ex_id']=9000;
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

if($_POST['show_lj']=='export_lj_date')
{
	$array=get_date_range_sample_id($link,$_POST['from_date'],$_POST['to_date'],$_POST);
}
elseif($_POST['show_lj']=='chart_lj_sample')
{
	$array=get_qc_sample_id_from_parameters($link,$_POST);
}


echo '<pre>';
 					//[sample_id] => 9000015
                    //[examination_id] => 9006-ALT
                    //[result] => 36
                    //[sdi] => 1.9
                    //[mean] => 32.6000
                    //[sd] => 1.8000
                    //[date] => 2020-06-10
                    //[time] => 13:14
                    //[equipment] => XL_1000
                    //[mrd_num] => Qc/5/RANDOX/1369UE
                    //[uniq] => 20200610133545

//graph by qc_type, Qc_lot,examination id
//print_r( $array);
$gr=array();
//echo '<pre>';
	foreach ($array as $sample_id)
	{
		$ex_requested=explode(',',$_POST['list_of_selected_examination']);
		$ar=mk_array_for_one_qc_result($link,$sample_id,$ex_requested);
		//print_r($ar);
		
		foreach($ar as $v)
		{
			$time_num=strtotime($v['date'].' '.$v['time']);
			$gr[	$v['mrd_num'].'|'.$v['examination_id'].'|'.$v['equipment'] ][$time_num]=$v['sdi'];
			//$gr['"'.$v['mrd_num'].'|'.$v['examination_id'].'|'.$v['equipment'].'"' ]['"'.$v['uniq'].'"']='"'.$v['sdi'].'"';
		}
	}
	
//print_r( $gr);
//exit(0);
//print_r($all_result);

$x=json_encode($gr);
//echo $x;
echo '
<body onLoad=init('.$x.')>
<div id=output></div>
<canvas id=canvas height=400 width=800>
</canvas>';


//////////////user code ends////////////////
//tail();
