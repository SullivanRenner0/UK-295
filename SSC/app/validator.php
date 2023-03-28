<?php
namespace App;

abstract class validator{
    
    public static function checkKursData($data): bool{
        $v = new \Valitron\Validator($data);
        $v->rule('required', ['name', 'sart', 'ende']);
        $v->rule("lengthMin", "name", 1);
        $v->rule("lengthMax", "name", 255);
        $v->rule("date", "sart");
        $v->rule("date", "ende");
        
        return $v->validate();
    }
    public static function checkID($data) : bool
    {
        $v = new \Valitron\Validator($data);
        $v->rule('required', ['id']);
        $v->rule("integer", "id");
        $v->rule("min", "id", 1);
        $v->rule("max", "id", 9223372036854775807);
        return $v->validate();
    }
}
?>