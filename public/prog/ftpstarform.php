<?PHP
session_start();
$ProgH1Name = $_GET['ProgH1Name'];
$ProgH2Name = $_GET['ProgH2Name'];
$id = htmlspecialchars($_GET['id']);

?>

<form id="ftp" enctype="multipart/form-data">

    <p>&nbsp;</p>
    <table width="654" height="130" align="center" cellpadding="2" cellspacing="1" class="window center">
        <tr>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <td width="30%" align="center">станок:</td>
            <td width="30%" align="center">Имя для head1</td>
            <td width="30%" align="center">Имя для head2</td>
        </tr>
        <tr>
            <td width="30%" align="center">
                <select name="Stanok" id="Stanok">
                    <option>Станок</option>
                    <?php
                    foreach (selectstanki() as $row1) {
                        echo '<option value="' . $row1["id_machine"] . '">' . $row1["name"] . '</option>';
                    }
                    ?>
                </select></td>
            <td width="30%" align="center"><input type="text" name="ProgH1Name" id="ProgH1Name"
                                                  value="<?php echo $ProgH1Name; ?>">
                <input type="checkbox" name="head1ch" id="checkbox" value="1">
                <label for="checkbox"></label></td>
            <td width="30%" align="center"><input type="text" name="ProgH2Name" id="ProgH2Name"
                                                  value="<?php echo $ProgH2Name; ?>">
                <input type="checkbox" name="head2ch" id="checkbox2" value="1"></td>
        </tr>
        <tr>
            <td width="30%" align="center"></td>
            <td width="30%" align="center"></td>
            <td width="30%" align="center"><input type="submit" name="button" id="button" value="Отправить">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" align="center">Форма выгрузки программ на фтп сервер в папку станка. <br>Укажите на какой
                станок и какую программу отправить.
            </td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
<div id="result"></div>
<script>
    $(document).ready(function () {

        var content = document.getElementById("result");
        $('#ftp').on('submit', (function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            //var formData = $('#ftp').serialize();

            $.ajax({
                type: 'POST',
                //method:"GET",
                url: 'public/prog/ftpstar.php', // Скрипт обработчика
                data: formData, // Данные которые мы передаем
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#result").html(data);
                },
                error: function (html) {
                    console.log(html);
                }
            });

        }));


    });


</script>





