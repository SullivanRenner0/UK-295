<?php
namespace Tag2;

$obj = new MyClass("Sullivan", 16);
// echo $obj();
$data = $obj->getData(1);
$obj->__destruct();
Ausgabe::ShowJson($data);


class MyVorlage{
    public function __construct(){
        echo "MyVorlage Konstruktor<br>";
    }
    public function __destruct(){
        echo "MyVorlage Destruktor<br>";
    }
}
interface MyInterface{
    public function getData($id);
    public function insertData($id);
    public function deleteData($id);

}

class MyClass extends MyVorlage implements MyInterface{
    public $name = "Tag2";
    private $age = 20;

    public function __construct($name = "Sullivan", $age = 16){
        parent::__construct();
        $this->name = $name;
        $this->age = $age;
        echo "Konstruktor:<br>";
        echo json_encode($this)."<br><br>";
    }

    public function __toString(){
        
        return "toString:<br>".json_encode($this)."<br><br>";
    }
    public function __invoke(){
        return "invoke:<br>".json_encode($this)."<br><br>";
    }
    
    public function getData($id){
        $array = array("id" => $id, "age" => $this->age);
        return $array;
    }
    public function insertData($id){

    }
    public function deleteData($id){

    }
}


abstract class Ausgabe{
    public static function ShowJson($data){
        echo json_encode($data);
    }
    public static function ShowEcho($data){
        echo $data;
    }
    public static function ShowPre($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
?>