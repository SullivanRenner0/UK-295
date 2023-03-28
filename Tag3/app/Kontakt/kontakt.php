<?php
namespace App\Kontakt;

use Parsedown;

class Kontakt{
    public function __construct($method = "", $param = null){
        if (trim($method) != "")
            $this->{$method}($param);
    }

    public function Convert($file = null): bool{
        if ($file == null || trim($file) == "" || !file_exists($file))
        {
            $file = dirname(__FILE__).'/readme.md';
        }
        if (!file_exists($file))
        {
            echo "File not found";
            return false;
        }
        
        $data = file_get_contents($file);
        $data = Parsedown::instance()->text($data);
        echo $data;
        return true;
    }

    public function run(){
        echo "<br>Kontakt -> run<br>";
    }
}
?>