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
        // var_dump($_SERVER['REQUEST_URI']);

        if(!isset($_SERVER['REQUEST_URI'])){
            require (ROOT ."/public/blocks/main.php");
        }else{
           
        $page = $_SERVER['REQUEST_URI'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        var_dump($uri);

        switch ($uri) {
            case '/main':
                require (ROOT.'/public/blocks/main.php');
                break;
            case '/find':
                require(ROOT . '/public/prog/form_filtr_prog.php');
                break;

            case '/find_ok':
                require(ROOT . '/public/prog/filtr_prog.php');
                break;    

            case '/edit':
                require(ROOT . '/public/prog/edprog.php');
                break;

            case '/form':
                require(ROOT . '/public/prog/form.php');
                break;
            case '/msg':
                require (ROOT.'/public/message/message.php');
                break;
            case '/view':
                require (ROOT.'/public/prog/view.php');
                break;    
            case '/newtask':
                require(ROOT. '/public/master/task.php');
                break;
            case '/ptask':
                require(ROOT . '/public/master/pstanki.php');
                break;
            case '/log':
                require (ROOT .'/public/adm/log.php');
                break;
            case '/users':
                require(ROOT . '/public/rabotniki/rabotniki.php');
                break;
            case '/operators':
                require(ROOT . '/public/master/operators.php');
                break;
            case '/events':
                require (ROOT .'/public/events.php');
                break;
            case '/stanki':
                require(ROOT . '/public/test/info_sq.html');
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