<?php
$array = array();
// $array[] = "eins";
// $array[] = "zwei";
// $array[3] = "drei";
// $array["element"] = "vier";
// $array["monat"][1]["day"][1] = "Montag";
// $array["monat"][1]["day"][2] = "Dienstag";
// $array["monat"][1]["day"][3] = "Mittwoch";
// $array["monat"][1]["day"][4] = "Donnerstag";
// $array["monat"][1]["day"][5] = "Freitag";
// $array["monat"][1]["day"][6] = "Samstag";
// $array["monat"][1]["day"][7] = "Sonntag";

$array[0]["id"] = 1;
$array[0]["name"] = "Peter";
$array[0]["age"] = 20;

$array[1]["id"] = 2;
$array[1]["name"] = "Paul";
$array[1]["age"] = 21;

foreach ($array as $nummer => $item){
    // echo "Nummer: $nummer<br>";
    echo 'Alter: '.$item["age"].'<br>';
    foreach ($item as $key => $value){
        echo "$key: $value<br>";
    }
    echo "<br>";
}

echo json_encode($array);
echo "<pre>";
    print_r($array);
echo "</pre>";
?>