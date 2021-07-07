<?PHP
session_start();

error_reporting(0); 
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$ProgH1Name = $_POST['ProgH1Name'];
$ProgH2Name = $_POST['ProgH2Name'];
$stanok = $_POST['Stanok'];
$id = htmlspecialchars($_POST['id']);
$sql = mysqli_fetch_assoc(mysqli_query ($db,"SELECT dop2 FROM `machine` WHERE id_machine='".$stanok."' LIMIT 1"));
$dir=$_SERVER['DOCUMENT_ROOT'];
$head1 = mysqli_fetch_assoc(mysqli_query ($db,"SELECT head1 FROM `starprogramms` WHERE id='".$id."' LIMIT 1"));
$head2 = mysqli_fetch_assoc(mysqli_query ($db,"SELECT head2 FROM `starprogramms` WHERE id='".$id."' LIMIT 1"));
$head1ch = htmlspecialchars($_POST['head1ch']);
$head2ch = htmlspecialchars($_POST['head2ch']);
mysqli_close($db);


$ftp = ftp_connect("10.110.140.34", "21", "30"); 
$login = ftp_login($ftp, "star", "star"); 
if (!$login) exit("<br><w>Ошибка подключения");
ftp_chdir($ftp, $sql['dop2']); // Заходим в директорию станка


		if ( $head1ch == '1')
		{
				$dir=$_SERVER['DOCUMENT_ROOT']."/public/prog/progs/".$ProgH1Name;
				$file1 = fopen("$dir","w");
				fwrite($file1,$head1['head1']);
				fclose($file1);
				ftp_put($ftp, "$ProgH1Name","$dir", FTP_BINARY);  
				echo '<br><w>файл ',$ProgH1Name,' отправлен в ftp://10.110.140.34/',$sql['dop2'],'';
		   }
		  else {
				echo '<br><w>программа head1 не отмечено';
			   }
			 
		if ( $head2ch == '1')
		{		$dir2=$_SERVER['DOCUMENT_ROOT']."/public/prog/progs/".$ProgH2Name;
				$file2 = fopen("$dir2","w");
				fwrite($file2,$head2['head2']);
				fclose($file2);
				ftp_put($ftp, "$ProgH2Name","$dir2", FTP_BINARY);  
				echo '<br><w>файл ',$ProgH2Name,' отправлен в ftp://10.110.140.34/',$sql['dop2'],'';
		}
		  else {
				echo '<br><w>программа head2 не отмечено';
			   } 

		 
		ftp_close($ftp);
		



?>

