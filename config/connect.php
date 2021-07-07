<?PHP
//require_once('config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//$db = mysqli_connect("localhost","u1300371_default","U4y_PGGs","u1300371_default");

$db = mysqli_connect(HOST,USER,PASS,DB);
mysqli_query($db, "set character_set_results='utf8'");
mysqli_query($db, "SET CHARACTER SET 'utf8';");
mysqli_query($db, "set collation_connection='utf8_general_ci'");

if (!$db)
{
echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
exit;
}
?>
