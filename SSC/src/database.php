<?php
namespace src;

use App\validator;

class database{
    const file = "../src/database.sqlite3";
    private $db;
    public function __construct(){
        $this->CheckDB();
    }

    public function __destruct(){
        $this->db = null;
    }
    public function CheckDB(){
        // echo "<br>Lager -> CheckDB";
        if (!file_exists($this::file))
        {
            $db = new \SQLite3($this::file);
            $db->exec("CREATE TABLE kurse (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       name TEXT,
                       start DATETIME,
                       ENDE DATETIME
                    )");
            
            $this->db = $db;
        }
        if ($this->db == null)
            $this->db = new \SQLite3($this::file);

    }

    public function getData($data){
        $id = $data["id"] ?? 0;

        if ($id >= 1){
            $sql = "SELECT * FROM kurse WHERE id = :id";
        }
        else{
            $sql = "SELECT * FROM kurse";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $stmt->execute();
        $result = $stmt->execute();
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function deleteData($data){
        if (!isset($data))
            return;

        $id = $data["id"];
        $sql = "DELETE FROM kurse WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $stmt->execute();
    }

    public function updateData($data){

        if (!validator::checkKursData($data) || !validator::checkID($data))
            return;

        $id = $data["id"];
        $name = $data["name"];
        $start = $data["start"];
        $ende = $data["ende"];

        $sql = "UPDATE kurse SET name = :name, start = :start, ende = :ende WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":start", $start, SQLITE3_TEXT);
        $stmt->bindValue(":ende", $ende, SQLITE3_TEXT);
        $stmt->execute();
    }

    public function insertData($data){
        print_r($data);
        if (!validator::checkKursData($_GET))
        {
            echo "Fehler";
            return;
        }

        $name = $data["name"];
        $start = $data["start"];
        $ende = $data["ende"];

        $sql = "INSERT INTO kurse (name, start, ende) VALUES (:name, :start, :ende)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":start", $start, SQLITE3_TEXT);
        $stmt->bindValue(":ende", $ende, SQLITE3_TEXT);
        $stmt->execute();        
    }
}

?>