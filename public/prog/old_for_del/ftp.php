<?php
  $ftp = ftp_connect("10.110.140.34", "21", "30"); // Создаём идентификатор соединения (адрес хоста, порт, таймаут)
  $login = ftp_login($ftp, "star", "star"); // Авторизуемся на FTP-сервере
  if (!$login) exit("Ошибка подключения");
  //ftp_mkdir($ftp, "myrusakov"); // Создаём директорию
  ftp_chdir($ftp, "NEX12"); // Заходим в созданную директорию
  ftp_put($ftp, "all12.php", "all.php", FTP_BINARY); // Загружаем image.bmp на FTP в бинарном режиме
  //ftp_put($ftp, "new_doc.xml", "doc.xml", FTP_BINARY); // Загружаем doc.xml (делаем имя new_doc.xml) на FTP в бинарном режиме
 // $files = ftp_nlist($ftp, "."); // Получаем список файлов из текущей директории
 // for ($i = 0; $i < count($files); $i++) {
  //  echo $files[$i]."<br />"; // Выводим все полученные файлы
//  }
 // ftp_get($ftp, "local.xml", "new_doc.xml", FTP_BINARY);
  ftp_close($ftp);
?>



