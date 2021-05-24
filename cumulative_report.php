<?php
$GLOBALS['Collection_Date']=1015;
$GLOBALS['Collection_Time']=1016;
$GLOBALS['Received_on']=1017;
$GLOBALS['Receipt_time']=1018;
$GLOBALS['remark']=5098;
$GLOBALS['patient_name']=1002;

//$GLOBALS['nojunk']='';
require_once 'project_common.php';
require_once 'base/verify_login.php';

$GLOBALS['js']='';
$GLOBALS['js_meta']='';
$GLOBALS['js_mrd']='';

////////User code below/////////////////////
//echo '<pre>';print_r($_POST);echo '</pre>';
	
echo '		  <link rel="stylesheet" href="project_common.css">
		  <script src="project_common.js"></script>
		 <script type="text/javascript" src="bootstrap/jquery.sparkline.js"></script>';	

		 
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
main_menu($link);

if(isset($_POST['one_by_one_sample_id']))
{
	if(ctype_digit($_POST['one_by_one_sample_id']))
	{
		$one_by_one_sample_id=$_POST['one_by_one_sample_id'];
	}
	else
	{
		$one_by_one_sample_id=0;
	}
}
else
{
	$one_by_one_sample_id=0;
}


if(isset($_POST['get_data']))
{

	if($_POST['get_data']=='one_by_one')
	{
		$one_by_one_sample_id=$one_by_one_sample_id;
	}

	if($_POST['get_data']=='one_by_one_plus')
	{
		$one_by_one_sample_id=$one_by_one_sample_id+1;
	}

	if($_POST['get_data']=='one_by_one_minus')
	{
		$one_by_one_sample_id=$one_by_one_sample_id-1;
	}

}

echo '<h2>Cumulative Report</h2>';
echo '<form method=post>
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<div class="d-inline border border-success rounded p-2" >
	<input type=number name=one_by_one_sample_id value=\''.$one_by_one_sample_id.'\' placeholder="for 1-by-1">
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one_plus>+1</button>
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one>OnebyOne</button>
	<button class="btn btn-info btn-sm" type=submit name=get_data value=one_by_one_minus>-1</button>
	</div>
</form>';

$GLOBALS['canvas_height']=200;
$GLOBALS['canvas_width']=400;

//echo 'before get_data obtained';
if(isset($_POST['get_data']))
{
	//echo 'get_data obtained';
		//echo '<div class="d-inline-block border rounded p-2">';
			//$j_data=show_delta_for_single_sample($link,$one_by_one_sample_id);
			show_delta_for_single_sample($link,$one_by_one_sample_id);
		//echo '</div>';

}

//echo '<div id=gd></div>';

//////////////user code ends////////////////
tail();

//echo '<pre>';print_r($_POST);echo '</pre>';

//////////////data//////

//////////////Functions///////////////////////


function show_delta_for_single_sample($link,$sample_id,$ex_requested=array())
{
	//Never use $mrd, it is a global
	//echo 'going to execute echo show_delta';
	$this_mrd=get_one_ex_result($link,$sample_id,$GLOBALS['mrd']);
	$GLOBALS['js_mrd']=$this_mrd;
	//echo str_replace("/","_",$js_mrd); 
	 
	$sql='select sample_id from result 
			where 
				examination_id=\''.$GLOBALS['mrd'].'\' 
				and
				result=\''.$this_mrd.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	$sample_id_array=array();		
	while($ar=get_single_row($result))
	{
		$sample_id_array[]=$ar['sample_id'];
	}
	
	//echo '<pre>';print_r($sample_id_array);echo '</pre>';
	$all_data=show_lj_for_sample($link,$sample_id_array);
	//echo '<pre>';print_r($all_data);echo '</pre>';
	$exr=prepare_examination_wise_cumulative_report($all_data);
	//echo '<pre>';print_r($exr);echo '</pre>';
	//echo 'going to execute echo graph';
	echo '<div class="two_column">';
	//echo '<pre>';
	echo_graph($link,$exr);
	echo '</div>';
	//$j_data=json_encode($exr);
	//return $j_data;
}

function show_lj_for_sample($link,$sample_id_array,$ex_requested=array())
{		
	$ret=array();
	foreach($sample_id_array as $sample_id)
	{
		$ret=$ret+display_one_qc($link,$sample_id,$ex_requested);
	}
	return $ret;
}

function display_one_qc($link,$sample_id,$ex_requested)
{
	$sql='select * from result where sample_id=\''.$sample_id.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	//$GLOBALS['receipt_date']=1017;
	//$GLOBALS['receipt_time']=1018;
	$dt=get_one_ex_result($link,$sample_id,$GLOBALS['receipt_date']);
	$tm=get_one_ex_result($link,$sample_id,$GLOBALS['receipt_time']);
	$dt_tm=$dt.' '.$tm;
	//echo '<h1>xx'.$dt_tm.'</h1>';

	while($ar=get_single_row($result))
	{

		$ret[$sample_id][$ar['examination_id']]=[$dt_tm,$ar['result']];
	}
	return $ret;
}

