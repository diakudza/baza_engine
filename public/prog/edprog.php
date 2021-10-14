<?PHP
//session_start();
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
//nclude($_SERVER['DOCUMENT_ROOT'] . '/public/func.php');
if(($_SESSION['ad']!='1')&&($_SESSION['fio']!=$_GET['Dobavil']))
{echo "<w>У ".$_SESSION['fio']." нет прав на эту операцию ".$_SESSION['ad']."</w>";

exit;}
var_dump($_SERVER['REQUEST_URI']);
$id = htmlspecialchars($_GET['id']);
$query = mysqli_query($db,"SELECT starprogramms.id,img.idimg,img.bindata,starprogramms.nomerdetali,starprogramms.TypeMaterial, tip_detali.TypeDetail,rabotniki.fio,machine.name,starprogramms.Img,starprogramms.DiametrZagotovki,tip_detali.id as id_detali,rabotniki.Fio, material.tip,starprogramms.ProgH1Name,starprogramms.ProgH2Name,starprogramms.Head1,starprogramms.Head2,starprogramms.Opisanie, starprogramms.Date_time FROM starprogramms LEFT JOIN machine ON starprogramms.stanok=machine.id_machine LEFT JOIN tip_detali ON starprogramms.TypeDetail=tip_detali.id LEFT JOIN material ON starprogramms.Material=material.idmaterial LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika  LEFT JOIN img ON starprogramms.img=img.idimg WHERE starprogramms.id='".$id."'" )or die(mysqli_error());
$row = mysqli_fetch_array($query)or die(mysqli_error());
mysqli_close($db); ?>

<form enctype="multipart/form-data"  id="filtr" class="window edit center">
 <input type="hidden" name="Dobavil" value="<?PHP echo $_GET['Dobavil'];?>" />
 <input type="hidden" name="id" value="<?PHP echo $id;?>" />
        <div class="view-left center" >
		
		<input name="nomerdetali" class="form-control form-control-sm margin_t_b_10" type="text" id="textfield3" value="<?PHP echo $row["nomerdetali"];?>" size="30" style="width: 90%; marker-top: 40px; "/>
						 
						   <select name="TypeDetail" id="select2" style="width: 90%" class="custom-select custom-select-sm margin_t_b_10">
						   <option name="TypeDetail" value="<?php echo $row["id_detali"];?>" selected><?php echo $row["TypeDetail"];?></option>
							<?php foreach(selecttip() as $row1) {echo '<option name="TypeDetail" value="'.$row1["id"].'">'.$row1["TypeDetail"].'</option>';	}?>
						   </select>
					  
						
							<input type="file" class="margin_t_b_10" name="Img" id="button2" value="Img" style="width: 90%;"/>
							
							<img class="margin_t_b_10" src="data:image/jpeg;base64,<?PHP echo base64_encode($row['bindata']);?>" style="width: 90%;">
							
							<!--<input type="radio" name="RG1" value="nomer" id="RadioGroup1_" />Номер
							<input type="radio" name="RG1" value="gost" id="RadioGroup1_2" />ГОСТ
							<input type="radio" name="RG1" value="ost" id="RadioGroup1_3" />ОСТ
							<input type="radio" name="RG1" value="tip" id="RadioGroup1_6" />Типовая-->
						
                <textarea name="Opisanie" class="margin_t_b_10" cols="40" rows="7" id="textfield6" style="width: 90%;"><?PHP echo $row["Opisanie"];?></textarea>
        </div>  
         
		<div class="view-right">
			<div style="width: 49%; height:100%;">
				Номер 1<input name="ProgH1Name" type="text" id="textfield11" value="<?PHP echo $row["ProgH1Name"];?>" />
				<textarea name="Head1" style="width:100%;height:90%;border-radius: 5px;" cols="50" rows="40" id="textfield7" ><?PHP echo $row['Head1'];?></textarea>
			</div>
			<div style="width: 49%; height:100%;">
				Номер 2<input name="ProgH2Name" type="text" id="textfield10" value="<?PHP echo $row["ProgH2Name"];?>" />
				<textarea name="Head2" style="width:100%;height:90%;" cols="50" rows="40" id="textfield5" ><?PHP echo $row['Head2'];?></textarea>
				<input type="submit" name="button" id="button" class="btn btn-secondary btn-sm "  value="Добавить" />
				<input type="reset" name="Назад" id="Назад" class="btn btn-secondary btn-sm "  value="Сброс" />
		   </div>
        </div>	
		
          
        
 
 

</form>
<!-- <script>
		$(document).ready(function(){  
			var content = document.getElementById("content");
			
			 $('#filtr').on('submit',(function(e) {
						e.preventDefault();
					 
						var formData = new FormData(this);
					 
						$.ajax({
						  type:'POST', 
						  url: 'public/prog/updprog.php', // Скрипт обработчика
						  data: formData, // Данные которые мы передаем
						  cache:false, 
						  contentType: false,
						  processData: false, 
						  success:function(html){
							$("#content").html(html);
						  },
						  error:function(html){
							console.log(html);
						   }
					});
				  }));
						
					
          
            });  
              
        
	</script> -->
