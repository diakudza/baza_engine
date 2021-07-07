<?PHP
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect2.php");
?>	

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css">
</head><title>аналитика</title><body>
<table><tr><w>
<?php
date_default_timezone_set('Europe/Moscow');
$start='2020-12-17 07:00:00';
$end='2020-12-17 23:59:00';

$stanki=mysqli_query($db,"SELECT id_machine,name from machine");
foreach($stanki as $rob)
{	
	echo '<tr>
		  <td><w>'.$rob["name"].'</td>';
					
			$time='0';
			$sql=mysqli_query($db2,"SELECT READING_TIME, DEVICE_NUMBER, TAG_DATA FROM `MTH_RAW_DATA` WHERE DEVICE_NUMBER='".$rob["id_machine"]." ' AND TAG_CODE NOT LIKE 'DOWN' AND READING_TIME BETWEEN '".$start."' AND '".$end."' ORDER BY `MTH_RAW_DATA`.`READING_TIME` DESC");
			//SELECT max(READING_TIME), DEVICE_NUMBER, TAG_DATA FROM `MTH_RAW_DATA` WHERE DEVICE_NUMBER='5451' AND TAG_DATA='0' AND TAG_CODE NOT LIKE 'DOWN' AND READING_TIME BETWEEN '2020-12-17 00:00:00' AND '2020-12-17 14:00:00' ORDER BY `MTH_RAW_DATA`.`READING_TIME` DESC 
			foreach($sql as $row)
			
				{	
					if ($row['TAG_DATA']=="0") 
					{ 
					$max_off=$row['READING_TIME']; 
					$start_off=$row['READING_TIME']; 

					}	
			
					$interval=(strtotime($time)-strtotime($start)-10800);
			
					
						
					/*if($row["TAG_DATA"]=="0"){$stat="Выключен";}
					
					if($row["TAG_DATA"]=="1"){$stat="Включен";}
					
					if($row["TAG_DATA"]=="2"){$stat="Работает";}
					
					if($row["TAG_DATA"]=="3"){$stat="Наладка";}
					
					if($row["TAG_DATA"]=="4"){$stat="Остановлен";}
					
					if($row["TAG_DATA"]=="5"){$stat="ERROR";}
					*/
					
				}	
			print '<td><br>'.$stat.' '.date('H ч i мин',$interval).'</td>'; 
			echo "</tr>";
}	
	echo "</tr>";	


?></tr>
</table>
<div class="fixed-bottom">
	<?php include($_SERVER['DOCUMENT_ROOT'] . "/public/blocks/footer.php");?>
	</div>
</body>
</html>