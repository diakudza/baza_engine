<?PHP
include("config/connect.php");
include("config/connect2.php");
?>	

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="5">

<link href="style.css" rel="stylesheet" type="text/css" />

</head><title>Статус</title><body>

<?php

date_default_timezone_set('Europe/Moscow');
$now=date('H:i:s');
//$now='10:23';
Echo "<h1>".$now."  ";
$week_number=date("W",strtotime(date('H:i:s')));
if(($week_number % 2) == 0)//проверка четности недели, для определения смены 
	{$smena1='2';}//diakov
else
	{$smena1='1';}//mendelev
$display_o="none";
$display="flex";
//$smen1=mysqli_query($db,"SELECT Fio FROM rabotniki WHERE smena='".$smena1."'");
//$smen2=mysqli_query($db,"SELECT Fio FROM rabotniki WHERE smena='".$smena2."'");

	if (($now>'07:00' && $now<'15:40')) {echo "Первая смена </h1>"; /*foreach ($smen1 as $who){echo $who['Fio']." ";}*/}
	if (($now>'15:41' && $now<'23:59')) {echo "Вторая смена </h1>"; /*foreach ($smen2 as $who){echo $who['Fio']." ";}*/}
	if (($now>'00:10' && $now<'06:10')) {echo "Ночная смена.</h1>"; /*foreach ($smen2 as $who){echo $who['Fio']." ";}*/}
	if ((($now>'13:00' && $now<'13:40'))||(($now>'19:00')&&($now<'19:30'))) {$display="none"; $display_o="block";}
	
	$id_stanka=mysqli_query($db,"SELECT id_machine FROM machine");
Echo '<div class="table">
		<div class="obed" style="display:'.$display_o.';">ОБЕД</div>';

			$i=0;
			foreach ($id_stanka as $ma ) //Перебираю имена станков;
			{	$i=$i+1;
				if($smena1=='2' && $now>'07:00' && $now<'15:40')//первая смена дьяков
					{ $operator=mysqli_fetch_array(mysqli_query($db,"SELECT name,operator,Fio FROM `machine` LEFT JOIN rabotniki on operator=rabotniki.id_rabotnika where id_machine='".$ma['id_machine']."'"));}
				if($smena1=='2' && $now>'15:40' && $now<'23:59')//вторая смена Менделев
					{ $operator=mysqli_fetch_array(mysqli_query($db,"SELECT name,operator2,Fio FROM `machine` LEFT JOIN rabotniki on operator2=rabotniki.id_rabotnika where id_machine='".$ma['id_machine']."'"));}

					
				if($smena1=='1' && $now>'07:00' && $now<'15:40')//первая смена менделев
					{ $operator=mysqli_fetch_array(mysqli_query($db,"SELECT name,operator2,Fio FROM `machine` LEFT JOIN rabotniki on operator2=rabotniki.id_rabotnika where id_machine='".$ma['id_machine']."'"));}
				if($smena1=='1' && $now>'15:40' && $now<'23:59')//вторая смена Дьяков
					{ $operator=mysqli_fetch_array(mysqli_query($db,"SELECT name,operator,Fio FROM `machine` LEFT JOIN rabotniki on operator=rabotniki.id_rabotnika where id_machine='".$ma['id_machine']."'"));}

				$task=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `task` where stanok='".$ma['id_machine']."'  and ready not like '1' limit 1"));//выбор задач для станка 
				
				$result = mysqli_query($db2,"SELECT `READING_TIME`,`TAG_DATA`,`DEVICE_NUMBER`,`machine`.`name`,`machine`.`remont` FROM `MTH_RAW_DATA` LEFT JOIN ceh2.machine ON `DEVICE_NUMBER`=`machine`.`id_machine` WHERE DEVICE_NUMBER='".$ma['id_machine']."'  AND TAG_CODE NOT LIKE 'DOWN' AND READING_TIME >= CURDATE() ORDER BY `MTH_RAW_DATA`.`READING_TIME` DESC")or die(mysqli_error());//выборка статусов по станку
				$resarr = mysqli_fetch_array($result);
				$status=$resarr['TAG_DATA'];
				$time=$resarr['READING_TIME'];
				
				
				
				foreach($result as $row) //перебираю статусы станка;
						{if ($status == $row['TAG_DATA']) { $start=$row['READING_TIME'];} else {break;}	}	
						
					$interval=(strtotime($time)-strtotime($start)-10800);
					
					$interval_c=date('H',$interval);
					$interval_m=date('i',$interval);
					if ($interval_c=='00'){$interval_p='<br>'.date('i',$interval).' мин';}else{$interval_p='<br>'.date('H ч i мин',$interval);;}
					
					$stats="";					
					
					if($status=="0"){$color="black"; $fcolor="white"; $stat="<br>Выключен";}
					if($status=="1"){$color="gray"; $fcolor="white"; $stat="<br>Включен";}
					if($status=="2"){$color="green"; $fcolor="white"; $stat="<br>Работает";}
					if($status=="3"){$color="yellow"; $fcolor="black"; $stat="<br>Наладка";}
					if($status=="4"){$color="Salmon"; $fcolor="black"; $stat="<br>Остановлен";}
					if($status=="5"){$color="red"; $fcolor="white"; $stat="<br>ERROR";}					
					if($row["remont"]=="1"){$bg="background-color: #333;"; $rem="<br>РЕМОНТ"; $operator['Fio']='';$stat='';$interval_p=''; }else{$bg=""; $rem="";}					
					if(($i==1)||($i==5)||($i==9))//печатаю новую строку, по 4ре элемента 
						{echo '';}		
					Echo '
					
					<div class="item" style="background-color:'.$color.'; color:'.$fcolor.'; display:'.$display.'; ">
						<div class="s_name">'.$row["name"].'</div>
						<div class="operator">'.$operator['Fio'].'</div>
						<div class="prostoi">'.$stat.$interval_p.'</div>
						<div class="task">'/*.$task[1]*/.$rem.'</div>
					</div>';	
					if(($i==4)||($i==8)||($i==16)){echo '';}//закрываю строку, если уже 4ре элемента 							
							
												
			}
Echo '</div>';
?>
 
<div class="fixed-bottom">
	<?php include ("public/blocks/footer.php");?>
	</div>
	
</body>
</html>