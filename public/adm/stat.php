<?PHP
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Топчик</title>
<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css">
</head><body>
<table  border="1" cellspacing="1" cellpadding="2" class="window">
<?PHP

$result = mysqli_query($db,"SELECT rabotniki.fio,rabotniki.id_rabotnika from rabotniki") or die("<br>Не могу выполнить запрос к базе станков");

foreach($result as $row)
{
	echo '
		<tr>
		<td>'.$row["fio"].'</td>';
			$prog = mysqli_query($db,"SELECT dobavil FROM starprogramms WHERE dobavil='".$row['id_rabotnika']."'" ) or die("<br>Не могу выполнить запрос к базе станков");
			
			echo '<td bgcolor="red">'.mysqli_num_rows($prog).'</td>';
			

 
}
mysqli_close($db);
?>
</table>




</body></html>