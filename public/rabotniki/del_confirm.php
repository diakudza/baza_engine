<?php
session_start();
$result = mysqli_query($db,"SELECT rabotniki.Tabel,rabotniki.Fio,rabotniki.id_rabotnika,rabotniki.professia,rabotniki.data_ustr,rabotniki.status,rabotniki.dop3,foto.bindata,foto.idimg,rabotniki.Foto from rabotniki LEFT JOIN foto ON rabotniki.Foto=foto.idimg WHERE id_rabotnika='".$_GET["id_rabotnika"]."'") or die("<br>не могу.");//ORDER by ".$_GET["orderby"]."";

?>
<table border=1>
	<tr>
		<td>
			 <?php
//			 foreach($result as $row)
//			{
//
//			echo '<w><a href=".$_GET['foto']."><img src=".$_GET['foto']." width=200 height=100 /> </a>;
//			<br> <w>Имя:
//			<w>;
//
//		</td>
//		<td>
//			<tr>
//		  <td width="200">ФИО(ИвановВ.В.)</td>
//		  <td width="124"><input type="text" name="fio" size="40" maxlength="40"></td>
//		</tr>
//		<tr>
//		  <td width="200">Дата устройства (01.01.2001)</td>
//		  <td><input type="text" name="data_ustr" size="40" maxlength="10"></td>
//		</tr>
//		<tr>
//		  <td width="200">Табельный (0000)</td>
//		  <td>
//			<input type="text" name="tabel" size="40" maxlength="4" ">
//		  </td>
//		</tr>
//		<tr>
//		  <td width="200">Профессия</td>
//		  <td><input type="text" name="professia" size="40" maxlength="40"></td>
//		</tr>
//			<tr>
//		  <td width="200">Статус</td>
//		  <td><input type="text" name="status" size="40" maxlength="20" ></td>
//		</tr>
//		<tr>
//		  <td width="200">Логин</td>
//		  <td><input type="text" name="login" size="40" maxlength="20" id="foto2"></td>
//		</tr>
//		<tr>
//		  <td>Пароль</td>
//		  <td><input type="text" name="pass" size="40" maxlength="20"></td>
//		</tr>
//		<tr>
//		  <td>1-адм,2-мастер</td>
//		  <td><input type="text" name="dop" size="40" maxlength="1" id="foto4"></td>
//		</tr>
//		<tr>
//		  <td width="200">фото</td>
//		  <td><input type="file" name="foto" onClick=></td>
//		</tr>
//		<tr>
//		  <td colspan="2"><input type="submit" value="Добавить" onClick=></td>
//		</tr>
//		</td>
//
//			';}


echo "<w><a href=/public/rabotniki/del.php?deltarget2=".$_GET['deltarget'].">Удалить</a><br><br><br>";
echo "<W><a href=/public/rabotniki/rabotniki.php>назад</a>";


?>
 </table>
</div>