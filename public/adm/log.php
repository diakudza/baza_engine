<?PHP
session_start();
include "../config/connect.php";
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>логи</title>
<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css">
</head><body>
<table width="100%" border="1" cellspacing="1" cellpadding="2" class="window">
<?PHP

$result = mysqli_query($db,"SELECT * from login ") or die("<br>Не могу выполнить запрос к базе станков");

foreach($result as $row)
{
echo '
<tr>
<td>'.$row["date"].'</td>
<td>логин:'.$row["login"].'</td>
<td width="60%">инфо:'.$row["info"].'</td>
<td>статус:'.$row["ok"].'</td>
</tr>'; 
}
      


mysqli_close($db);
?>
</table>




</body></html>