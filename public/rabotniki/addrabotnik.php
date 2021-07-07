<?php
session_start();
?>


<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
$data = date("d.m.Y");
if ($_FILES['foto']['size']>0)
{ echo "Есть";
$id=mysqli_fetch_array(mysqli_query($db,"SELECT MAX( `idimg` )FROM `foto`  WHERE 1"))or die(mysqli_error());
$idimg=$id[0]+1;
$img = addslashes(file_get_contents($_FILES['foto']['tmp_name'])) or die ('<br>Файл изображения не выбран, поле будет пустое');
$ImgSize = $_FILES['foto']['size'];
$sql="INSERT INTO foto (idimg,bindata,size,date) VALUES('$idimg', '$img', '$ImgSize', '$data')";
mysqli_query ($db,$sql) or die (mysqli_error());
}
else
{ 
$idimg="0"; 
}

$sql_insert = mysqli_query ($db,"INSERT INTO rabotniki (Foto, Tabel, Fio, professia, data_ustr,login,pass,dop3,status,smena) values('".$idimg."', '".$_POST["tabel"]."', '".$_POST["fio"]."','".$_POST["professia"]."', '".$_POST["data_ustr"]."', '".$_POST["login"]."', '".$_POST["pass"]."', '".$_POST["dop3"]."', '".$_POST["status"]."', '".$_POST["smena"]."')") or die("<br>Ошибка добавления данных!!! Возможно у Вас нет прав на редактирование пользователей!!</br>");
echo "<w>Добавлен :  ".$_POST["fio"]." ".$_POST["professia"]."";
mysqli_close($db); 
?>












