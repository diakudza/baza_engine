<?PHP
session_start();

if(($_SESSION['ad']!='1')&&($_SESSION['fio']!=$_POST['Dobavil']))
{echo "<w>У ".$_SESSION['fio']." нет прав на эту операцию ".$_SESSION['ad']."";
//&&($_SESSION['fio']!=$_POST['Dobavil'])
exit;}

?>


<?PHP
include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
$id = $_POST['id'];
$nomerdetali = $_POST['nomerdetali'];

$Opisanie = $_POST['Opisanie'];
$ProgH1Name = $_POST['ProgH1Name'];
$ProgH2Name = $_POST['ProgH2Name'];
$TypeDetail = $_POST['TypeDetail'];
$Head1 = addslashes($_POST['Head1']);
$Head2 = addslashes($_POST['Head2']);
$data = date("d.m.Y");

$query = mysqli_query($db,"SELECT img FROM `starprogramms` WHERE id='".$id."'" )or die(mysqli_error());//?

if ($_FILES['Img']['size']!=0)
{
$Img = addslashes(file_get_contents($_FILES['Img']['tmp_name'])) or die ('<w>Файл изображения не выбран, поле name будет пустое</who>');
$ImgSize = $_FILES['Img']['size'] or die ('<w>Файл изображения не выбран, поле size будет пустое</who>');
$id1=mysqli_fetch_array(mysqli_query($db,"SELECT MAX( `idimg` )FROM `img`  WHERE 1"))or die(mysqli_error());//?
$idimg=$id1[0]+1;//?
$sql="INSERT INTO `img`(`bindata`,`size`,`date`) VALUES ('$Img','$ImgSize','$data')";
mysqli_query ($db,$sql) or die (mysqli_error());
$sql="UPDATE starprogramms SET `nomerdetali`='$nomerdetali', `Opisanie`='$Opisanie',`ProgH1Name`='$ProgH1Name',`ProgH2Name`='$ProgH2Name',`Head1`='$Head1',`img`='$idimg',`TypeDetail`='$TypeDetail',`Head2`='$Head2' WHERE `id`='$id'";
mysqli_query ($db,$sql) or die (mysqli_error());
}
else{

$sql="UPDATE starprogramms SET `nomerdetali`='$nomerdetali', `Opisanie`='$Opisanie',`ProgH1Name`='$ProgH1Name',`ProgH2Name`='$ProgH2Name',`TypeDetail`='$TypeDetail',`Head1`='$Head1',`Head2`='$Head2' WHERE `id`='$id'";
}
//echo "<br><w>Вы вошли как: ".$_SESSION['login']."</br>";

mysqli_multi_query ($db,$sql) or die (mysqli_error());

echo "<br>";
echo "<w>Деталь номер:  ".$nomerdetali." исправлена"; 
mysqli_close($db);
?>


