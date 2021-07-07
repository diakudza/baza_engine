<?PHP
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
//include($path);
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12"><!--col-md-12-->
			
	
<?PHP

$result = mysqli_query($db,"SELECT * from machine ORDER BY `machine`.`name` ASC") or die("<br>Не могу выполнить запрос к базе станков");
$j=0;
foreach($result as $row)
{	
if($row['remont']=='1'){$color="background-color: #f74343;";$ch='checked="checked"';$remont="СТАНОК НА РЕМОНТЕ";}else{$ch='';$color="background-color: grey;";$remont='';}
$j=$j+1;
	
if(($j=='1')or($j=='4')or($j=='7'))
{ 
echo '	<div class="row"><!--11row-->'; 
}

echo '<div class="col-md-4"><!--22-->

	
				
	<table width="90%" style="'.$color.' padding:3px; margin:10px" class="window"  >
	
					<tr  align="center" style="background-color: #678dbf">
							<td colspan="3">'.$remont.'</td>
							<td colspan="3">'.$row["name"].'</td>
					</tr>
			<tr style="background-color: #678dbf">
				<td width="5%"></td>
				<td width="50%">Номер</td> 
				<td width="20%">Тип детали</td>  
				<td width="20%">Колво</td>  
				<td width="30%">Коммент</td>
				<td width="5%">Готово</td>
			</tr>
	</thead>
	'; 

   
	$i=0;
		foreach(mysqli_query($db,"SELECT task.id,task.mk,task.kolvo,task.ready,task.comm,machine.name,tip_detali.TypeDetail FROM task LEFT JOIN machine ON task.stanok=machine.id_machine LEFT JOIN tip_detali ON task.TypeDetail=tip_detali.id WHERE machine.id_machine=$row[id_machine]") as $row1)
		{
		$i=$i+1;
		if($row1["ready"]==1){$bg="background-color: green";}
		elseif(($row1["ready"]==0)&&($row1["mk"]) ){$bg="background-color: #fcece1";}
		
		else{$bg="";}
        echo '
		<tr style="'.$bg.'">
		<td>'.$i.'</td>
		<td>'.$row1["mk"].'</td> 
		<td>'.$row1["TypeDetail"].'</td>  
		<td>'.$row1["kolvo"].'</td>  
		<td>'.$row1["comm"].'</td>
		<td>'.$row1["ready"].'</td>
		</tr>';
		} 
echo '</table>
		</div><!--col-md-4-22-->';

if(($j=='3')or($j=='6')or($j=='9'))
{ 
echo '</div><!--11row-->'; 
}

}

?>



</div><!--container-fluidner -->
