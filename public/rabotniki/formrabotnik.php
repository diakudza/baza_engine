
<form id="formAddRabotnik"  enctype="multipart/form-data">

<p align="center"><w>Добавление работника</w></p>
<table width="278" height="230" border="1" cellpadding="2" cellspacing="1" align="center" class="window">
    <tr>
      <td width="200">ФИО</td>
      <td width="124"><input type="text" name="fio" size="40" maxlength="40" placeholder="Иванов И.И."></td>
    </tr>
    <tr>
      <td width="200">Дата устройства</td>
      <td><input type="date" name="data_ustr" size="40" maxlength="10" placeholder="2020"></td>
    </tr>
    <tr>
      <td width="200">Табельный</td>
      <td>
        <input type="text" name="tabel" size="40" maxlength="6" placeholder="00000" ">
      </td>
    </tr>
    <tr>
      <td width="200">Профессия</td>
      <td><input type="text" name="professia" size="40" maxlength="40" placeholder="Оператор"></td>
    </tr>
        <tr>
      <td width="200">Статус</td>
      <td><input type="text" name="status" size="40" maxlength="20" placeholder="Работает"></td>
    </tr>
    <tr>
      <td width="200">Логин</td>
      <td><input type="text" name="login" size="40" maxlength="20" placeholder="login"></td>
    </tr>
    <tr>
      <td>Пароль</td>
      <td><input type="text" name="pass" size="40" maxlength="20" placeholder="password"></td>
    </tr>
    <tr>
      <td>chatis</td>
      <td><input type="text" name="chatid" size="40" maxlength="20" placeholder="1234567890"></td>
    </tr>
    
    <tr>
      <td>Смена(1-смена Менделев, 2-Смена Арьков)</td>
      <td><input type="text" name="smena" size="40" maxlength="1"></td>
    </tr>
    <tr>
      <td>Оставьте пустым, если не 1-адм,2-мастер</td>
      <td><input type="text" name="dop3" size="40" maxlength="1"></td>
    </tr>
    <tr>
      <td width="200">фото</td>
      <td><input type="file" name="foto" onClick=></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Добавить" onClick=></td>
    </tr>
</table>
<p align="center">&nbsp;</p>
</form>

<script>
    $(document).ready(function(){  
      
      var content = document.getElementById("content");
       $('#formAddRabotnik').on('submit',(function(e) {
            e.preventDefault();
           
            var formData = new FormData(this);
           
            $.ajax({
              type:'POST',
              //method: "POST", 
              url: 'public/rabotniki/addrabotnik.php', // Скрипт обработчика
              data: formData, // Данные которые мы передаем
              cache:false, 
              contentType: false,
              processData: false, 
              success:  function(data){
              $("#content").html('Добавлен');
              },
             error:function(html){
              console.log(html);
               }
          });
          }));
              
      
      
            });  
              
        
  </script>