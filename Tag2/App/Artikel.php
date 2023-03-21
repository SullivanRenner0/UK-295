<?php
namespace App;

class Artikel{
    public function __construct($method, $param = null){
        echo "<br>Artikel :: Konstruktor<br>";
        $this->{$method}();
    }
    public function Test(){
        echo "<br>Artikel -> Test<br>";
    }

    public function run(){
        echo "<br>Artikel -> run<br>";
    }
}
?>