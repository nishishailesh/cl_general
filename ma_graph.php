<?php
session_name($_POST['session_name']);
session_start();
require_once 'config.php';
require_once 'base/common.php';
require_once 'project_common.php';

echo '
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>';


require_once $GLOBALS['main_user_location'];
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
//$lot_size=200;
$lot_size=100;


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

$one='select avg_value from moving_average order by date_time limit 200';
$result=run_query($link,$GLOBALS['database'],$one);
$data=array();
while($ar=get_single_row($result))
{
  $data[]=$ar['avg_value'];
}

//print_r($data);
$json=implode(",",$data);
//echo $json;
function get_user_info($link,$user)
{
	$sql='select * from user where user=\''.$user.'\'';
	$result=run_query($link,$GLOBALS['database'],$sql);
	return get_single_row($result);
}
?>
    <canvas id="bar-chart" width=300" height="150"></canvas>


    <script >
jdata=[<?php echo $json; ?>]

new Chart(document.getElementById("bar-chart"), 
    {
    type: 'line',
    data: {
	    	labels: Array.from(Array(jdata.length).keys()),
		datasets:[{
				data:jdata
          		}]
	  },
    options: 	{
    			scales:
			{
	                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                max: 200,
                                min: 100
                            }
        	                }]
  			}

		}

    }
         );

    </script>
