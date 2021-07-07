<?PHP
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$query = "SELECT * from tip_detali ORDER BY `tip_detali`.`TypeDetail` ASC";
$result = mysqli_query($db,$query) or die("<br>Не могу выполнить запрос");
print "<option></option>";
while ($row = mysqli_fetch_array($result)) :
echo '<option value="'.$row["id"].'">'.$row["TypeDetail"].'</option>';

endwhile;
mysqli_close($db);
?>
