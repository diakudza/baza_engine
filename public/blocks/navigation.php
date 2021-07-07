<?PHP
$row = mysqli_query($db,"SELECT starprogramms.Dobavil,rabotniki.Fio,rabotniki.id_rabotnika,rabotniki.foto FROM starprogramms LEFT JOIN rabotniki ON starprogramms.Dobavil=rabotniki.id_rabotnika LEFT JOIN foto ON rabotniki.foto=foto.idimg WHERE starprogramms.Dobavil='".$_SESSION['userid']."'");
$nam=mysqli_num_rows($row);
$foto=mysqli_fetch_array(mysqli_query($db,"SELECT rabotniki.id_rabotnika,rabotniki.foto,foto.bindata FROM rabotniki LEFT JOIN foto ON rabotniki.foto=foto.idimg WHERE rabotniki.id_rabotnika='".$_SESSION['userid']."'"));
$home='<a href="index.php?page=main" id="btnmain" class="btn btn-primary btn-sm">Главная</a>';
$find='<a href="index.php?page=find" id="btnfind" class="btn btn-secondary btn-sm"><w>Поиск</a>';
$new='<a  href="index.php?page=form" id="btnnew" class="btn btn-secondary btn-sm"><w>Добавить</a>';
$msg='<a  href="index.php?page=msg" id="btnmsg" class="btn btn-secondary btn-sm" ><w>Сообщения</a>';
$newtask='<a href="index.php?page=newtask"  id="btnnewtask" class="btn btn-secondary btn-sm"><w>Добавить задания</a>';
$ptask='<a href="index.php?page=ptask" id="btnptask" class="btn btn-secondary btn-sm" ><w>Задания</a>';
$users='<a href="index.php?page=users" id="btnusers" class="btn btn-secondary btn-sm"><w>Пользователи</a>';
$log='<a href="index.php?page=log" id="btnlog" class="btn btn-secondary btn-sm"><w>log</a>';
$operators='<a href="index.php?page=operators" id="btn_operators" class="btn btn-secondary btn-sm"><w>Операторы</a>';
$events='<a href="index.php?page=events" id="btnevents" class="btn btn-secondary btn-sm" ><w>Уведомления</a>';
$stanki='<a href="index.php?page=stanki" id="btnstanki" class="btn btn-secondary btn-sm"  ><w>Cтанки</a>';

$drop='<div class="drop btn-secondary btn-sm">
		<button class="btn btn-secondary btn-sm"><w>Menu</button>
        <div class="menu-drop">
          <a class="" href="#">Action</a>
          <a class="" href="#">Another action</a>
          <a class="" href="#">Something else here</a>
        </div>
        </div>';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10">
			<nav class="navbar navbar-expand-lg navbar-light style="background-color: #333;">
	  
			<div class="btn-group btn-group-sm" role="group">
					
				<?php 
				if($_SESSION['ad']=='1')//adm
					{ echo $home,$find,$new,$msg,$newtask,$ptask,$users,$events,$operators,$log; }
				if($_SESSION['ad']=='2')//master
					{ echo $home,$find,$msg,$newtask,$ptask,$operators; }	
				if($_SESSION['ad']=='')//other
					{ echo $home,$find,$new,$msg,$ptask,$events,$operators; }
				if($_SESSION['ad']=='3')//test
					{ echo $home,$find,$msg,$ptask,$operators,'<W>(!!ТЕСТОВЫЙ ДОСТУП!!)</w>'; }	
				?>
				

			</div>
			</nav>
		</div>
			
			
		<div class="col-md-2" style="display: flex;flex-direction: row;">
		<?php 
			if($_SESSION['ad']=='1'||$_SESSION['ad']=='')//adm
				{ echo '<div class="nav-left">
							<a href="/public/logout.php" target="_top">' .$_SESSION['fio'].'<br><w>вы добавили:'.$nam.' </w>
						</div></a>
						<img src="data:image/jpeg;base64,'.base64_encode($foto['bindata']).'"  height="30"  class="rounded avatar">'; }
			if($_SESSION['ad']=='2')//master
				{ echo '<a href="/public/logout.php" target="_top">' .$_SESSION['fio'].'<img src="data:image/jpeg;base64,'.base64_encode($foto['bindata']).'" height="30"  class="rounded avatar"></a>'; }

			if($_SESSION['ad']=='3')//test
				{ echo '<a href="/public/logout.php" target="_top">' .$_SESSION['fio'].'  </a>'; }
			
			?>
		 </div>
	</div>
</div>