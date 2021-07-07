<?PHP
$d=mysqli_query($db,"SELECT id_machine FROM `machine`")or die(mysqli_error());

foreach($d as $row)
	{
		
		$oper1=$_POST[$row['id_machine'].'operator'];
		$oper2=$_POST[$row['id_machine'].'operator2'];
				
		mysqli_query($db,"UPDATE machine SET `operator`='$oper1',`operator2`='$oper2' WHERE `id_machine`='".$row['id_machine']."' ");
	};
echo "<w>Готово";
?>
   












