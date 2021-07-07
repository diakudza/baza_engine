<?PHP
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$result = mysqli_query($db,"SELECT mesg.idmessage,mesg.message,mesg.id_rabotnika,mesg.date,mesg.id_stanka,machine.name,rabotniki.fio FROM mesg LEFT JOIN machine ON mesg.id_stanka=machine.id_machine LEFT JOIN rabotniki ON mesg.id_rabotnika=rabotniki.id_rabotnika")or die(mysqli_error());
?>


<table border="1" align="center"  >
  <tr>
  <th style="width: 10%">Станок</th>
  <th style="width: 60%">message</th>
  <th style="width: 10%">кто отправил</th>
  <th style="width: 10%">date</th>
  <th style="width: 10%"></th>
  </tr>      

<?php
	foreach($result as $row)
	{
	echo '
		<tr align="center">
			<td >'.$row['name'].'</td>
			<td >'.$row['message'].'</td>
			<td >'.$row['fio'].'</td>
			<td >'.$row['date'].'</td>
			<td ><button id="'.$row['idmessage'].'" onClick="check(this.id)" class="btn btn-sm btn-danger"><w>X</button></td>
		</tr>';
	}
	print "</table>";
?>

</table>