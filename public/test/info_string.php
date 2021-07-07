<?PHP
include("/var/www/html/connect.php");
include("/var/www/html/connect2.php");
?>	

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="5">

<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../style/style.css" rel="stylesheet" type="text/css">
</head><title>11</title><body>

<?php
date_default_timezone_set('Europe/Moscow');
$now=date('H:i:s');
$smena=mysqli_query($db,"SELECT * FROM smena");

	if (($now>$sm['start_smena'])&&($now<$sm['end_smena'])){echo "<h1><w>Смена".$sm['nomersmeni']; }
	if (($now>'07:00')&&($now<'15:39')) {echo "<h1><w>Первая смена ".$now; }
	if (($now>'15:40')&&($now<'23:59')) {echo "<h1><w>Вторая смена ".$now; }
	if (($now>'00:10')&&($now<'06:10')) {echo "<h1><w>Ночная смена ".$now; }
	//if ((($now>'13:00')&&($now<'13:40'))||(($now>'19:00')&&($now<'19:30'))) {echo "<h1><w>Обед"; }
	$id_stanka=mysqli_query($db,"SELECT id_machine FROM machine  ORDER BY `machine`.`operator` DESC");
Echo '<table width="100%"  height="90%" border="0" align="centr" cellspacing="2" style="font-size:50px;">';
			foreach ($id_stanka as $ma ) //Перебираю имена станков;
			{	
				
				$result = mysqli_query($db2,"SELECT `READING_TIME`,`TAG_DATA`,`DEVICE_NUMBER`,`machine`.`name`,`machine`.`remont` FROM `MTH_RAW_DATA` LEFT JOIN ceh2.machine ON `DEVICE_NUMBER`=`machine`.`id_machine` WHERE DEVICE_NUMBER='".$ma['id_machine']."'  AND TAG_CODE NOT LIKE 'DOWN' AND READING_TIME >= CURDATE() ORDER BY `MTH_RAW_DATA`.`READING_TIME` DESC")or die(mysqli_error());
				$resarr = mysqli_fetch_array($result);
				$status=$resarr['TAG_DATA'];
				$time=$resarr['READING_TIME'];
				if($row["remont"]=="1"){$bg="background-color: #333;"; $rem="РЕМОНТ";  }else{$bg=""; $rem="";}
				
				foreach($result as $row) //перебираю статусы станка;
						{
							if ($status == $row['TAG_DATA']) { $start=$row['READING_TIME'];} else {break;}
						}	
						
					$interval=(strtotime($time)-strtotime($start)-10800);
					$stats="";					
					
					if($status=="0"){$color="black"; $fcolor="white"; $stat="Выключен"; }
					if($status=="1"){$color="gray"; $fcolor="white"; $stat="Включен";}
					if($status=="2"){$color="green"; $fcolor="white"; $stat="Работает";}
					if($status=="3"){$color="yellow"; $fcolor="black"; $stat="Наладка";}
					if($status=="4"){$color="Salmon"; $fcolor="black"; $stat="Остановлен";}
					if($status	=="5"){$color="red"; $fcolor="black"; $stat="ERROR";}					
										
										
										Echo '  <tr style="background-color:'.$color.'; " align="center">
												<td style="width:50%; height:30px;"><font color='.$fcolor.'>'.$row["name"].'</font></td>
												<td style="width:50%"><font color='.$fcolor.'>'.$stat.' '.date('H ч i мин',$interval).'</font></td>
												</tr>
												<tr style="background-color: #333; height:20px;">
												<td> </td><td> </td>
												</tr>
												';	
												
			}
Echo '</table>';
?>
 
<div class="fixed-bottom">
	<?php include ("/var/www/html/blocks/footer.php");?>
	</div>
</body>
</html>