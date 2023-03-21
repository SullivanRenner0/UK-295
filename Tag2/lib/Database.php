<?php
namespace Lib;
use Exception;

class Database{
    private \mysqli $conn;
    public function __construct($method = "", $param = null){
        // echo "<br>Lib\Database :: Konstruktor<br>";
        $ini = parse_ini_file("../settings.ini", true);
        $this->conn = new \mysqli($ini["mysql"]["host"], $ini["mysql"]["user"], $ini["mysql"]["password"], $ini["mysql"]["db"]);
        if ($method != "")
            $this->{$method}($param);
    }

    public function __destruct(){
        // echo "<br>Lib\Database :: Destruktor<br>";
        $this->conn->close();
    }

    public function Run($sql) {
        return $this->conn->query($sql);
    }
    function ResetDatabase() : bool{
        try{
            $inhalt = file_get_contents("./lib/test.sql");
            $query = $this->conn->multi_query($inhalt);
            if ($query)
            {
                // echo "Erfolg";
                return true;
            }
            else
                throw new Exception("Fehler beim Ausführen des SQL-Statements");
        }
        catch(Exception $e){
            // echo $e->getMessage();
            return false;
        }
    }

    public function GetDataById($id){
        // echo "<br>Lib\Database -> GetData : $sql<br>";
        try{

            if ($id == 0 || trim($id) == "")
                $sql = "Select * from users";
            else
                $sql = "Select * from users where id = $id";

            $query = $this->Run($sql);
            if ($query){
                $array = array();
                while ($row = $query->fetch_assoc()){
                    $array[] = $row;
                }

                // header("Content-Type: application/json; charset=UTF-8");
                // echo json_encode($array);
                // return true;
                return $array;
            }
            else
                throw new Exception("Fehler beim holen der Daten");
        }
        catch (Exception $e){
            // echo $e->getMessage();
            return array();
        }
    }
    public function deleteDataById($id) : bool{
        // echo "<br>Lib\Database -> GetData : $sql<br>";
        try{
            
            // $len = strlen("delete from");
            // if (strncasecmp($sql, "delete from", $len) != 0)
            //     throw new Exception("Sql-Statement muss mit delete from beginnen");
            if ($id < 0)
                throw new Exception("Id muss größer 0 sein");

            $sql = "delete from users where id = $id";
            $query = $this->Run($sql);
            if ($query){
                // echo "Erfolgreich gelöscht";
                return true;
            }
            else
                throw new Exception("Fehler beim holen der Daten");
        }
        catch (Exception $e){
            // echo $e->getMessage();
            return false;
        }
    }
    public function insertData($age, $name) : bool{
        try{
            $sql = "insert into users (age, vorname) values ($age, '$name');";
            $query = $this->Run($sql);
            
            if ($query){
                // echo "Erfolgreich gelöscht";
                return true;
            }
            else
                throw new Exception("Fehler beim hinzufügen der Daten");
        }
        catch (Exception $e){
            // echo $e->getMessage();
            return false;
        }
    }
    public function updateData($id, $age, $name){
        try{
            $sql = "UPDATE users SET age = $age, vorname = '$name' WHERE id = $id";
            $query = $this->Run($sql);
            
            if ($query){
                // echo "Erfolgreich gelöscht";
                return true;
            }
            else
                throw new Exception("Fehler beim updaten der Daten");
        }
        catch (Exception $e){
            // echo $e->getMessage();
            return false;
        }
    }
}
?>