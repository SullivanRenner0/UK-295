<?php
namespace App;
use Lib\Database;

class Users{
    public function __construct($method= "", $param = null){
        // echo "<br>Users :: Konstruktor<br>";
        if (trim($method) != "")
            $this->{$method}($param);
    }

    public function Test(){
        echo "<br>Users -> Test<br>";
    }

    public function run(){
        echo "<br>Users -> run<br>";
    }

    public function GetData($id = ""){
        header("Content-Type: application/json; charset=UTF-8");
        // echo "<br>Users -> GetData<br>";
        $database = new Database();
        $data = $database->GetDataById($id);
        echo json_encode($data);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }

    public function deleteData($data = null){
        header("Content-Type: application/json; charset=UTF-8");
        // echo "<br>Users -> deleteData<br>";
        if (!isset($_POST["id"]))
        {
            echo json_encode(array(false));
            return;
        }

        $id = $_POST["id"];
        $database = new Database();
        $success =  $database->deleteDataById($id);
        echo json_encode(array($success));
    }

    public function insertData($data = null){
        header("Content-Type: application/json; charset=UTF-8");
        // echo "<br>Users -> insertData<br>";
        // $age = $data[0];
        // $name = $data[1];
        if (!isset($_POST["age"]) || !isset($_POST["name"]))
        {
            echo json_encode(array(false));
            return;
        }


        $age = $_POST["age"];
        $name = $_POST["name"];
        $database = new Database();
        $success =  $database->insertData($age, $name);
        echo json_encode(array($success));
    }
    public function updateData($data = null){
        header("Content-Type: application/json; charset=UTF-8");
        // echo "<br>Users -> insertData<br>";
        // $id = $data[0];
        // $age = $data[1];
        // $name = $data[2];
        if (!isset($_POST["id"]) || !isset($_POST["age"]) || !isset($_POST["name"]))
        {
            echo json_encode(array(false));
            return;
        }

        $id = $_POST["id"];
        $age = $_POST["age"];
        $name = $_POST["name"];
        $database = new Database();
        $success =  $database->updateData($id, $age, $name);
        echo json_encode(array($success));
    }

    public function resetDatabase($param = null){
        header("Content-Type: application/json; charset=UTF-8");
        // echo "<br>Users -> resetDatabase<br>";
        $database = new Database();
        $success = $database->resetDatabase();
        echo json_encode(array($success));
    }

    public function saveData($param = null){
        $id = $_POST["id"] ?? 0;
        if ($id <= 0)
        {
            $database = new Database();
            $data = $database->GetDataById($id);
            if (count($data) > 0)
                $this->updateData();
            else
            $this->insertData();
        }
        else{
            $this->insertData();
        }
    }
}

?>