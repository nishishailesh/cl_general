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
		echo '<div class="d-inline-block border rounded p-2">';
			//$j_data=show_delta_for_single_sample($link,$one_by_one_sample_id);
			show_delta_for_single_sample($link,$one_by_one_sample_id);
		echo '</div>';

}

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
	while($ar=get_single_row($result))
	{
		$ret[$sample_id][$ar['examination_id']]=$ar['result'];
	}
	return $ret;
}

function prepare_examination_wise_cumulative_report($ar)
{
	$exr=array();
	foreach ($ar as $sid => $data)
	{
		foreach ($data as $ex_id => $res)
		{	
			if(is_numeric($res))
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
	foreach ($exr as $ex_id => $data)
	{
		//print_r($data);
		$examination_details=get_one_examination_details($link,$ex_id);
		$edit_specification=json_decode($examination_details['edit_specification'],true);
		$interval_l=isset($edit_specification['interval_l'])?$edit_specification['interval_l']:'';
		$interval_h=isset($edit_specification['interval_h'])?$edit_specification['interval_h']:'';

		
		
		
		$data_str=implode(',',$data);
		//echo $data_str;
		$js=json_encode($data,JSON_NUMERIC_CHECK);

		$js_var=$js;
		echo 	'<div>';
		//echo '<span>'.$examination_details['name'].'</span>';
					//echo 		'<span 
					//class="inlinesparkline" 
					//ex_name=\''.$examination_details['name'].'\' 
					//interval_l=\''.$interval_l.'\' 
					//interval_h=\''.$interval_h.'\' 
					//id=\'i_'.$ex_id.'\' 
					//myar=\''.$data_str.'\'>['.$ex_id.']</span>';
		
		echo '<canvas 
	
					class="my_canvas border"
					ex_name=\''.$examination_details['name'].'\'
					ex_id=\''.$ex_id.'\' 
					id=\'c_'.$ex_id.'\'  
					interval_l=\''.$interval_l.'\' 
					interval_h=\''.$interval_h.'\' 
					height=\''.$GLOBALS['canvas_height'].'\' 
					width=\''.$GLOBALS['canvas_width'].'\'
					myar=\''.$data_str.'\' ></canvas>';
		
		echo '</div>';
	}	
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

$(document).ready
	(
		function()
		{	
			
			
				
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

function draw_text(ctx,from,text,color='#000000',font="10px Serif")
{
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

</script>

<style>
.two_column 
{
  display: grid;
  grid-template-columns: auto auto;
}
</style>

