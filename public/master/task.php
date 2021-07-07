<?PHP
session_start();
?>

  
<div class="task-list-container">
		<form name="form" class="task-list_allform" method="post" action="public/master/addtask.php">
			<div class="task-list">
			<?PHP
			$k=0;
			$result = mysqli_query($db,"SELECT * from machine ORDER BY `machine`.`name` ASC") or die("<br>Не могу выполнить запрос к базе станков");
			foreach($result as $row){
				$k=$k+1;
			if($row['remont']=='1'){$color="background-color:#f74343;";$ch='checked="checked"';}else{$ch='';$color="background-color: #DCDCDC;";}
					
			echo '<table class="window task-list_form" style="'.$color.'">
					<tr  align="center">
					
						<td colspan="2" style="text-align:left;"><input type="checkbox" name="'.$row["id_machine"].'remont'.'" value="1"  '.$ch.'>ремонт</td>
						<td colspan="4">id:'.$row["id_machine"].'  Станок:'.$row["name"].'</td>
					</tr>
					<tr  align="center">
						<td >id</td>
						<td >Номер</td>
						<td >Тип</td>
						<td >Колво</td>
						<td >Коммент</td>
						<td >ок</td>
					</tr>
					<input type="hidden" name="Stanok_'.$row["id_machine"].'" value="'.$row["id_machine"].'" />';


		$task = mysqli_query($db,"SELECT task.id,machine.id_machine,tip_detali.id,task.mk,task.comm,task.TypeDetail,task.kolvo,task.ready,machine.name,tip_detali.TypeDetail FROM task LEFT JOIN machine ON task.stanok=machine.id_machine LEFT JOIN tip_detali ON task.TypeDetail=tip_detali.id WHERE machine.id_machine=$row[id_machine]"); 

		if(mysqli_num_rows($task)<1){
		echo '  <td><input name="mk" type="text" /><input name="comm" type="text" /></td>';}

			$i=0;
			foreach($task as $row1){
			
									$i=$i+1;
									$col=mysqli_num_rows($task);
										 
											echo '	<tr>
														<td>'.$i.'</td>
														<td><input type="text" name="'.$row1["id_machine"].'mk'.$i.'" id="textfield" value="'.$row1["mk"].'"></td>
														<td><select  style="width:100px;" name="'.$row1["id_machine"].'tip'.$i.'" id="select2"><option value="'.$row1["id"].'">'.$row1["TypeDetail"].'</option>';
												 echo '<option></option>';
														foreach(selecttip() as $row3)
															{echo '<option value="'.$row3["id"].'">'.$row3["TypeDetail"].'</option>';	}
															if ($row1["ready"]=='1'){$ch='checked="checked"';}else{$ch='-';}
															echo'
																</select></td>
																
																<td><input type="text" style="width:30px;" name="'.$row["id_machine"].'kolvo'.$i.'" id="textfield2" value="'.$row1["kolvo"].'"></td>
																</select></td>
																<td><input type="text" name="'.$row["id_machine"].'comm'.$i.'" id="textfield2" value="'.$row1["comm"].'" ></td>
																<td><input type="checkbox" name="'.$row["id_machine"].'ready'.$i.'" id="textfield2" value="'.$row1["ready"].'" '.$ch.'></td>
																														
													</tr>';
										
									}	
			   $j=$i;
			while ($j<10):
				
				  $j=$j+1;
				 echo '<input type="text" name="'.$row1["id_machine"].'mk'.$j.'" id="textfield" value="'.$row1["mk"].'"></td>
				    	<input type="text" name="'.$row1["id_machine"].'comm'.$j.'" id="textfield2" value="'.$row1["comm"].'"></td>
						<br>';
			endwhile;
			
			 echo '<tr>
					<td></td>
						<td align="right" colspan="6"><input type="checkbox" name="'.$row["id_machine"].'clear'.'" value="1">очистить</td>
					</tr>
					</table>';


		}

		?>	
	</div>
	 <div class="task-list_button">
		<input type="submit" name="button"  class="btn btn-secondary btn-sm " id="button" value="Добавить" />
	</div> 

			</form>
		
</div>	
	

<script>
		$(document).ready(function(){  
			
			var content = document.getElementById("content");
			 $('form').on('submit',(function(e) {
						e.preventDefault();
					 
						var formData = new FormData(this);
					 
						$.ajax({
						  type:'POST',
						  
						  url: 'public/master/addtask.php', // Скрипт обработчика
						  data: formData, // Данные которые мы передаем
						  cache:false, 
						  contentType: false,
						  processData: false, 
						  success:	function(data){
							$("#content").html('<w>Готово');
						  },
						 error:function(html){
							console.log(html);
						   }
					});
				  }));
							
			
			
            });  
              
        
	</script>
</html>







 