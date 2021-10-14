<?php 

$st20 = [
  "id" => "555",
  "name" => "Star20",
  "info" => [
    "status" => "Работает",
    "color" => "#22213",
    "operator" => "Титов",
  ],
];
$st10 = [
  "id" => "111",
  "name" => "Star101",
  "info" => [
    "status" => "Наладка",
    "color" => "#22221",
    "operator" => "Савула",
  ],
];


$info=[$st20, $st10];
$json = json_encode($info, JSON_UNESCAPED_UNICODE);
$file = fopen('status.json', 'w');
fwrite($file,$json);
fclose($file);
echo "<pre>";
//var_dump($info[1]);
echo $info[1]["id"];
 
echo "<hr>";
$string = file_get_contents("status.json");
$data = json_decode($string,true);

echo $data[1]['name'];

?>