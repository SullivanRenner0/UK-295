<?php
namespace App\Kunden;

class model{
    public function __construct($method = "", $param = null){
        echo "<br>Kunden-Model :: Konstruktor<br>";
        if (trim($method) != "")
            $this->{$method}($param);
    }

    public function Test(){
        echo "<br>Kunden-Model -> Test<br>";
    }

    public function run(){
        echo "<br>Kunden-Model -> run<br>";
    }
}
?>