function prepare_examination_wise_cumulative_report($ar)
{
	//echo '<pre>';print_r($ar);
	$exr=array();
	foreach ($ar as $sid => $data)
	{
		foreach ($data as $ex_id => $res)
		{	
			if(is_numeric($res[1]))
			{
				//$exr[$ex_id][$sid]=$res;	
				//$exr[$ex_id][]=[$sid,$res];
				$exr[$ex_id][]=$res;		
			}
		}
	}
	return $exr;
}

function echo_graph($link,$exr)
{
	//echo '<pre>';print_r($exr);echo '</pre>';
	
	foreach ($exr as $k=>$v)
	{
		$examination_details=get_one_examination_details($link,$k);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';
		//$exr_meta[$k]=["name"=>$examination_details["name"],"interval_l"=>$interval_l,"interval_h"=>$interval_h];
		$exr_meta[$k][]=$examination_details["name"];
		$exr_meta[$k][]=$interval_l;
		$exr_meta[$k][]=$interval_h;
	}
	//echo '<pre>';print_r($exr_meta);
	$GLOBALS['js_meta']=json_encode($exr_meta);
	$GLOBALS['js']=json_encode($exr);
	//echo $GLOBALS['js'];
	//echo $GLOBALS['js_meta'];
	//echo '<script>alert(\'';echo $GLOBALS['js'];echo '\')</script>';
}

function echo_graph_good($exr)
{
	//echo '<pre>';print_r($exr);echo '</pre>';
	foreach ($exr as $ex_id => $data)
	{
		//print_r($data);
		//$js_var=json_encode($data,JSON_NUMERIC_CHECK|JSON_FORCE_OBJECT);
		$js=json_encode($data,JSON_NUMERIC_CHECK);
		//echo json_last_error_msg();
		//echo $js;
		$js_var=$js;
		echo '<span onclick="my_chart(\'i_'.$ex_id.'\', '.$js_var.')" 
					class="inlinesparkline" 
					id=\'i_'.$ex_id.'\' 
					myar='.$js_var.'
				>
					['.$ex_id.']
				</span>';
	}	
}

?>

<script type="text/javascript">
var js=<?php echo $GLOBALS['js']; ?>;
var js_meta=<?php echo $GLOBALS['js_meta']; ?>;
var js_mrd=<?php echo "'".$GLOBALS['js_mrd']."'"; ?>;
console.log(js_mrd);

$(document).ready
	(
		function()
		{	
			
			draw_graph_with_date();
				
			$('.inlinesparkline').each
			(
				function(index,value)
				{
					my_spark($(this).attr('id'));
				}
			);
			
			$('.my_canvas').each
			(
				function(index,value)
				{
					draw_one_graph($(this).attr('id'));
				}
			)
			
		}
	);

function my_spark(id)
{
	x=$('#'+id).attr('myar');
	y=x.split(',');
	//alert(index+':'+y);
	l=$('#'+id).attr('interval_l');
	h=$('#'+id).attr('interval_h');
						
	properties=
		{
			type: 'line',
			width: '5em',
			height: '5em',
			lineColor: '#000000',
			fillColor: '#ffffff',
			lineWidth: 2,
			spotColor: '#54ff00',
			minSpotColor: '#ef00d3',
			maxSpotColor: '#5f00bf',
			spotRadius: 3,
			chartRangeMin: l/2,
			chartRangeMax: h*2,
			normalRangeMin: l,
			normalRangeMax: h,
			drawNormalOnTop: true,
		};
	$('#'+id).sparkline(y,properties);
	
}	
function my_chart(me,data)
{
	$('#'+me).sparkline(data,{width:"3em",height:"3em"});
}

function draw_line(ctx,from,to,color='#000000')
{
	ctx.beginPath();
	ctx.strokeStyle = color;
	ctx.moveTo(from[0],from[1]);
	ctx.lineTo(to[0],to[1]);
	ctx.stroke();  	

}

function draw_line_dots(ctx,from,to,color='#000000')
{
	ctx.beginPath();
	ctx.setLineDash([1, 2]);/*dashes are 5px and spaces are 3px*/
	ctx.strokeStyle = color;
	ctx.moveTo(from[0],from[1]);
	ctx.lineTo(to[0],to[1]);
	ctx.stroke();  	

}

function draw_text(ctx,from,text,color='#000000',font="10px Serif")
{
	ctx.setLineDash([]);
	ctx.font = font;
	ctx.strokeStyle = color;
	ctx.strokeText(text,from[0],from[1]);
}

