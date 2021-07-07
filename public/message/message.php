<?PHP
session_start();
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

error_reporting(0);
$idrab = $_SESSION['userid'];
$time = date("Y/m/d H:i");
$mesg = $_POST['mesg'];
$stanok = $_POST['Stanok'];
$data = $_POST['data'];
$result = mysqli_query($db,"SELECT mesg.idmessage,mesg.message,mesg.id_rabotnika,mesg.date,mesg.id_stanka,machine.name,rabotniki.fio FROM mesg LEFT JOIN machine ON mesg.id_stanka=machine.id_machine LEFT JOIN rabotniki ON mesg.id_rabotnika=rabotniki.id_rabotnika")or die(mysqli_error());
?>
<div class="window message center">
	<div  id="showmsg">
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/public/message/showmsg.php');?>
	</div>

	<div width="70%" align="center" class="tr">
		<form id="msg" name="form1" class="forma" align="center">
		  
		    <label for="mesg"></label>
		    <select name="Stanok" id="Stanok" style="width: 200px" class="custom-select custom-select-sm">
                <option>Станок</option>
                <?php foreach(selectstanki() as $row1)
                {echo '<option value="'.$row1["id_machine"].'">'.$row1["name"].'</option>';	}?>
		    </select>
		    <input name="data" type="text" id="mesg" value="" style="width: 400px" class="form-control form-control-sm d-inline-block" >
			<input type="submit" name="button" id="button" class="btn btn-secondary btn-sm d-inline-block" value="Отправить">
		  
		  
		</form>
	</div>
</div>
<script>
		
		function show_messages()  
		{  
        $.ajax({  
            url: "public/message/showmsg.php",
            cache: false,  
            success: function(html){  
                $("#showmsg").html(html);  
            }  
        });  
		}
		
		function check(clicked) {
						
						var t = clicked;
								$.ajax({ 
								url: "public/message/dlpmsg.php",
								method: "GET", 
								cache:false,							
								data: {"idmessage": t},
								success:function(msg){  
								
								show_messages();
						  }
							 
						 });
						
				
				}//clicked
				
			$(document).ready(function(){  	
			 
			 
			 
			 $('#msg').on('submit',(function(e) {
						e.preventDefault();
						
							var name = $("#Stanok").val();  
							var msg  = $("#mesg").val();  
							if (name =='')  
							{  
								alert ("Станок не выбран!");  
								return false;  
							}  
							if (msg =='')  
							{  
								alert ("Заполните текст сообщения!");  
								return false;  
							}  
						
					 
					 
					 
						var formData = new FormData(this);
					 
						$.ajax({
						  type:'POST', 
						  url: 'public/message/addmessage.php', // Скрипт обработчика
						  data: formData, // Данные которые мы передаем
						  cache:false, 
						  contentType: false,
						  processData: false, 
						  success:	function(msg){  
                    show_messages();
						  }
					});
				  }));
							
			
				
			
            });  
              
        
	</script>

