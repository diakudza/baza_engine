<?PHP
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$id = htmlspecialchars($_GET['id']);
$row = mysqli_fetch_array(mysqli_query($db,"SELECT starprogramms.id,img.idimg,img.bindata,starprogramms.nomerdetali,starprogramms.TypeMaterial, tip_detali.TypeDetail,rabotniki.fio,machine.name,starprogramms.Img,starprogramms.DiametrZagotovki,tip_detali.TypeDetail,rabotniki.Fio, material.tip,starprogramms.ProgH1Name,starprogramms.ProgH2Name,starprogramms.Head1,starprogramms.Head2,starprogramms.Opisanie, starprogramms.Date_time FROM starprogramms LEFT JOIN machine ON starprogramms.stanok=machine.id_machine LEFT JOIN tip_detali ON starprogramms.TypeDetail=tip_detali.id LEFT JOIN material ON starprogramms.Material=material.idmaterial LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika LEFT JOIN img ON starprogramms.img=img.idimg WHERE starprogramms.id='".$id."'" ))or die(mysqli_error());

mysqli_close($db);
?>

    <div class="window view center">
	<input type="hidden" name="id" id="<?PHP echo $id;?>" />
		<div class="view-left border">
			<div style="width:80%;" >
			<?php echo "<br>id:",$row['id'];?>
				<?php echo "<br>Номер детали: ",$row['nomerdetali'];?>
				<?php echo "<br>Тип детали: ",$row['TypeDetail'];?>
			</div>
			<img src="<?php echo 'data:image/jpeg;base64,',base64_encode($row['bindata']);?>" style="margin-top:25px; border-radius: 5px; width:90%;">
			<div style="width:80%;" >
				<!-- <input type="radio" name="RG1" value="nomer" id="RadioGroup1_" />Номер
				<input type="radio" name="RG1" value="gost" id="RadioGroup1_2" />ГОСТ
				<input type="radio" name="RG1" value="ost" id="RadioGroup1_3" />ОСТ
				<input type="radio" name="RG1" value="tip" id="RadioGroup1_6" />Типовая-->
				
				<?php echo "<br>Добовил: ",$row['fio'];?>
				<?php echo "<br>Станок: ",$row['name'];?>
				<?php echo "Материал<br>Сплав:",$row['tip'];?>
				<?php echo " ",$row['DiametrZagotovki']," ",$row['TypeMaterial'];?>				  				  
			</div>			
			  
			<textarea name="Opisanie" style="width:90%;" cols="40" rows="7" id="textfield6"><?php echo $row['Opisanie'];?></textarea>
			
			<div class="view-button">
				   <button id="btnsave" class="btn btn-sm btn-secondary" ><w>Save</button>                              
				   <button id="btnedit" class="btn btn-sm btn-secondary" ><w>EDIT</button>                              
				   <button id="btnftp" class="btn btn-sm btn-secondary" ><w>FTP</button>                              
				   <button id="btndel" class="btn btn-sm btn-danger"><w>Del</button>                              
			</div>                           
             
		</div >			
		<div class="view-right">
            <div style="width: 49%;">
				<?php echo $row['ProgH1Name'];?>
				<textarea name="Head1" style="width:100%;height:90%;" rows="40" id="textfield7" >
				<?php echo $row['Head1'];?>
				</textarea>
            </div>

			<div style="width: 49%;">
				<?php echo $row['ProgH2Name'];?>
				<textarea name="Head2" style="width:100%;height:90%;"   rows="40" id="textfield5" >
				<?php echo $row['Head2'];?>
				</textarea>
			</div>
		</div>	 
	
   </div>
   	
 <script>
$(document).ready(function()
		{
			var id ='<?PHP echo $id;?>';
			var fio ='<?PHP echo $row["fio"];?>';
			var ProgH1Name ='<?PHP echo $row["ProgH1Name"];?>';
			var ProgH2Name ='<?PHP echo $row["ProgH2Name"];?>';
			var content = document.getElementById("content");			
			
			
			
			
			$('#btnsave').click(function()
			{ 
				$.ajax(
				{
					url: "public/prog/save.php",
					cache: false,
					method: "GET",  
					data: {"id": id},
					success: function(html)
					{
						$("#content").html(html);
					}
				});
			});
			
			
		
			$('#btndel').click(function()
			{
				if (confirm("Вы действительно хотите удалить программу?")) 
				
				{

						$.ajax({
								url: "public/prog/dlprog.php",
								cache: false,
								method: "GET",  
								data: {"id": id,"Dobavil": fio},
								success: function(html){
									$("#content").html(html);
							}
						});
				} //if
				else {
					alert("Отменил");
	}
				
			});
			
			$('#btnedit').click(function(){
				
				$.ajax({
					url: "public/prog/edprog.php",
					cache: false,
					method: "GET",  
					data: {"id": id,"Dobavil": fio},
					success: function(html){
						$("#content").html(html);
					}
				});
			});
		
			$('#btnftp').click(function(){
				
				$.ajax({
					url: "public/prog/ftpstarform.php",
					cache: false,
					method: "GET",  
					data: {"id": id,"ProgH1Name": ProgH1Name,"ProgH2Name": ProgH2Name},
					success: function(html){
						$("#content").html(html);
					}
				});
			});
			
					
			
		
			
		});
</script>      

