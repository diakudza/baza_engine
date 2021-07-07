<?PHP
session_start();
$Dodavil = $_SESSION['userid'];
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

?>




<form class="window form_add_main center" enctype="multipart/form-data" id="filtr">

	<div class="form_add_top">
		<input name="Dobavil" type="hidden" value="<?php echo $Dodavil;?>" />
			<div>
			
			<input name="nomerdetali"  class="form-control form-control-sm" style="width: 50%" type="text" id="textfield3" placeholder="Номер детали" value="Номер детали" size="40" />
			
			<select name="TypeDetail" id="select2" style="width: 25%" class="custom-select custom-select-sm">
				<option>Тип детали</option>
				<?php foreach(selecttip() as $row1)
				{echo '<option value="'.$row1["id"].'">'.$row1["TypeDetail"].'</option>';	}?>
			</select>
			
			<select name="Stanok" style="width: 25%" class="custom-select custom-select-sm" id="Stanok12" placeholder="O0001 HD1">
				  <option>Станок</option>
					<?php foreach(selectstanki() as $row1)
					{echo '<option value="'.$row1["id_machine"].'">'.$row1["name"].'</option>';	}?>
			</select>
			</div>
			
			<div>
			<select name="Material" id="select2" style="width: 50%" class="custom-select custom-select-sm">
				<option>Марка метриала</option>
				<?php foreach(selectmat() as $row1)
					{echo '<option value="'.$row1["idmaterial"].'">'.$row1["tip"].'</option>';	}?>
			</select>
		   
			<input name="DiametrZagotovki" type="text" id="textfield10"  value="10.0" class="form-control form-control-sm d-inline-block" style="width: 25%"/>
			<select name="tipmat" id="tipmat" class="custom-select custom-select-sm d-inline-block" style="width: 25%" >
				<option>Кк.</option>
				<option>Шк.</option>
			</select>
		</div>            
				  
			
	</div> 

	<div class="form_add_middle border center">
				
		
				  
				  
					<textarea name="Opisanie" style="width: 100%; border-radius: 5px;"cols="53" rows="7" class="tex" id="textfield6">Описание</textarea>
				  
	</div>   
			   
	<div class="border form_bottom">    
		
			<div class="form_add_check">
				<label><input name="ftpch1" type="radio" id="RadioGroup1_0" value="disk"  checked="checked" /> С диска</label>
				<label><input type="radio" name="ftpch1" value="ftp"  id="RadioGroup1_1" /> Из папки на FTP сервере</label>
			</div>
		

		<div style="display:flex; justify-content: space-between;">
			<div class="local border">
					HD1<input type="file" style="width: 100px;" name="Head1" id="button2" value="Head1" /><br>
					HD2<input type="file" style="width: 100px;" name="Head2" id="button3" value="Head2" />
			
			</div>
			
			
			<div class="form_add_ftp border">
				<select name="ftpdir" id="select2" class="custom-select custom-select-sm">
					<option></option>
					<?php foreach(selectstanki() as $row1)
					{echo '<option value="'.$row1["id_machine"].'">'.$row1["name"].'</option>';	}?>
					</select>
					<input name="prog1" type="text" id="textfield" value="" class="form-control form-control-sm" placeholder="O0001 HD1" size="10" maxlength="10" />
					<input name="prog2" type="text" id="textfield" value="" class="form-control form-control-sm" placeholder="O0002 HD2" size="10" maxlength="10" />
			</div>	
		</div>	
		
		загрузка IMG <input type="file"  name="Img" id="button4" value="" class="btn btn-secondary btn-sm"	/>
			
		
	  
	</div> 
	<div class="form_add_bottom" style="display:flex; justify-content: end;">
			<input type="submit"  name="button" id="button" class="btn btn-secondary btn-sm " value="Добавить" />
			<input type="reset" name="Назад" id="Назад" class="btn btn-danger btn-sm" value="Сброс" />
		</div>     
</form>
<script>
		$(document).ready(function(){  
			
			var content = document.getElementById("content");
			 $('#filtr').on('submit',(function(e) {
						e.preventDefault();
					 
						var formData = new FormData(this);
					 
						$.ajax({
						  type:'POST',
						  //method: "POST", 
						  url: 'public/prog/addform.php', // Скрипт обработчика
						  data: formData, // Данные которые мы передаем
						  cache:false, 
						  contentType: false,
						  processData: false, 
						  success:	function(data){
							$("#content").html('<w>Добавлена');
						  },
						 error:function(html){
							console.log(html);
						   }
					});
				  }));
							
			
			
            });  
              
        
	</script>

