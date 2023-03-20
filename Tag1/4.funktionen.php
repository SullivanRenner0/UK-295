<?php
$var1 = 0;
function getJson($array) 
{
    return json_encode($array);
}
function pre($array){
    return "<pre>".print_r($array, true)."</pre>";
}
function getData($id= 0, $callback = "pre"){
    // global $var1;
    // echo $var1;
    $array = array("id" => $id, "name" => "Peter");
    return $callback($array);
}

echo getData(0, "getJson");

?>