<?PHP
session_start();
?>


<body>
<p>
  <?PHP
//  error_reporting(0); 
$path = $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
//include($path);

$nomerdetali = $_POST["nomerdetali"];
$Stanok = $_POST['Stanok'];
$Dobavil = $_POST['Dobavil'];
$TypeDetail = $_POST['TypeDetail'];
$TypeMaterial = $_POST['tipmat'];
$Opisanie = $_POST['Opisanie'];
$Head1=$_FILES['Head1']['tmp_name'];
$Head2=$_FILES['Head2']['tmp_name'];
$Img = $_FILES['Img']['tmp_name'];
$DiametrZagotovki = $_POST['DiametrZagotovki'];
$Material = $_POST['Material'];
$prog1 = $_POST['prog1'];
$prog2 = $_POST['prog2'];
$ftpdir = $_POST['ftpdir'];
$ftpch1 = $_POST['ftpch1'];
$data1 = date("d.m.Y");
//print_r($_FILES['Img']);
//var_dump($_POST);

if ( $ftpch1 == 'disk')
{

echo '<br>disk';

if ($_FILES['Head1']['size']>0) 
{	$ProgH1Name=$_FILES['Head1']['name']; $Head1 = addslashes(file_get_contents($_FILES['Head1']['tmp_name'])) or die ('<who>Файл 1 не выбран, поле будет пустое</who>');
		}
	else	{	$Head1='xxxx';$ProgH1Name='O0000';			}
	
	if ($_FILES['Head2']['size']>0)
		{ 
	$ProgH2Name=$_FILES['Head2']['name'];	$Head2 = addslashes(file_get_contents($_FILES['Head2']['tmp_name'])) or die ('<who>Файл 2 не выбран, поле будет пустое</who>');
		}    

else 	{	$Head2='xxxx';$ProgH2Name='O0000';	}
}
//----------------------------
if ( $ftpch1 == 'ftp')
{
echo '<br>ftp';
$sql = mysqli_fetch_assoc(mysqli_query ($db,"SELECT dop2 FROM `machine` WHERE id_machine='".$ftpdir."' LIMIT 1"));	
$ftp = ftp_connect("10.110.140.34", "21", "30"); 
$login = ftp_login($ftp, "star", "star"); 
if (!$login) exit("<br><w>Ошибка подключения");
ftp_chdir($ftp, $sql['dop2']); // Заходим в директорию станка
ftp_get($ftp, "$prog1","$prog1", FTP_BINARY);
$Head1 = addslashes(file_get_contents($prog1));   
$ProgH1Name=$prog1;   
ftp_get($ftp, "$prog2","$prog2", FTP_BINARY);
$Head2 = addslashes(file_get_contents($prog2));   
$ProgH2Name=$prog2; 

ftp_close($ftp);

unlink ($prog1);
unlink ($prog2);
}
//----------------------

$id=mysqli_query($db,"SELECT MAX( `idimg` )FROM `img`  WHERE 1");
$id1=mysqli_fetch_array($id)or die(mysqli_error());
$idimg=$id1[0]+1;

if ($_FILES['Img']['size']>0)
{
$Img = addslashes(file_get_contents($_FILES['Img']['tmp_name'])) or die ('<br><w>Файл изображения не выбран, поле будет пустое</w>');
$ImgSize = $_FILES['Img']['size'];
$sql="INSERT INTO img (idimg,bindata,size,date) VALUES('$idimg', '$Img', '$ImgSize', '$data1')";
mysqli_query ($db,$sql) or die (mysqli_error());
}
else
{ 
$idimg="5"; 
}


$id=mysqli_query($db,"SELECT MAX( `id` )FROM `starprogramms`  WHERE 1");
$id1=mysqli_fetch_array($id)or die(mysqli_error());
$id1=$id1[0]+1;

$sql="INSERT INTO starprogramms (id,nomerdetali,Stanok,Dobavil,TypeDetail,TypeMaterial,Opisanie,ProgH1Name,ProgH2Name,Head1,Head2,Img,DiametrZagotovki,Material,Date_time) VALUES('$id1','$nomerdetali', '$Stanok', '$Dobavil', '$TypeDetail', '$TypeMaterial', '$Opisanie', '$ProgH1Name', '$ProgH2Name', '$Head1', '$Head2', '$idimg', '$DiametrZagotovki', '$Material', '$data1')";

mysqli_query ($db,$sql) or die (mysqli_error());
echo "<br><w>Добавлена деталь номер:  ".$_POST["nomerdetali"]; 
mysqli_close($db);
?>
   
</body>












