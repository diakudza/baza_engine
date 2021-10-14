<form id="filtr" class="window filtr_main sticky-top" action="find_ok" method="GET">
    <!-- action="public/prog/filtr_prog.php" -->
    <input type="text" name="nomerdetali" size="20" maxlength="20" class="form-control form-control-sm d-inline-block" style="width: 20%" placeholder="Номер детали">
    <input type="text" name="Stanok" size="20" maxlength="20" class="form-control form-control-sm d-inline-block" style="width: 20%" placeholder="Станок">
    <input type="text" name="Dobavil" size="20" maxlength="20" class="form-control form-control-sm d-inline-block" style="width: 20%" placeholder="Добавил">
    <input type="text" name="TypeDetail" size="20" maxlength="20" class="form-control form-control-sm d-inline-block" style="width: 20%" placeholder="тип дет.">
	<input type="submit" id="btnfind" class="btn btn-primary btn-sm " value="найти">
</form>

<div id="filtrcontent"></div>
		<!-- <script>
		$(document).ready(function(){  
          
            $('#filtr').submit(function(){  
				var msg   = $('#filtr').serialize();
                $.ajax({  
                    type: 'GET',  
                    url: 'public/prog/filtr_prog.php',
                    data: msg, 
					cache:false,
					//contentType: false,
					 //processData: false, 
                     success: function(html){  
						
                        $("#filtrcontent").html(html);  
                    }  
                });  
                return false;  
            });  
              
        });  
	</script> -->
	


