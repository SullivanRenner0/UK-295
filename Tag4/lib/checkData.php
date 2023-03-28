<?php
namespace Lib;

abstract class checkData{
    public static function checkLagerData($data) : bool{
        $v = new \Valitron\Validator($data);
        $v->rule('required', ['name', 'preis', 'menge']);
        $v->rule("lengthMin", "name", 1);
        $v->rule("lengthMax", "name", 255);
        $v->rule("numeric", "preis");
        $v->rule("min", "preis", 0);
        $v->rule("max", "preis", 9223372036854775807);
        $v->rule("integer", "menge");
        $v->rule("min", "menge", 0);
        $v->rule("max", "menge", 9223372036854775807);
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