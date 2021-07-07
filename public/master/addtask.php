<?PHP
session_start();
error_reporting(0); 
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$data1 = date("d.m.Y");
//print_r ($_POST);
$d=mysqli_query($db,"SELECT id_machine,name FROM `machine`")or die(mysqli_error());


$i=0;
foreach($d as $row)
	{
		$i=$i+1;
		$id=mysqli_fetch_array(mysqli_query($db,"SELECT `task`.`id`,`machine`.`remont` FROM `task` left join `machine` on task.stanok=machine.id_machine WHERE `stanok`=".$row['id_machine'].""))or die(mysqli_error());
		$id=$id[0]-1;
		
			if($_POST[$row['id_machine']."remont"]=='1')
						{$remont='1';}
					else 
						{$remont='0';}
					mysqli_query($db,"UPDATE machine SET remont='$remont' WHERE `id_machine`='".$row['id_machine']."'");
			
			for ($j=1; $j<11; $j=($j+1)) 
				{
				$mk=$_POST[$row['id_machine']."mk".$j];
				$comm=$_POST[$row['id_machine']."comm".$j];
				$tip=$_POST[$row['id_machine']."tip".$j];
				$kolvo=$_POST[$row['id_machine']."kolvo".$j];
				$ready=$_POST[$row['id_machine']."ready".$j];
				
				
				if($ready=='') {$ready='0';} else {$ready='1';}
			
				$id=$id+1;
				mysqli_query($db,"UPDATE task SET `mk`='$mk',`comm`='$comm',`kolvo`='$kolvo',`ready`='$ready',`date`='$data1',`TypeDetail`='$tip' WHERE `stanok`='".$row['id_machine']."' AND `id`='".$id."'");
				}
				
			if($_POST[$row['id_machine']."clear"]=='1')
						{echo '<br><w>выполнил очистку для ',$row['name'];
				
			mysqli_query($db,"UPDATE task SET `mk`='', `ready`='0',`comm`='',`TypeDetail`='',`kolvo`='',`id_img`='',`date`='' WHERE `stanok`='".$row['id_machine']."'");}
			
	}
?>
   












