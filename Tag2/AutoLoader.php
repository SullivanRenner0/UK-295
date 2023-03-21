<?php
class AutoLoader{
    
    public static function register(): bool{
        $result = false;
        spl_autoload_register(function($class){
            if (file_exists($class.".php"))
            {
                include($class.".php");
                $result =  true;
            }
            else
            {
                //echo "<br>Class not found: ".$class."<br>";
                $result = false;
            }
        });
        return $result;
        // spl_autoload_register([$this, "load"]);
    }
}
?>