<?PHP
session_start();
//include($_SERVER['DOCUMENT_ROOT'].'config/connect.php');


$machine = mysqli_query($db,"SELECT * from machine ORDER BY `machine`.`name` ASC");
$fio=mysqli_query($db,"SELECT rabotniki.fio,events.stanki,events.id_rabotnika,events.start,events.end,events.activ FROM events LEFT JOIN rabotniki ON rabotniki.id_rabotnika=events.id_rabotnika WHERE `events`.`id_rabotnika`='".$_SESSION['userid']."'");
$now=mysqli_fetch_array($fio);

?>

<?php
if(isset($_POST['button'])){
    $start=$_POST['start'];
    $end=$_POST['end'];
    $stanki='';
    $activ=$_POST['activ'];
    foreach($machine as $row)

    {
        if (isset($_POST["check".$row['id_machine']]))
        {
            if ($stanki=='')
            {$stanki=$row['id_machine'];}
            else
            {$stanki=$stanki.';'.$row['id_machine'];}

        }
    }
    $inevent=mysqli_fetch_array(mysqli_query($db,"SELECT id_rabotnika FROM events WHERE `id_rabotnika`='".$_SESSION['userid']."' "));

    if ($inevent[0])
    {
        mysqli_query($db,"UPDATE events SET `stanki`='$stanki',`start`='$start',`end`='$end',`activ`='$activ' WHERE `id_rabotnika`='".$_SESSION['userid']."' ");
        echo "<br><w>Уведомления изменены";
    }
    else
    {	$id_rabotnika=$_SESSION['userid'];
        mysqli_query($db,"INSERT INTO events (`id_rabotnika`,`stanki`,`start`,`end`,`activ`) VALUES('$id_rabotnika','$stanki','$start','$end','$activ')");
        echo "<br><w>Уведомления добавлены";
    }
}
?>
<form action="?" method="POST" id="events" >
        <table width="50%" height="195" border="1" align="center" class="window">
          <tr>
			  <td>Актуальные станки для <?php echo $_SESSION['fio'];?>:
			  <?php  
			  $stan = explode(";", $now[1]);
						foreach ($stan as $sta) 
						   {$machine1=mysqli_fetch_array(mysqli_query($db,"SELECT name FROM `machine` WHERE id_machine='".$sta."' "));
							   echo " ".$machine1[0];}
			  ?>
			  </td>
		  </tr>
		  <tr>
			  <td>укажите станки и время
			  <?php 
					foreach($machine as $row)
					{	 
						echo '<br><input type="checkbox" name="check'.$row["id_machine"].'" value="1"';  
								
							foreach ($stan as $sta)
								{	
								 if ($sta==$row["id_machine"]){echo ' checked="checked" ';} 
								}		
						echo '>'.$row['name'].'';
					}
					  
			  ?>
			  </td>
			  <td>
			  <input name="start" type=time class="form-control form-control-sm" style="width: 180px"  id="textfield3" value="<?php  echo $now[3];?>" size="40" />
			  <input name="end"  type=time class="form-control form-control-sm" style="width: 180px"  id="textfield3"  value="<?php  echo $now[4];?>" size="40" />
			  </td>
		  </tr>
          <tr>
			<td>
				<input type="submit" name="button" id="button" class="btn btn-secondary btn-sm " value="Добавить" />
			</td>
			<td>
				
				<input type="checkbox" name="activ" value="1" <?php if ($now["activ"]=='1'){$ch='checked="checked"';}else{$ch='-';}echo $ch;?> > Активно
			</td>
			</tr>
		</table>
 </form>

@Star_events_bot
<script>
		$(document).ready(function(){  
          
            $('#events').submit(function(){  
				var msg   = $('#events').serialize();
                $.ajax({  
                    type: "POST",  
                    url: "events.php",
                    data: msg, 
					cache:false,
					//contentType: false,
					 //processData: false, 
                     success: function(html){  
						
                        $("#content").html("<w>  Добавлено</w>");
                    }  
                });  
                return false;  
            });  
              
        });  
	</script>
