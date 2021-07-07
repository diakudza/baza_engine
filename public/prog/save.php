<?PHP
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
include($path);	
$dir=$_SERVER['DOCUMENT_ROOT'];
$id = htmlspecialchars($_GET['id']);
$row = mysqli_fetch_array(mysqli_query($db,"SELECT ProgH1Name,ProgH2Name,Head1,Head2 FROM starprogramms WHERE id='".$id."'" ))or die(mysqli_error());
mysqli_close($db);
$prog1=$row['ProgH1Name'];
$prog2=$row['ProgH2Name'];
$file = fopen($dir."/public/prog/progs/".$prog1,"w");
fwrite($file,$row['Head1']);
fclose($file);

$file2 = fopen($dir."/public/prog/progs/".$prog2,"w");
fwrite($file2,$row['Head2']);
fclose($file2);?>


<?php echo '<a href="/public/prog/progs/'.$prog1.'" target="blank">head1</a> </p>  <a href="/public/prog/progs/'.$prog2.'" target="blank">Head2</a></p>'; ?>


