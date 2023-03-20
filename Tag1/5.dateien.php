<?php
include("4.funktionen.php");

$inhalt = file_get_contents("test.html");
echo $inhalt;

$inhalt = file("test.sql");
echo "<pre>";
print_r($inhalt);
echo "</pre>";

$inhalt = file_get_contents("test.sql");
$inhalt = explode(";", $inhalt);
foreach ($inhalt as $key => $value){
    $inhalt[$key] = trim($value);
    if ($inhalt[$key] == "")
        unset($inhalt[$key]);
}
echo "<pre>";
print_r($inhalt);
echo "</pre>";
?>