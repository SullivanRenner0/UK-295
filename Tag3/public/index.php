<?php
use App\Kontakt\Kontakt;
use Lib\Database;
use Steampixel\Route;

require('../vendor/autoload.php');

Route::add('/', function(){
    echo "Startseite";
});
Route::add('/info', function(){
    phpinfo();
});

Route::add("/Kontakt", function(){
    $app = new Kontakt();
    $app->Convert();
    // $class = "App\\Kontakt\\Kontakt";
    // new $class("Convert", "./readme.md");
});

Route::add('/Kunden', function(){
    $class = "App\\Kunden\\kunden";
    echo $class;
    Run($class);
}, ["get", "post"]);

Route::add('/Kunden/([a-zA-Z0-9_]*)', function($method){
    $class = "App\\Kunden\\kunden";
    Run($class, $method);
}, ["get", "post"]);

Route::add('/Kunden/([a-zA-Z0-9_]*)/([a-zA-Z0-9_]*)', function($method, $param){
    $class = "App\\Kunden\\kunden";
    Run($class, $method, $param);
}, ["get", "post"]);

Route::add('/Lager/([a-zA-Z0-9_]*)', function($method){
    $class = "App\\Lager\\Lager";
    Run($class, $method);
}, ["get", "post"]);

Route::add('/Lager/([a-zA-Z0-9_]*)/(.*)', function($method, $param){
    $param = explode("/", $param);
    if (count($param) == 1)
        $param = $param[0];
    $class = "App\\Lager\\Lager";
    Run($class, $method, $param);
}, ["get", "post"]);

Route::add('/([a-zA-Z0-9]*)', function($class){
    Run("App\\".$class);
    // $class = "App\\".$class;
    // $app = new $class();
}, ["get", "post"]);
Route::add('/([a-zA-Z0-9_]*)/([a-zA-Z0-9_]*)', function($class, $method){
    Run("App\\".$class, $method);
    // $class = "App\\".$class;
    // $app = new $class($method);
    // $app->$method();
}, ["get", "post"]);
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9_]*)/(.*)', function($class, $method, $param){
    $param = explode("/", $param);
    if (count($param) == 1)
        $param = $param[0];
    
    Run("App\\".$class, $method, $param);
    // $class = "App\\".$class;
    // $app = new $class($method, $param);
    // $app->$method($param);
}, ["get", "post"]);

Route::pathNotFound(function($path) {
    $_GET["message"] = "Route $path nicht gefunden";
    include("../error/404.php");
    // echo "Route $path nicht gefunden";
});

Route::run('/');

function Run($class, $method = null, $param = null){
    try
    {
        if (!class_exists($class))
        {
            // $_GET["message"] = "Klasse $class nicht gefunden";
            // include("../error/404.php");
            echo "Klasse $class nicht gefunden";
            // return;
        }
    }
    catch(Exception $e)
    {
        $_GET["message"] = $e->getMessage();
        include("../error/404.php");
        return;
    }

    $app = new $class();
    if ($method == null)
        return;
    
    if (!method_exists($class, $method))
    {
        $_GET["message"] = "Methode $class -> $method nicht gefunden";
        include("../error/404.php");
        return;
    }
        
    try{
        if ($param == null)
            $app->$method();
        else
            $app->$method($param);
    }
    catch(Exception $e){ 
        if(strpos($e->getMessage(), 'Call to private method') !== false) {
            $_GET["message"] = "Methode $class -> $method ist private";
            // include("../error/404.php");
            return;
      } else {
        // Re-throw the error if it's not the expected error
        throw $e;
      }
    }
}

?>