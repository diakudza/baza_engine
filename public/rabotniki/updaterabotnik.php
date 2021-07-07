<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
$sql_insert = mysqli_query ($db,"UPDATE rabotniki SET `Tabel`='".$_POST["tabel"]."', `Fio`='".$_POST["fio"]."', `professia`='".$_POST["professia"]."', `data_ustr`='".$_POST["data_ustr"]."',`login`='".$_POST["login"]."',`pass`='".$_POST["pass"]."',`dop3`='".$_POST['dop3']."',`status`='".$_POST['status']."', `chatid`='".$_POST['chatid']."', `smena`='".$_POST['smena']."' WHERE `id_rabotnika`='".$_POST["id_rabotnika"]."'") or die("<br>Ошибка добавления данных!!! Возможно у Вас нет прав на редактирование пользователей!!");

echo "<w>Изменен :  ".$_POST["fio"]." ".$_POST["professia"]."";

mysqli_close($db); 

?>

