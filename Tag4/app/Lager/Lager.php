<?php
namespace App\Lager;

use Lib\checkData;
use PDO;

class Lager{
    private const file = "../data/lager.sqlite3";
    private ?\SQLite3 $db = null;
    public function __construct($method = "getdata", $param = 0){
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

    public function resetData() : bool{
        if (file_exists($this::file))
        {
            $this->db = null;
            unlink($this::file);
        }
        return $this->CheckDB();
    }

    public function CheckDB() : bool{
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
        return true;
    }

    public function GetData($param) : string
    {
        // echo "<br>Lager -> GetData"
        if (checkData::checkLagerData($_GET) && checkData::checkID($_GET) && $_GET["id"] > 0)
        {
            $sql = "SELECT * FROM lager where id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $_GET["id"], SQLITE3_INTEGER);
            $result = $stmt->execute();
        }
        else
        {
            $sql = "SELECT * FROM lager";
            $result = $this->db->query($sql);
        }

        $data = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $data[] = $row;
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // echo json_encode($data);
        // return json_encode($data);
        return json_encode($data);
    }

    public function insertData(): string
    {
        header("Content-Type: application/json; charset=UTF-8");
        if (!checkData::checkLagerData($_POST))
            return json_encode(array(false));

        $name = $_POST["name"];
        $preis = $_POST["preis"];
        $menge = $_POST["menge"];

        $sql = "INSERT INTO lager (name, preis, menge) VALUES (:name, :preis, :menge)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":preis", $preis, SQLITE3_FLOAT);
        $stmt->bindValue(":menge", $menge, SQLITE3_INTEGER);
        return json_encode(array((bool)$stmt->execute()));
        // if ($stmt->execute())
        //     echo json_encode(array(true));
        // else
        //     echo json_encode(array(false));
    }
    public function updateData() : string
    {
        header("Content-Type: application/json; charset=UTF-8");
        if (!checkData::checkLagerData($_POST) || !checkData::checkID($_POST))
            return json_encode(false);

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
        return json_encode(array((bool)$stmt->execute()));
        // if ($stmt->execute())
        //     echo json_encode(array(true));
        // else
        //     echo json_encode(array(false));
    }
    public function deleteData() : string{
        if (!checkData::checkID($_POST))
            return json_encode(array(false));

        $id = $_POST["id"];
        $sql = "DELETE FROM lager WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        return json_encode(array((bool)$stmt->execute()));
        // if ($stmt->execute())
        //     echo json_encode(array(true));
        // else
        //     echo json_encode(array(false));
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