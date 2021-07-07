<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
?>

<table border="1" align="center" cellspacing="" class="window forma">
      
<?php $result = mysqli_query($db,"SELECT rabotniki.Tabel,rabotniki.Fio,rabotniki.id_rabotnika,rabotniki.professia,rabotniki.data_ustr,rabotniki.status,rabotniki.dop3,foto.bindata,foto.idimg,rabotniki.Foto from rabotniki LEFT JOIN foto ON rabotniki.Foto=foto.idimg") or die("<br>не могу.");//ORDER by ".$_GET["orderby"]."";

echo '
			
			<tr>
			
			<th>Фото</th>
			<th>таб</th>
			<th>ФИО</th>
			
			<th>Должность</th>
			<th>Дата устройства</th>
			<th>Cтатус</th>
			';
			foreach($result as $row)
				{
					echo '
						<tr height=100 width=100 align=center ">
						<td><img src=data:image/jpeg;base64,'.base64_encode($row['bindata']).' width=150 height=130 /></a></td> 
						<td>'.$row["Tabel"].'</td> 
						<td>'.$row["Fio"] .'</td> 
						<td>'.$row["professia"].'</td>
						<td>'.$row["data_ustr"].'</td>
						<td>'.$row["status"].'</td>
						<td><button id="'.$row['id_rabotnika'].'" onClick="rabotniki(this.id)" class="btn btn-sm btn-danger"><w>EDIT</button></td>
						</tr>'; 
				}


mysqli_close($db);
?>
<button id="add" onClick="addRabotniki(this.id)" class="btn btn-sm btn-secondary">Добавить работника</button>		
</table>
	
	<script>
	
	function rabotniki(clicked) {
						
						var t = clicked;
								$.ajax({ 
								url: "public/rabotniki/edit_rabotnik.php",
								method: "GET", 
								cache:false,							
								data: {"id_rabotnika": t},
								success:function(html)
									{
										$("#content").html(html);
									}
							 
						 });
						
				
				}


function addRabotniki(clicked) {
	var t = clicked;
			
				$.ajax(
				{
					url: "public/rabotniki/formrabotnik.php",
					cache: false,
					success: function(html)
					{
						$("#content").html(html);
					}
				});
			};
	

					


</script>      

			
	