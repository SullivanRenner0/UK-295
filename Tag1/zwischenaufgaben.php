<?php
$start = 0;
$end = 255;
echo "ASCII Tabelle von $start bis $end: <br>";
for ($i = $start; $i <= $end; $i++) {
    if ($i != $end)
        echo $i."=".chr($i).", ";
    else
        echo $i."=".chr($i);
}
echo "<br><br>";

$ungerade = true;
$start = 0;
$end = 100;
$pre = $ungerade ? "Ungerade" : "Gerade";
echo "$pre Zahlen von $start bis $end: <br>";
for ($i = $start; $i <= $end; $i++){
    if ($i % 2 == (int)$ungerade){
        if ($i != $end)
            echo $i. ", ";
        else
            echo $i;
    }
}
echo "<br><br>";

$start = 0;
$end = 1000;
echo "Primzahlen von $start bis $end: <br>";
$primzahlen = array();
for ($i = $start; $i <= $end; $i++){
    $primzahl = true;
    foreach ($primzahlen as $prim){
        if ($i % $prim == 0){
            $primzahl = false;
        }
    }
    if ($primzahl == true){
        if ($i != 0 && $i != 1)
            array_push($primzahlen, $i);

        if ($i != $end)
            echo $i.", ";
        else
            echo $i;
    }
}
?>