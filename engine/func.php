<?PHP


function selecttip()
{
    global $db;
$query = "SELECT * from tip_detali ORDER BY `tip_detali`.`TypeDetail` ASC";

    $result = mysqli_query($db, $query) or die("<br>Не могу выполнить запрос");
    return $result;
}


function selectrabotniki()
{
    global $db;
$query = "SELECT * from rabotniki ORDER BY `rabotniki`.`Fio` ASC";
$result = mysqli_query($db,$query) or die("<br>Не могу выполнить запрос");
   return $result;
}


function selectmat()
{
    global $db;
$query = "SELECT * from material ORDER BY `material`.`tip` ASC";
$result = mysqli_query($db,$query) or die("<br>Не могу выполнить запрос");

   return $result;
}

function selectstanki()
{
    global $db;
$query = "SELECT * from machine ORDER BY `machine`.`name` ASC";
$result = mysqli_query($db,$query) or die("<br>Не могу выполнить запрос");

   return $result;
}
?>