<?php
session_start();
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$result = mysqli_query($db,"SELECT rabotniki.Tabel,rabotniki.Fio,rabotniki.id_rabotnika,rabotniki.professia,rabotniki.data_ustr,rabotniki.status,rabotniki.dop3,rabotniki.login,rabotniki.pass,rabotniki.chatid,foto.bindata,foto.idimg,rabotniki.Foto,rabotniki.smena from rabotniki LEFT JOIN foto ON rabotniki.Foto=foto.idimg WHERE id_rabotnika='".$_GET["id_rabotnika"]."'") or die("<br>не могу.");//ORDER by ".$_GET["orderby"]."";
?>

<form id="formUpdate" method="post" enctype="multipart/form-data">

<table border="1" align="center" cellspacing="" class="window forma">
<tr>
	<td>
	<?php 
		 foreach($result as $row)
			{
			
			echo '
			<input name="id_rabotnika" type="hidden" value="'.$row['id_rabotnika'].'" />
			<img src=data:image/jpeg;base64,'.base64_encode($row['bindata']).' width=150 height=130 />
			<td>
				<tr>
			  <td width="200">ФИО(ИвановВ.В.)</td>
			  <td width="124"><input type="text" name="fio" value="'.$row["Fio"].'" size="40" maxlength="40"></td>
			</tr>
			<tr>
			  <td width="200">Дата устройства (01.01.2001)</td>
			  <td><input type="text" name="data_ustr" value="'.$row["data_ustr"].'" size="40" maxlength="10"></td>
			</tr>
			<tr>
			  <td width="200">Табельный (0000)</td>
			  <td>
				<input type="text" name="tabel" size="40" value="'.$row["Tabel"].'" maxlength="6" ">
			  </td>
			</tr>
			<tr>
			  <td width="200">Профессия</td>
			  <td><input type="text" name="professia"  value="'.$row["professia"].'" size="40" maxlength="40"></td>
			</tr>
				<tr>
			  <td width="200">Статус</td>
			  <td><input type="text" name="status" size="40" value="'.$row["status"].'" maxlength="20" ></td>
			</tr>
			<tr>
			  <td width="200">Логин</td>
			  <td><input type="text" name="login" size="40" value="'.$row['login'].'" maxlength="20" id="foto2"></td>
			</tr>
			<tr>
			  <td>Пароль</td>
			  <td><input type="text" name="pass" value="'.$row['pass'].'" size="40" maxlength="20"></td>
			</tr>
			<tr>
			  <td>1-адм,2-мастер</td>
			  <td><input type="text" name="dop3" size="40" value="'.$row["dop3"].'" maxlength="1" id="foto4"></td>
			</tr>
			<tr>
			  <td>chatid</td>
			  <td><input type="text" name="chatid" size="40" value="'.$row["chatid"].'" maxlength="13" ></td>
			</tr>
			<tr>
			  <td>Смена</td>
			  <td><input type="text" name="smena" size="40" value="'.$row['smena'].'" maxlength="1" ></td>
			</tr>
			
			<tr>
			  <td colspan="2">
			  <button id="'.$row['id_rabotnika'].'"  onClick="updateRabotnik(this.id)" class="btn btn-sm btn-secondary">Изменить</button>

			<button id="'.$row['id_rabotnika'].'" onClick="delRabotnik(this.id)" class="btn btn-sm btn-danger">Удалить</button>
			  </td>
			</tr>
			</td>

			';}


?>
 </table>
</form>
<script>
							
		function updateRabotnik(clicked) {
			$('#formUpdate').on('submit',(function(e) {
						e.preventDefault();
						var content = document.getElementById("content");
						var t = clicked;
						var formData = new FormData(this);
						$.ajax({ 
							url: "public/rabotniki/updaterabotnik.php",
							method: "POST", 
							cache:false,
							contentType: false,
							processData: false, 							
							data: formData,
								success:function(html)
									{
										$("#content").html(html);
									},
							 error:function(html){
								console.log(html);
						   }
							 
						 });
						}));
		};
				
		

		function delRabotnik(clicked) {
						var content = document.getElementById("content");
						var t = clicked;
						
						$.ajax({ 
								url: "public/rabotniki/del.php",
								method: "GET", 
								cache:false,							
								data: {"id_rabotnika": t},
								success:function(html)
									{
										$("#content").html(html);
									}
							 
						 });
						
				
				}


	</script>