function draw_one_graph(id)
{
	c=document.getElementById(id);
	x=c.getAttribute('myar');
	y_data=x.split(',');
	//alert(y_data);
	l=c.getAttribute('interval_l');
	h=c.getAttribute('interval_h');
	ex_name=c.getAttribute('ex_name');
						
	var canvas_height=c.getAttribute("height");
	var canvas_width=c.getAttribute("width");
	var ctx = c.getContext("2d");
	ctx.font = "Serif";
    //console.log(y_data);
    //console.log(canvas_height);
    //console.log(canvas_width);
	len=y_data.length;
    //console.log(len);

    
    zero_x=canvas_width/10;
    zero_y=canvas_height-canvas_height/10;
    //alert(zero_y);
    canvas_width=canvas_width-(zero_x*2);
    canvas_height=canvas_height-((canvas_height/10)*2);
    
	x_unit=(canvas_width)/(len+1);
	y_unit=(canvas_height)/( Math.max(...y_data) - Math.min(...y_data) );
	//alert(canvas_height+','+ Math.max(...y_data) + ',' + Math.min(...y_data) );
    //console.log(x_unit+','+y_unit);
    
    //Y
	draw_line(ctx, [zero_x,zero_y],[zero_x,zero_y-canvas_height -canvas_height/20  ],color='Green');
	//X
	draw_line(ctx, [zero_x,zero_y],[zero_x+canvas_width,zero_y],color='Green');

	var counter=1;
	
	for( var one_point in y_data)
	{
		//alert(y_data[one_point]+','+Math.min(...y_data));

		//alert(zero_y+','+y_draw+','+y_unit);
		
		//draw_line(ctx, [zero_x+counter*x_unit, zero_y],[zero_x+counter*x_unit, zero_y - (y_draw*y_unit)-canvas_height/20 ]);
		
		y_draw=y_data[one_point]-Math.min(...y_data);
		if(one_point>0)
		{
		y_draw_priv=y_data[one_point-1]-Math.min(...y_data);
		draw_line(ctx, [zero_x+ (one_point-1)*x_unit, zero_y - (y_draw_priv*y_unit)-canvas_height/20 ] ,[zero_x+ one_point*x_unit, zero_y - (y_draw*y_unit)-canvas_height/20 ]);
		}

		draw_text(ctx, [zero_x+one_point*x_unit+5, zero_y - (y_draw*y_unit) -canvas_height/20 ]  ,y_data[one_point]);

		counter++;
	}
	draw_text(ctx,[zero_x,zero_y+canvas_height/10],ex_name,color='#0F0000',font="15px Serif");
}



function draw_one_graph_good(id)
{
	c=document.getElementById(id);
	x=c.getAttribute('myar');
	y_data=x.split(',');
	//alert(index+':'+y);
	l=c.getAttribute('interval_l');
	h=c.getAttribute('interval_h');
	ex_name=c.getAttribute('ex_name');
						
	var canvas_height=c.getAttribute("height");
	var canvas_width=c.getAttribute("width");
	var ctx = c.getContext("2d");
	ctx.font = "Serif";
    console.log(y_data);
    console.log(canvas_height);
    console.log(canvas_width);
    

	len=y_data.length;
    console.log(len);

    pad=canvas_width/20;
    
    canvas_width=canvas_width-2*pad;
    canvas_height=canvas_height-2*pad;
    
	x_unit=(canvas_width)/(len+1);
	y_unit=(canvas_height)/(Math.max(...y_data)*1.1);
	
    //console.log(x_unit+','+y_unit);
	draw_line(ctx, [zero_x,canvas_height],[zero_x,zero_y]);
	draw_line(ctx, [zero_x,canvas_height],[canvas_width,canvas_height]);

	var counter=1;
	for( var one_point in y_data)
	{
		draw_line(ctx, [counter*x_unit,canvas_height],[counter*x_unit, canvas_height-(y_data[one_point]*y_unit) ])
		draw_text(ctx,[counter*x_unit, canvas_height-(y_data[one_point]*y_unit) ],y_data[one_point]);

		counter++;
	}
	draw_text(ctx,[zero_x,canvas_height+zero_y-1],ex_name);
	draw_text(ctx,[zero_x,zero_y],Math.max(...y_data));

}


