<?php

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Creadentials: true");


use Steampixel\Route;

require('../vendor/autoload.php');

Route::add('/', function(){
    echo "Startseite";
});
Route::add('/info', function(){
    phpinfo();
});

Route::add('/Kunden', function(){
    $app = new \App\kurs();

}, ["get"]);

Route::add("/Kurs/([a-zA-Z0-9_]*)", function($method){
    $app = new \App\kurs();
    if (method_exists($app, $method))
        $app->{$method}();
}, ["get"]);


Route::run('/');
?>