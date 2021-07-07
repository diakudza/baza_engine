<?PHP
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$query = "SELECT * from machine ORDER BY `machine`.`name` ASC";
$result = mysqli_query($db,$query) or die("<br>Не могу выполнить запрос");
print "<option></option>";
while ($row = mysqli_fetch_array($result)) :
echo '<option value="'.$row["id_machine"].'">'.$row["name"].'</option>';
endwhile;
mysqli_close($db);
?>
