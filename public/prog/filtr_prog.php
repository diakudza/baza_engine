<?PHP
session_start();
//var_dump ($_POST);
//include($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
//var_dump($_SERVER['REQUEST_URI']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        var_dump($uri);
include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');

if (isset($_GET['nomerdetali'])) {
}
else 
{
$q = "SELECT starprogramms.id,img.idimg,img.bindata,starprogramms.nomerdetali,starprogramms.TypeMaterial, tip_detali.TypeDetail,rabotniki.fio,machine.name,starprogramms.Img,starprogramms.DiametrZagotovki,tip_detali.TypeDetail,rabotniki.Fio, material.tip,starprogramms.ProgH1Name,starprogramms.ProgH2Name,starprogramms.Head1,starprogramms.Head2,starprogramms.Opisanie, starprogramms.Date_time FROM starprogramms LEFT JOIN machine ON starprogramms.stanok=machine.id_machine LEFT JOIN tip_detali ON starprogramms.TypeDetail=tip_detali.id LEFT JOIN material ON starprogramms.Material=material.idmaterial LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika LEFT JOIN img ON starprogramms.img=img.idimg";	
goto listonly;
}
		
$nomerdetali = $_GET['nomerdetali'];
$Stanok = $_GET['Stanok'];
$Dobavil = $_GET['Dobavil'];
$TypeDetail = $_GET['TypeDetail'];

$q = "SELECT starprogramms.id,img.idimg,img.bindata,starprogramms.nomerdetali,starprogramms.TypeMaterial, tip_detali.TypeDetail,rabotniki.fio,machine.name,starprogramms.Img,starprogramms.DiametrZagotovki,tip_detali.TypeDetail,rabotniki.Fio, material.tip,starprogramms.ProgH1Name,starprogramms.ProgH2Name,starprogramms.Head1,starprogramms.Head2,starprogramms.Opisanie, starprogramms.Date_time FROM starprogramms LEFT JOIN machine ON starprogramms.stanok=machine.id_machine LEFT JOIN tip_detali ON starprogramms.TypeDetail=tip_detali.id LEFT JOIN material ON starprogramms.Material=material.idmaterial LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika  LEFT JOIN img ON starprogramms.img=img.idimg WHERE nomerdetali REGEXP '(.*)$nomerdetali(.*)'";

if ($Stanok!='') {$q .=" AND machine.name REGEXP '(.*)$Stanok(.*)'"; }
if ($Dobavil!='') {$q .=" AND rabotniki.fio REGEXP '(.*)$Dobavil(.*)'"; }
if ($TypeDetail!='') {$q .=" AND tip_detali.TypeDetail REGEXP '(.*)$TypeDetail(.*)'"; }

listonly:
$result = mysqli_query($db,$q)or die(mysqli_error());
if(mysqli_num_rows($result)==0) 
{echo "<w>такого нет</w>"; }?>	

<div id="table">
<table width="100%" border="1" align="centr" cellspacing="2" class="window" >
   <tr>
	<th>ID</th>
	<th>Номер</th>
	<th>IMG</th>
	<th>Тип</th>
	<th>Станок</th>
	<th>Добавил</th>
	<th>материал</th>
	<th>дата</th>
</tr>      
	
<?php

foreach($result as $row)
{
	Echo '<tr id="'.$row["id"].'" align="center" onClick="check(this.id)">
			<td width="2%">'.$row["id"].'</td>
			<td width="15%"><a href="/view?id='.$row["id"].'">'.$row["nomerdetali"].'</a></td>
			<td width="5%"><img src="data:image/jpeg;base64,'.base64_encode($row['bindata']).'" width="70" height="70"></td>
			<td width="13%">'.$row["TypeDetail"].'</td>
			<td width="8%">' . $row["name"] . '</td>
			<td width="8%">' . $row["fio"] . '</td>
			<td width="5%">' . $row["tip"] . ' ' . $row["TypeMaterial"] . ' ' . $row["DiametrZagotovki"] . '</td>
			<!--<td width="25%"><textarea  cols="30" rows="5" readonly="readonly">' . $row["Head1"] . '</textarea></td>
			<td width="25%"><textarea cols="30" rows="5" readonly="readonly">' . $row["Head2"] . '</textarea></td>-->
			<td width="8%">' . $row["Date_time"] .'</td>
			</td>
		</tr>

';



};
	
	
	print "</table>";
	
?>
 </table>
		
			<!-- <script>
							
		function check(clicked) {
						var content = document.getElementById("content");
						var t = clicked;
						$.ajax({ 
								url: "public/prog/view.php",
								method: "GET", 
							
							 
							cache:false,							
								data: {"id": t},
								success:function(html)
									{
										$("#content").html(html);
									}
							 
						 });
						
				
				}		
					
	</script> -->
</div>

	
