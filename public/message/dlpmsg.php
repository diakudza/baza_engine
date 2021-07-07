<?PHP
session_start();
error_reporting(0); 
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$idmessage = htmlspecialchars($_GET['idmessage']);
$sql_insert = mysqli_query ($db,"DELETE FROM `mesg` WHERE CONVERT(`idmessage` USING utf8) = '".$idmessage."' LIMIT 1") or die("<br>Ошибка удаления данных!!! Возможно у Вас нет прав на удаление детали!!</br>");
mysqli_close($db);
?>





