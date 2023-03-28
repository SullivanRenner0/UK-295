<?php
namespace App\Kunden;

class kunden{
    public function __construct($method = "", $param = null){
        echo "<br>Kunden :: Konstruktor<br>";
        if (trim($method) != "")
            $this->{$method}($param);
    }

    public function Test(){
        echo "<br>Kunden -> Test<br>";
    }

    public function run(){
        echo "<br>Kunden -> run<br>";
    }
}
?>