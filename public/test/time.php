<html>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
<head>
<link href="time.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="main" style="width:100%;">
<?PHP
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect2.php");

date_default_timezone_set('Europe/Moscow');
$now=date('H:i');
$start="2021-02-19 18:10:36";
$end="2021-02-19 18:17:36";
if(isset($_GET['int'])){
	{$interval=$_GET['int'];}
}
else {$interval=100;}

$id_machine = mysqli_query($db,"SELECT id_machine,name from machine")or die(mysqli_error("ERROR"));

foreach($id_machine as $rob)
	{	
		Echo '<div class="stanok">';
		$result = mysqli_query($db2,"SELECT `READING_TIME`,`TAG_DATA`,`DEVICE_NUMBER` FROM `MTH_RAW_DATA` WHERE DEVICE_NUMBER='".$rob['id_machine']."' AND `TAG_CODE`<>'STATN' AND `READING_TIME` BETWEEN '".$start."' AND '".$end."' ORDER BY `MTH_RAW_DATA`.`READING_TIME`")or die(mysqli_error("ERROR"));
		$selectStartEnd=mysqli_query($db2,"SELECT MAX(READING_TIME) AS ENDTIME, MIN(READING_TIME) AS STARTTIME From (SELECT `READING_TIME`,`TAG_DATA`,`DEVICE_NUMBER` FROM `MTH_RAW_DATA` WHERE DEVICE_NUMBER='".$rob['id_machine']."' AND `TAG_CODE`<>'STATN' AND `READING_TIME` BETWEEN '".$start."' AND '".$end."' ORDER BY `MTH_RAW_DATA`.`READING_TIME`) AS totals");

			$resarr = mysqli_fetch_array($result);
			$selectStartEnd = mysqli_fetch_array($selectStartEnd);
			$startTime=$selectStartEnd['STARTTIME'];
			$endTime=$selectStartEnd['ENDTIME'];	
			$status=$resarr['TAG_DATA'];
			$time=$resarr['READING_TIME']; 
			$interval_all=((strtotime($endTime)-strtotime($startTime))/60);
			
			Echo '<div class="info">
					INTER:'.$interval_all.'<br>START:'.$startTime.'<br>END:'.$endTime.'
					</div>';

/*
				foreach($result as $row) //перебираю статусы станка;
				{	
					if ($status == $row['TAG_DATA']) { 

							$start=$row['READING_TIME'];
							$interval=((strtotime($time)-strtotime($start))/60);
					} 
						
					else {	
							break;
								
					}		
							//	$width=round(($interval*100)/$interval_all);
							echo $status;
							echo '<div class="'.$color.'" <!--style="width:'.$width.'%;"-->>O </div>';
							echo '</div>';			
							
							if($status=="0"){$color="black";}
							if($status=="1"){$color="gray";}
							if($status=="2"){$color="green";}
							if($status=="3"){$color="yellow";}
							if($status=="4"){$color="Salmon";}
							if($status=="5"){$color="red";}						
				}
*/
	}
?>

</div>
</body>
</html>