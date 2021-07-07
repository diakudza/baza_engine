<?PHP session_start();?>
<html>
 <head>
<title>login</title>
<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body class="zadni">
<div class="window login center">

 <?PHP
 include_once($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
$data = mysqli_fetch_assoc(mysqli_query($db,"SELECT pass FROM rabotniki WHERE login='".($_POST['login'])."' LIMIT 1"));
$fio  = mysqli_fetch_assoc(mysqli_query($db,"SELECT fio,id_rabotnika FROM rabotniki WHERE login='".($_POST['login'])."' LIMIT 1"));
$ad  = mysqli_fetch_assoc(mysqli_query($db,"SELECT dop3 FROM rabotniki WHERE login='".($_POST['login'])."' LIMIT 1"));

$ip = $_SERVER['REMOTE_ADDR'];;
$time = date("Y.m.d H:i:s");
$time1 = date("Y-m-d");
$login = $_POST['login'];
//$dir = "log/$time1";
//if(!is_dir($dir)) mkdir($dir) ;
$url_o = getenv("HTTP_REFERER");
$url_k = getenv("REQUEST_URI");
$soft = getenv("HTTP_USER_AGENT");
$all = "ip:$ip\n$url_o\n$url_k\n Браузер: $soft\n";
//fwrite($file,$all);
//fclose($file);


if (empty($_POST['login']) && empty($_POST['password'])){
echo '<div style="text-align: center;">Пустое поле ввода</div>';

mysqli_query($db,"INSERT INTO `login`(`date`, `login`,`info`,`ok`) VALUES ('$time','$login','$all','empty')");
echo '<div style="text-align: center;"><a href="public/login.html" class="gblue">еще раз</a></div>';
	exit();
	}

if($data['pass'] === $_POST['password'])
	{
		$_SESSION['auth'] = true;
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['fio'] = $fio['fio'];
		$_SESSION['userid'] = $fio['id_rabotnika'];
		$_SESSION['ad'] = $ad['dop3'];
		echo "Здравствуйте, ".$_SESSION['fio']."";

		mysqli_query($db,"INSERT INTO `login`(`date`, `login`,`info`,`ok`) VALUES ('$time','$login','$all','ok')");
	echo '<meta http-equiv="refresh" content="1; URL=/index.php" />';

	}
	else
	{
	echo '<div style="text-align: center;">Ошибка ввода логин-пароль</div>';

	echo '<div style="text-align: center;"><a href="/public/login.html">еще раз</a></div>';

	mysqli_query($db,"INSERT INTO `login`(`date`, `login`,`info`,`ok`) VALUES ('$time','$login','$all','no')");
	exit();
	}
?>
</div>
</body>

</html>




