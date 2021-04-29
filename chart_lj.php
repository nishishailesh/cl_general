<script>
function init(all_data)
{
	//all_result=[[5,10],[2,8]]	
	var c = document.getElementById("canvas");
	var ctx = c.getContext("2d");
	ctx.font = "Serif"
	
	var cc = document.getElementById("canvas_info");
	var ctxx = cc.getContext("2d");
	ctxx.font = "Serif"
	
	
	//c.innerHTML=all_data
	console.log(all_data)
	ss=["#FF0000","#00FF00","#0000FF",
		"#AA0000","#00AA00","#0000AA",
		"#BB0000","#00BB00","#0000BB",
		"#CC0000","#00BB00","#0000BB",
		"#DD0000","#00CC00","#0000CC",];
	ss_count=0;
	
	//0
	ctx.setLineDash([5, 3])
	ctx.beginPath();
	ctx.strokeStyle = "#000000";
	ctx.moveTo(0,200);
	ctx.lineTo(800,200);
	ctx.stroke();
	
	//ctx.strokeStyle = "#000000";
	//ctx.strokeText(0,0,200)
	
	ctx.setLineDash([])

	////-1s
	ctx.beginPath();
	ctx.moveTo(0,250);
	ctx.lineTo(800,250);
	ctx.strokeStyle = "#000000";	
	ctx.stroke();
	
	////-2s
	ctx.beginPath();	
	ctx.moveTo(0,300);
	ctx.lineTo(800,300);
	ctx.strokeStyle = "#FF9A14";	
	ctx.stroke();

	ctx.strokeStyle = "#000000";	
	ctx.strokeText(-2,0,300)	

	////-3s
	ctx.beginPath();	
	ctx.moveTo(0,350);
	ctx.lineTo(800,350);
	ctx.strokeStyle = "#FF0000";	
	ctx.stroke();

	ctx.strokeStyle = "#000000";	
	ctx.strokeText(-3,0,350)		

	////-4s
	
	ctx.beginPath();
	ctx.moveTo(0,400);
	ctx.lineTo(800,400);
	ctx.strokeStyle = "#000000";	
	ctx.stroke();
		
	////+1s
	ctx.beginPath();
	ctx.moveTo(0,150);
	ctx.lineTo(800,150);
	ctx.strokeStyle = "#000000";	
	ctx.stroke();
	
	////-2s
	ctx.beginPath();	
	ctx.moveTo(0,100);
	ctx.lineTo(800,100);
	ctx.strokeStyle = "#FF9A14";	
	ctx.stroke();

	ctx.strokeStyle = "#000000";	
	ctx.strokeText(2,0,100)	

	////-3s
	ctx.beginPath();	
	ctx.moveTo(0,50);
	ctx.lineTo(800,50);
	ctx.strokeStyle = "#FF0000";	
	ctx.stroke();

	ctx.strokeStyle = "#000000";	
	ctx.strokeText(3,0,50)		

	////-4s
	
	ctx.beginPath();
	ctx.moveTo(0,0);
	ctx.lineTo(800,0);
	ctx.strokeStyle = "#000000";	
	ctx.stroke();
	
						
	text_x=0
	text_y=10
	ctxx.font = "lighter Arial";
	
	for( var one_chart in all_data)	//one cahrt is key
	{
		
		ctxx.strokeStyle=ss[ss_count];
		ctx.strokeStyle=ss[ss_count];
		//console.log(one_chart+'--\>' + ss[ss_count])
		ctxx.strokeText(one_chart,text_x,text_y)
		text_y=text_y+13
		
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
			
			ypoint=200-all_data[one_chart][one_point]*50
			if(ypoint>400){(ypoint=395);}
			if(ypoint<0){(ypoint=5);}
			console.log(xpoint + '--\>' + ypoint)
			ctx.strokeText('x',xpoint,ypoint) 
		}
		//ctx.strokeStyle = "#000000";
		//ctx.stroke();
	}
	ctxx.stroke();
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

if($_POST['show_lj']=='chart_lj_date')
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
			$key_name=str_replace(" ","_",$v['mrd_num'].'|'.$v['examination_id'].'|'.$v['equipment']);
			$gr[$key_name][$time_num]=$v['sdi'];
		}
	}
	
//print_r( $gr);
//exit(0);
//print_r($all_result);

//$x=htmlentities(json_encode($gr,JSON_PRETTY_PRINT));
$x=json_encode($gr);
//echo json_last_error_msg();
//echo $x;
echo '
<body onLoad=init('.$x.')>
<canvas id=canvas height=400 width=800></canvas>
<canvas id=canvas_info height=200 width=800></canvas>';


//////////////user code ends////////////////
//tail();
