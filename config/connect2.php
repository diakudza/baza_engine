<?PHP
//require_once('config.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db2 = mysqli_connect("localhost","u1300371_status","isdn1234","u1300371_status");
mysqli_query($db2, "set character_set_results='utf8'");
mysqli_query($db2, "SET CHARACTER SET 'utf8';");
mysqli_query($db2, "set collation_connection='utf8_general_ci'");

if (!$db2)
{
echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
exit;
}
?>
