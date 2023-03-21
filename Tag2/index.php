<?php
use App\Users;
use Steampixel\Route;

include("AutoLoader.php");
AutoLoader::register();

Route::add('/', function(){
    echo "Startseite";
});
Route::add('/info', function(){
    phpinfo();
});

// Route::add('/App/Users/insertData/([0-9]*)/([a-zA-Z]*)', function($age, $name){
//     $user = new Users();
//     $user->insertData($age, $name);
// }, ["get", "post"]);
// Route::add('/App/Users/updateData/([0-9]*)/([0-9]*)/([a-zA-Z]*)', function($id, $age, $name){
//     $user = new Users();
//     $user->updateData($id, $age, $name);
// }, ["get", "post"]);

Route::add('/([a-zA-Z0-9]*)', function($class){
    Run("App\\".$class);
    // $class = "App\\".$class;
    // $app = new $class();
}, ["get", "post"]);
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $method){
    Run("App\\".$class, $method);
    // $class = "App\\".$class;
    // $app = new $class($method);
    // $app->$method();
}, ["get", "post"]);
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/(.*)', function($class, $method, $param){
    $param = explode("/", $param);
    if (count($param) == 1)
        $param = $param[0];
    
    Run("App\\".$class, $method, $param);
    // $class = "App\\".$class;
    // $app = new $class($method, $param);
    // $app->$method($param);
}, ["get", "post"]);

function Run($class, $method = null, $param = null){
    try{
        if (!class_exists($class))
            return;
        }
    catch(Exception $e){
        // echo $e->getMessage();
        return;
    }
    $app = new $class();
    
    if ($method == null || !method_exists($class, $method))
        return;
        
    if ($param == null)
        $app->$method();
    else
        $app->$method($param);
}

Route::run('/');
?>