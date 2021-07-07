<?PHP
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/connect2.php");
?>	

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="10">

<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css">
<title>статус станков</title>
<body>

<?php
date_default_timezone_set('Europe/Moscow');
$now=date('H:i');


if(isset($_GET['int'])){

	 {$interval=$_GET['int'];}
}
else {$interval=100;}

echo "<h1><w>",$now;
	if((($now>'13:00')&&($now<'13:40'))||(($now>'19:00')&&($now<'19:30'))) {echo "<h1><w>Обед"; }
	
	$id_machine = mysqli_query($db,"SELECT id_machine,name from machine")or die(mysqli_error("ERROR"));
    
	
		Echo 	'<div id=timeline><table width="100%"  border="0" align="centr" cellspacing="1" style="font-size:20px;">
				<tr><td align="center">Станки</td><td></td></tr>';
			
		if($row["remont"]=="1"){$bg="background-color: #333;"; $rem="РЕМОНТ";  }else {$bg=""; $rem="";}
		
	foreach($id_machine as $rob)
	{
		Echo '<tr align="center"><td style="width:10%">'.$rob["name"].'</td>';
		
		    $result = mysqli_query($db2,"SELECT `READING_TIME`,`TAG_DATA`,`DEVICE_NUMBER`,`TAG_CODE`,`machine`.`name`,`machine`.`remont` FROM `MTH_RAW_DATA` LEFT JOIN ceh2.machine ON `DEVICE_NUMBER`=`machine`.`id_machine` WHERE DEVICE_NUMBER='".$rob['id_machine']."' AND `TAG_CODE`<>'STATN' ORDER BY `MTH_RAW_DATA`.`READING_TIME` DESC limit ".$interval."")or die(mysqli_error("ERROR"));
			
			foreach($result as $row)
			
				{	$stat='';						
					if($row["TAG_DATA"]=="0"){$color="black"; $fcolor="white"; $stat="Выключен";}
					if($row["TAG_DATA"]=="1"){$color="gray"; $fcolor="white"; $stat="Включен";}
					if($row["TAG_DATA"]=="2"){$color="green"; $fcolor="white"; $stat="Работает";}
					if($row["TAG_DATA"]=="3"){$color="yellow"; $fcolor="black"; $stat="Наладка";}
					if($row["TAG_DATA"]=="4"){$color="Salmon"; $fcolor="black"; $stat="Остановлен";}
					if($row["TAG_DATA"]=="5"){$color="red"; $fcolor="black"; $stat="ERROR";}
					if ((($row["READING_TIME"]>'13:00')&&($row["READING_TIME"]<'13:40'))||((Date('H:i',$row["READING_TIME"])>'21:00')&&(Date('H:i',$row["READING_TIME"])<'22:30'))){$color="BLUE"; }
					echo '<td style="font-size:10px;" bgcolor="'.$color.'" title="'.$stat.' '.Date('H:i',$row["READING_TIME"]).'"><font color='.$fcolor.'></font></td>';
						
				}	

					
					
					
				
		Echo '</tr><tr><td> </td></tr>';
						
	}
	echo '<tr>';
	
	echo '<td></td>';
		foreach($result as $row) {
			$time=strtotime($row["READING_TIME"]);
			echo '<td style="font-size:10px; writing-mode: vertical-rl;">'.Date('H:i',$time).'</td>';
		}
	Echo '</tr></table></div>';
?>
<form id="form">
<input name="int" type="text" value="<?php echo $interval ?>" size="5" maxlength="5"/>
<input type="submit" name="button" id="button" value="Изменить" />
</form>
<div class="fixed-bottom">
	<?php include($_SERVER['DOCUMENT_ROOT'] . "/public/blocks/footer.php");?>
	</div>
</body>
<script>
							
		$(document).ready(function(){  
			
			var content = document.getElementById("content");
			 $('#form').on('submit',(function(e) {
						e.preventDefault();
					 
						var formData = new FormData(this);
					 
						$.ajax({
						  type:'GET',
						  url: '/../public/test/table.php', // Скрипт обработчика
						  data: formData, // Данные которые мы передаем
						  cache:false, 
						  contentType: false,
						  processData: false, 
						  success:	function(data){
							$("#content").html('<w>Добавлена');
						  },
						 error:function(html){
							console.log(html);
						   }
					});
				  }));
							
			
			
            }); 
					
	</script>
</html>