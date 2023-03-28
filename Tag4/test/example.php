<?php

use PHPUnit\Framework\Assert;

require("vendor/autoload.php");

class example extends PHPUnit\Framework\TestCase
{
    public function testReset(){
        $users = new App\Lager\Lager();
        $this->assertTrue($users->resetData());
    }

    public function testString(){
        //$postData = $_POST
        $postData = array();
        $postData["myMail"] = "no@no.no";
        $postData["myString"] = "asdfgh<div>Hallo</div>";
        $postData["myZahl"] = 123;
        $postData["myPreis"] = 123;

        $v = new Valitron\Validator($postData);
        $v->rule('required', ['myMail', 'myString', 'myZahl']);
        $v->rule('email', 'myMail');
        $v->rule('lengthMin', 'myString', 5);
        $v->rule('lengthMax', 'myString', 10);
        $v->rule('integer', 'myZahl');
        $v->rule('min', 'myZahl', 100);
        $v->rule('max', 'myZahl', 200);
        $this->assertTrue($v->validate());
    }
    public function testExample()
    {
        $i = 4;
        $this->assertEquals(4, $i);
    }

    public function testExample2()
    {
        $users = new App\Lager\Lager();
        $this->assertJson(json_encode($users->GetData(3)));
    }

    public function isText($text) : bool
    {
        return (bool)preg_match("/[a-zA-Z0-9=]+/", $text);
    }

    public function testText1(){
        $text = "asdfgasdf";
        $this->assertIsString($text);
    }

    public function testText2(){
        $text = "345678543456";
        $this->assertIsString($text);
    }

    public function testText3(){
        $text = "<h1>asdfg345678543456</h1>";
        $this->assertIsString($text);
    }

    public function testText4(){
        $text = "xxx ' OR 1=1";
        $this->assertIsString($text);
    }

    public function testEmail(){
        $email = 'bob.ede.edr@e.x.a.m.ple.com';
        $this->assertTrue((bool)filter_var($email, FILTER_VALIDATE_EMAIL));
    }
}
?>