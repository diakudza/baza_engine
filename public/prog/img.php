<?PHP
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
?>
<html> <head>
<title>addprog</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="zadni">
<p>
  <?PHP

var_dump($_POST);
//$Img = $_POST['Img'];
$Img = "/public/img/det/no.jpg";

$id=mysqli_query($db,"SELECT MAX( `id` )FROM `starprogramms`  WHERE 1");
$id1=mysqli_fetch_array($id)or die(mysqli_error());
$id1=$id1[0]+1;
$data1 = date("Y-d-m");
$sql="INSERT INTO starprogramms (id,Img,Date_time) VALUES('$id1', '$Img', '$data1')";
mysqli_query ($db,$sql) or die (mysqli_error());
echo "Добавлена деталь номер"; 
mysqli_close($db);
?>
  

</body>
</html>











