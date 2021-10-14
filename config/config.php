<?php
/* DB config */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'ceh2');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SITE_ROOT', "../");
define('WWW_ROOT', SITE_ROOT . '/public');
define('DOMAIN','http://baza.ru/');
define('SITE_TITLE', 'БАЗА');
define('DATA_DIR', SITE_ROOT . 'data');
define('LIB_DIR', SITE_ROOT . 'engine');
define('TPL_DIR', SITE_ROOT . 'templates');
$db = mysqli_connect(HOST,USER,PASS,DB);
?>
