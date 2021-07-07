<?PHP
session_start();
error_reporting(0); 
if(($_SESSION['ad']!='1')&&($_SESSION['fio']!=$_GET['Dobavil']))
{echo "<w>У ".$_SESSION['fio']." нет прав на эту операцию ".$_SESSION['ad'];

exit;}
?>


<?PHP
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$id = htmlspecialchars($_GET['id']);
$sql_insert = mysqli_query ($db,"DELETE FROM `starprogramms` WHERE CONVERT(`id` USING utf8) = '".$id."' LIMIT 1") or die("<br>Ошибка удаления данных!!! Возможно у Вас нет прав на удаление детали!!</br>");
mysqli_close($db);
echo "<w>Вы удалили: ".$id."</br>";
?>





