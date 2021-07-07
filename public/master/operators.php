<?PHP

$result=mysqli_query($db,"SELECT id_machine,name,rab1.Fio,operator,rab2.Fio as Fio2,operator2 from machine as mach LEFT JOIN rabotniki as rab1 on (rab1.id_rabotnika = mach.operator) LEFT JOIN rabotniki as rab2 on (rab2.id_rabotnika = mach.operator2) ") ;
echo '<form id="form_oper" action="ors.php" method="post" class="operators_block" >';

foreach($result as $row){	

echo '	<div class="window operators_item">
			'.$row['name'].' '.$row['id_machine'].'
			<div>
				Первая смена
				<select name="'.$row['id_machine'].'operator" class="custom-select custom-select-sm">
				<option value="'.$row["operator"].'">'.$row['Fio'].'</option>';
				foreach(selectrabotniki() as $row1)
				{echo '<option value="'.$row1["id_rabotnika"].'">'.$row1["Fio"].'</option>';	};

echo '			</select>
			</div>
			<div>
				Вторая смена
				<select name="'.$row['id_machine'].'operator2" class="custom-select custom-select-sm">
				<option value="'.$row["operator2"].'">'.$row['Fio2'].'</option>';
				foreach(selectrabotniki() as $row1)
				{echo '<option value="'.$row1["id_rabotnika"].'">'.$row1["Fio"].'</option>';	};
echo '			</select>
			</div>
		</div>';}

?>

<input type="submit" name="button"  class="btn btn-secondary btn-sm " id="button" value="Добавить" />
</form>

<script>

$(document).ready(function(){  

    $('#form_oper').submit(function(){
    	var msg   = $('#form_oper').serialize();
			$.ajax({
				url: '../public/master/up_operators.php',
				type:'POST',
				dataType: 'html',
				data: msg,
				cache:false,
				success: function(data){
					$("#content").html(data);
					
				},
				error:function(html){
							console.log(html);
				}
	});
	return false; 		
});
    });
</script>




