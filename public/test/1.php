<?php 
$pass = password_hash('qwerty', PASSWORD_DEFAULT);
$pass_i = "qwerty";
var_dump($_SERVER['SERVER_NAME']);
//if(password_verify($pass_i, $pass)){
//    echo "пароли совпадают!";
//}else{
//    echo "пароли не совпадают!";
//}
echo '<br>'.$_SERVER["SERVER_NAME"];
?>