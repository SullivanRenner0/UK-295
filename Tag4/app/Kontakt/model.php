<?php
namespace App\Kontakt;

class Model{
    public function __construct($method = "", $param = null){
        echo "<br>Kontakt-Model :: Konstruktor<br>";
        if (trim($method) != "")
            $this->{$method}($param);
    }

    public function Test(){
        echo "<br>Kontakt-Model -> Test<br>";
    }

    public function run(){
        echo "<br>Kontakt-Model -> run<br>";
    }
}
?>