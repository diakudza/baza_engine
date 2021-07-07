<?PHP
session_start();

if (isset($_SESSION['login'])) {
goto allok;
}
else {
header("Location: /public/login.html");
exit;
}
allok:
include_once('config/connect.php');
include_once('engine/func.php');

?>

<html>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
<head>
    <title>Архив УП</title>

<link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/public/style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="public/script/jquery-3.5.1.min.js"></script>
</head>
<body>

	<div id="container">
			
		<div class="nav navbar-dark sticky-top" style="background-color: #333;">
		<?php include ("public/blocks/navigation.php");?>
		</div>
        <div id="content">
        <?php
        if(!isset($_GET['page'])){
            require ($_SERVER['DOCUMENT_ROOT']."/public/blocks/main.php");
        }else{

        $page = $_GET['page'];

        switch ($page) {
            case 'main':
                require ($_SERVER['DOCUMENT_ROOT'].'/public/blocks/main.php');
                break;
            case 'find':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/prog/form_filtr_prog.php');
                break;
            case 'form':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/prog/form.php');
                break;
            case 'msg':
                require ($_SERVER['DOCUMENT_ROOT'].'/public/message/message.php');
                break;
            case 'newtask':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/master/task.php');
                break;
            case 'ptask':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/master/pstanki.php');
                break;
            case 'log':
                require ($_SERVER['DOCUMENT_ROOT'].'/public/adm/log.php');
                break;
            case 'users':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/rabotniki/rabotniki.php');
                break;
            case 'operators':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/master/operators.php');
                break;
            case 'events':
                require ($_SERVER['DOCUMENT_ROOT'].'/public/events.php');
                break;
            case 'stanki':
                require($_SERVER['DOCUMENT_ROOT'] . '/public/test/info_sq.html');
                break;
        }
        }

		?>

	</div>
	<div class="fixed-bottom">
		<?php include("public/blocks/footer.php");?>
	</div>
	
	


</body>
</html>