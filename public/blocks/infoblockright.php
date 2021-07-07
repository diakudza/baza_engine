<?php

$nam = mysqli_num_rows(mysqli_query($db,"SELECT starprogramms.id FROM starprogramms"));
$row = mysqli_query($db,"SELECT starprogramms.id,starprogramms.Date_time,starprogramms.nomerdetali,rabotniki.Fio,rabotniki.id_rabotnika,rabotniki.foto FROM starprogramms LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika LEFT JOIN foto ON rabotniki.foto=foto.idimg WHERE (SELECT MAX(`id`) FROM `starprogramms` ORDER BY `starprogramms`.`id`) ORDER BY `starprogramms`.`id` DESC LIMIT 3");


?>
<div class="info-block-right">
<h6>
	<w>
		<br>Колличество программ в базе: <p style="color:#1d9de5";><?php echo $nam; ?></p>
		<br>Три последних добавленных: 
		<?php foreach ($row as $row1) {
		echo '<br><p id="'.$row1["id"].'" style="color:#1d9de5"; onClick="check(this.id)">'.$row1["Date_time"].' '.$row1["nomerdetali"].' '.$row1["Fio"].'</p>'; } ?>
</h6>

<script>
							
		function check(clicked) {
						var content = document.getElementById("content");
						var t = clicked;
						$.ajax({ 
								url: "/public/prog/view.php",
								method: "GET", 
							
							 
							cache:false,							
								data: {"id": t},
								success:function(html)
									{
										$("#content").html(html);
									}
							 
						 });
						
				
				}		
					
	</script>     
	
</div>	