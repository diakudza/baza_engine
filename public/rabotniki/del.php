<?php
session_start();
//include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
?>


<div align="left">
	<p align="center">Удалить</p>
    	<table width="200" border="0" align="center">
     	 <tr>
        	<td>
			<?php
		
$sql_insert = mysqli_query ($db,"DELETE FROM rabotniki WHERE id_rabotnika =".$_GET["id_rabotnika"]."  LIMIT 1") or die("<br>не могу выполнить запрос!!</br>");
mysqli_close($db);

echo "Удален!".$_GET["id_rabotnika"];
?>
	
		</td>
      </tr>
    </table>
</div>


