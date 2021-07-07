<?PHP
session_start();
session_destroy();
header("Location: /public/login.html");
?>
