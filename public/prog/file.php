<?PHP
session_start();
$file_handle = fopen("O0816", "r");
while (!feof($file_handle)) {
   $line = fgets($file_handle);
   echo "<br>",$line;
}
fclose($file_handle);
?>