function draw_graph_with_date_without_rotation()
{
	console.log(js);
	console.log(js[5006][2][1]);
	
	for ( each_ex_id in js )
	{ 
		//document.getElementById("gd").innerHTML += (each_ex_id + '<br>');
		var cnvs = document.createElement("canvas");
		cnvs.setAttribute("height","400");
		cnvs.setAttribute("width","800");
		cnvs.setAttribute("class","border border-info");
		document.body.appendChild(cnvs);
		var ctx = cnvs.getContext("2d");
		ctx.font = "Serif";
		draw_text(ctx,[10,10],each_ex_id,color='#000000',font="10px Serif");
		
		var value_array=[];
		for (each_date_time in js[each_ex_id])
		{
			value_array.push(parseFloat(js[each_ex_id][each_date_time][1]));
		}
		
		max_val=Math.max(...value_array);
		min_val=Math.min(...value_array);
		if(max_val != min_val)
		{
			x_unit=500/(max_val-min_val);
		}
		else
		{
			x_unit=500/max_val;			
		}
		console.log(value_array);
		console.log(max_val + ',' + min_val);
		counter=0;
		
		for (each_date_time in js[each_ex_id])
		{
			//document.getElementById("gd").innerHTML += (js[each_ex_id][each_date_time][0] + '->' + js[each_ex_id][each_date_time][1]) + '<br>';
			data=(js[each_ex_id][each_date_time][0] + '->' + js[each_ex_id][each_date_time][1]);
			data_length=js[each_ex_id][each_date_time][1]-min_val;
			draw_text(ctx,[10,20+counter*20],data,color='#000000',font="10px Serif");
			//draw_line(ctx,[200,20+counter*20],[200+parseFloat(data_length)*x_unit+50 ,20+counter*20],color='#000000');
			//draw_text(ctx,[200+parseFloat(data_length)*x_unit+50 ,20+counter*20],data,color='#000000',font="10px Serif");
			counter++;
		}
	}
}


function draw_graph_with_date()
{
	//console.log(js);
	//console.log(js[5006][2][1]);

	//var cw=400;
	//var ch=200;

	total_data=0
	for ( each_ex_id in js )
	{ 
		total_data=Math.max(js[each_ex_id].length,total_data);
		console.log(total_data);
	}
	
	var cw=400;
	var ch=(total_data+3)*20;	//total_data + min + max + 20 extra
			
	for ( each_ex_id in js )
	{ 
		//document.getElementById("gd").innerHTML += (each_ex_id + '<br>');
		var cnvs = document.createElement("canvas");
		cnvs.setAttribute("height",ch);
		cnvs.setAttribute("width",cw);
		cnvs.setAttribute("class","border border-info");
		document.body.appendChild(cnvs);
		var ctx = cnvs.getContext("2d");
		ctx.font = "Serif";
		//draw_text(ctx,[10,12],js_meta[each_ex_id][0]+"  (id:"+each_ex_id+")"+"  (MRD:"+js_mrd+")",color='#000000',font="13px Serif");
		draw_text(ctx,[10,12],js_meta[each_ex_id][0]+" ("+js_mrd+")",color='#000000',font="13px Serif");
		
		if(js_meta[each_ex_id][1]!=NaN && js_meta[each_ex_id][1].length!=0)
		{
			js[each_ex_id].push(['min',js_meta[each_ex_id][1]]);
		}
		if(js_meta[each_ex_id][2]!=NaN && js_meta[each_ex_id][2].length!=0)
		{
			js[each_ex_id].push(['max',js_meta[each_ex_id][2]]);
		}
		
		//console.log(js[each_ex_id]);
		
		var value_array=[];
		
		for (each_date_time in js[each_ex_id])
		{
			value_array.push(parseFloat(js[each_ex_id][each_date_time][1]));
		}
		
		max_val=Math.max(...value_array);
		min_val=Math.min(...value_array);
		
		if(max_val != min_val)
		{
			x_unit=(cw-250)/(max_val-min_val);
		}
		else
		{
			x_unit=(cw-250)/max_val;
		}		

		counter=0;
		
		for (each_date_time in js[each_ex_id])
		{
			//document.getElementById("gd").innerHTML += (js[each_ex_id][each_date_time][0] + '->' + js[each_ex_id][each_date_time][1]) + '<br>';
			data=(js[each_ex_id][each_date_time][0]);
			data_length=js[each_ex_id][each_date_time][1]-min_val;
			if(data=='min' || data=='max')
			{
				draw_line_dots(ctx,[110+parseFloat(data_length)*x_unit+50 ,30+counter*20],[110+parseFloat(data_length)*x_unit+50 ,0],color='#000000');				
				draw_text(ctx,[110+parseFloat(data_length)*x_unit+50+2 ,30+counter*20],js[each_ex_id][each_date_time][1]+'('+data+')',color='#000000',font="12px Serif");
			}
			else
			{
				draw_line(ctx,[110,30+counter*20],[110+parseFloat(data_length)*x_unit+50 ,30+counter*20],color='#000000');
				draw_text(ctx,[10,30+counter*20],data,color='#000000',font="10px Serif");
				draw_text(ctx,[110+parseFloat(data_length)*x_unit+50+2 ,30+counter*20],js[each_ex_id][each_date_time][1],color='#000000',font="12px Serif");
			}
			counter++;
		}
	}
}


</script>

<style>
.two_column 
{
  display: grid;
  grid-template-columns: auto auto;
}
</style>

