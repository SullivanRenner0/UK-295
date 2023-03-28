<?php

//PHP Session
session_start();

//Session - Variable für Login setzten
//$_SESSION['login'] = true;
if (!isset($_GET['login']))
    $_SESSION['login'] = false;

// $IP = $_SERVER['REMOTE_ADDR'];
// // echo $IP;
// $IP = "85.64.63.120";
// $apiURL = "http://ip-api.com/json/$IP";
// $apiData = file_get_contents($apiURL);
// $apiData = json_decode($apiData, true);
// echo "<pre>";
// print_r($apiData);
// echo "</pre>";

//Session - Variable für Login auslesen
// echo $_SESSION['login'];

//Falls Daten aus Formular übergeben wurden - check Login
if ($_POST){
    $_SESSION['login'] = $_POST['username'] == 'admin' && $_POST['password'] == '1234';
}

if (isset($_GET['logout']))
    $_SESSION['login'] = false;

if ($_SESSION['login'])
{
    //Falls login true - dann Home-Seite anzeigen
    echo "Hallo Admin!";
    echo "<br><a href='?logout'>Logout</a>";
}
else
{
    //Falls login false - dann Login-Seite anzeigen
    echo "<form action='login.php' method='post'>
    <input type='text' name='username' placeholder='Username'>
    <input type='password' name='password' placeholder='Password'>
    <input type='submit' value='Login'>
    </form>";
}

?>