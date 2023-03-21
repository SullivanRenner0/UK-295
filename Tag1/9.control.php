<?php
$ini = parse_ini_file("../settings.ini", true);
$conn = new mysqli($ini["mysql"]["host"], $ini["mysql"]["user"], $ini["mysql"]["password"], $ini["mysql"]["db"]);
// echo "<pre>";
// print_r($ini);
// echo "</pre>";
// echo $ini["mysql"]["host"] . "<br>";
//......./9.control.php
//getData
//deleteData
//updateData
//insertData

//....../9.control.php?action=xxxxxxxx
$action = $_GET["action"] ?? "' '";
if (function_exists($action))
    $action();
else if (file_exists($action.".php"))
    include($action.".php");
else
    echo "Funktion oder Datei $action existiert nicht";


function dbtest(){
    global $conn;
    $sql = "Select * from users";
    $query = $conn->query($sql);
    $array = array();
    while ($row = $query->fetch_assoc()){
        $array[] = $row;
    }
    echo "<pre>";
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($array);
    echo "</pre>";
    // echo json_encode($array);
}
dbexists();
function dbexists($name="test"){
    global $ini;
    $conn = new mysqli($ini["mysql"]["host"], $ini["mysql"]["user"], $ini["mysql"]["password"]);
    try{
        $query = $conn->query("use $name");
    }
    catch(Exception $e){
        $inhalt = file_get_contents("test.sql");
        $query = $conn->multi_query($inhalt);
    }
}

function ResetDatabase(){
    global $ini;
    $conn = new mysqli($ini["mysql"]["host"], $ini["mysql"]["user"], $ini["mysql"]["password"]);
    try{
        $inhalt = file_get_contents("test.sql");
        $query = $conn->multi_query($inhalt);
        echo "Erfolg";
        return true;
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}
function getData(){
    try{
        global $conn;
        if (isset($_GET["id"]) && $_GET["id"] != 0)
        {
            $id = $_GET["id"];
            $sql = "Select * from users where id = $id";
            $query = $conn->query($sql);
            if ($query){
                $array = array();
                while ($row = $query->fetch_assoc()){
                    $array[] = $row;
                }
                if (count($array) == 0)
                    throw new Exception("Fehler - id nicht gefunden");

                header("Content-Type: application/json; charset=UTF-8");
                echo json_encode($array);
                return true;
            }
            else
                throw new Exception("Fehler beim holen der Daten");
        }
        else
        {
            $sql = "Select * from users";
            $query = $conn->query($sql);
            if ($query){
                $array = array();
                while ($row = $query->fetch_assoc()){
                    $array[] = $row;
                }
                header("Content-Type: application/json; charset=UTF-8");
                echo json_encode($array);
                return true;
            }
            else
                throw new Exception("Fehler beim holen der Daten");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
        
        return false;
    }
}
function insertData(){
    $data = $_POST;
    global $ini;
    try{
        global $conn;
        if (!isset($data["name"]) || !isset($data["age"])){
        throw new Exception("Fehler - name und age müssen gesetzt sein");
    }
        
    $sql = "Insert into users (vorname, age) values ('$data[name]', $data[age])";
    if ($conn->query($sql)){
        echo "Erfolg";
        return true;
    }
    else
        throw new Exception("Fehler beim Einfügen");
    }
    catch (Exception $e){
        echo $e->getMessage();
        return false;
    }
}
function updateData(){
    try{
        if (!isset($_GET["id"]) || !isset($_GET["name"]) || !isset($_GET["age"])){
            throw new Exception("Fehler - id, name und age müssen gesetzt sein");
        }
        global $conn;
        $sql = "Update users set vorname = '$_GET[name]', age = $_GET[age] where id = $_GET[id]";
        if ($conn->query($sql))
        {
            echo "Erfolg";
            return true;
        }
        else
            throw new Exception("Fehler beim Updaten");
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}   
function deleteData(){
    try{
    if (isset($_GET["id"]))
    {
        global $conn;
        $id = $_GET["id"];
        $sql = "Delete from users where id = $id";
        if ($conn->query($sql))
            echo "Erfolg";
        else
            throw new Exception("Fehler beim Löschen");
    }
    else
        throw new Exception("Fehler - id muss gesetzt sein");
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}
function xxx(){
    echo "xxx";
}
function info()
{
    phpinfo();
}
?>