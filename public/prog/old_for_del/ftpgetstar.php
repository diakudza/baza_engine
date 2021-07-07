<?PHP
session_start();


$ProgH1Name = $_GET['ProgH1Name'];
$ProgH2Name = $_GET['ProgH2Name'];
$stanok = $_GET['Stanok'];

$ftp = ftp_connect("10.110.140.34", "21", "30"); 
$login = ftp_login($ftp, "star", "star"); 
if (!$login) exit("<br>Ошибка подключения");
//ftp_chdir($ftp, $sql['dop2']); // Заходим в директорию станка
ftp_chdir($ftp, "/NEX12"); // Заходим в директорию станка
ftp_get($ftp, "local.txt", "O0201", FTP_BINARY);
   echo '<br>файл загружен';
   

 
ftp_close($ftp);
echo '<br>файлы отправлены в ftp://10.110.140.34/';
?>




