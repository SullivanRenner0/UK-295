<?php
namespace App;

class Lager{
    private ?\SQLite3 $db = null;
    public function __construct($method = "", $param = null){
        //localhost:82/lager
        // echo "<br>Lager :: Konstruktor";
        $this->CheckDB();
        $this->db = new \SQLite3("lager.sqlite3");

        if (method_exists($this, $method))
            $this->{$method}($param);
    }
    public function __destruct(){
        $this->db = null;
    }

    public function resetData(){
        if (file_exists("lager.sqlite3"))
        {
            $this->db = null;
            unlink("lager.sqlite3");
            echo "gelöscht";
        }
        $this->CheckDB();
    }

    public function CheckDB(){
        // echo "<br>Lager -> CheckDB";
        if (!file_exists("lager.sqlite3"))
        {
            $db = new \SQLite3("lager.sqlite3");
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
            $sql = "SELECT * FROM lager";
        else
        $sql = "SELECT * FROM lager where id = $id";

        $result = $this->db->query($sql);
        $data = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $data[] = $row;
        }
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        // echo json_encode($data);
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

        $sql = "INSERT INTO lager (name, preis, menge) VALUES ('$name', $preis, $menge)";
        $this->db->query($sql);
        echo json_encode(array(true));
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

        $sql = "UPDATE lager SET name = '$name', preis = $preis, menge = $menge WHERE id = $id";
        $this->db->query($sql);
        echo json_encode(array(true));
    }
    public function deleteData($id){
        $sql = "DELETE FROM lager WHERE id = $id";
        $this->db->query($sql);
        echo json_encode(array(true));
    }
}
?>