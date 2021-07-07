<?PHP
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
error_reporting(0);
$idrab = $_SESSION['userid'];
$time = date("d/m/y H:i");
$mesg = $_POST['mesg'];
$stanok = $_POST['Stanok'];
$data = $_POST['data'];
//$db = mysqli_connect(HOST,USER,PASS,DB);

//$mes="INSERT INTO `mesg`(message,date,id_rabotnika,id_stanka) VALUES ('$data','$time','$idrab','$stanok')";
mysqli_query($db,"INSERT INTO `mesg`(message,date,id_rabotnika,id_stanka) VALUES ('$data','$time','$idrab','$stanok')")or die(mysqli_error());
?>
