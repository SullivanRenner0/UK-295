<?php
namespace App\Lager;

use PDO;

class Lager{
    private const file = "../data/lager.sqlite3";
    private ?\SQLite3 $db = null;
    public function __construct($method = "", $param = null){
        //localhost:82/lager
        // echo "<br>Lager :: Konstruktor";
        $this->CheckDB();
        $this->db = new \SQLite3($this::file);

        if (method_exists($this, $method))
            $this->{$method}($param);
    }
    public function __destruct(){
        $this->db = null;
    }

    public function resetData(){
        if (file_exists($this::file))
        {
            $this->db = null;
            unlink($this::file);
        }
        $this->CheckDB();
    }

    public function CheckDB(){
        // echo "<br>Lager -> CheckDB";
        if (!file_exists($this::file))
        {
            $db = new \SQLite3($this::file);
            $db->exec("CREATE TABLE lager (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       name TEXT,
                       preis REAL,
                       menge INTEGER
                    )");

            $db->exec("INSERT INTO lager 
                      (name, preis, menge) VALUES
                      ('Brot', 1.5, 10),
                      ('Milch', 1.0, 20),
                      ('Käse', 2.5, 5)");
        }
    }

    public function GetData(){
        // echo "<br>Lager -> GetData"
        $id = $_GET["id"] ?? 0;

        if ($id <= 0)
        {
            $sql = "SELECT * FROM lager";
            $result = $this->db->query($sql);
        }
        else
        {
            $sql = "SELECT * FROM lager where id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
            $result = $stmt->execute();
        }

        $data = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $data[] = $row;
        }
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        // echo json_encode($data);
        // return json_encode($data);
    }

    public function insertData(){
        header("Content-Type: application/json; charset=UTF-8");
        if (!isset($_POST["name"]) || !isset($_POST["preis"]) || !isset($_POST["menge"]))
        {
            echo json_encode(array(false));
            return;
        }

        $name = $_POST["name"];
        $preis = $_POST["preis"];
        $menge = $_POST["menge"];

        $sql = "INSERT INTO lager (name, preis, menge) VALUES (:name, :preis, :menge)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":preis", $preis, SQLITE3_FLOAT);
        $stmt->bindValue(":menge", $menge, SQLITE3_INTEGER);
        if ($stmt->execute())
            echo json_encode(array(true));
        else
            echo json_encode(array(false));
    }
    public function updateData(){
        header("Content-Type: application/json; charset=UTF-8");
        if (!isset($_POST["id"]) || !isset($_POST["name"]) || !isset($_POST["preis"]) || !isset($_POST["menge"]))
        {
            echo json_encode(array(false));
            return;
        }

        $id = $_POST["id"];
        $name = $_POST["name"];
        $preis = $_POST["preis"];
        $menge = $_POST["menge"];


        $sql = "UPDATE lager SET name = :name, preis = :preis, menge = :menge WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":preis", $preis, SQLITE3_FLOAT);
        $stmt->bindValue(":menge", $menge, SQLITE3_INTEGER);
        if ($stmt->execute())
            echo json_encode(array(true));
        else
            echo json_encode(array(false));
    }
    public function deleteData(){
        if (isset($_POST["id"]))
            $id = $_POST["id"];
        else
        {
            echo json_encode(array(false));
            return;
        }
        $sql = "DELETE FROM lager WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        if ($stmt->execute())
            echo json_encode(array(true));
        else
            echo json_encode(array(false));
    }

    public function prepare($parameter = 1){
        //localhost:82/lager/prepare
        echo "parameter: $parameter<br>";
        $sql = "SELECT * FROM lager where id = 7";
        $sql = "SELECT * FROM lager where id = ".$parameter;
        $sql = "SELECT * FROM lager where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $parameter, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        echo "<pre>";
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            print_r($row);
        }
        echo "</pre>";

        $insert = "INSERT INTO lager (name, preis, menge) VALUES (:name, :preis, :menge)";
        $stmt = $this->db->prepare($insert);
        $stmt->bindValue(":name", "Kaffee", SQLITE3_TEXT);
        $stmt->bindValue(":preis", 2.5, SQLITE3_FLOAT);
        $stmt->bindValue(":menge", 10, SQLITE3_INTEGER);
        // $stmt->execute();
    }

    private function prepareSqli(){
        $ini = parse_ini_file("../../settings.ini", true);
        $sql = "UPDATE users SET vorname = ?, age = ? WHERE id = ? ";
        $db = new \mysqli($ini["mysql"]["host"], $ini["mysql"]["user"], $ini["mysql"]["password"], $ini["mysql"]["db"]);
        $stmt = $db->prepare($sql);
        $vorname = "Hans";
        $age = 20;
        $stmt->bind_param("sii", $vorname, $age, $id);
        echo "<pre>";
        echo $stmt->execute();
        echo "</pre>";
    }
}
?>