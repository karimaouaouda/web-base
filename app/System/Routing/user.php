<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=aya" , "root", "");
}catch(PDOException $e){
    echo "error : ".$e->getMessage();
}
session_start();
$email = $_POST['email'];
$pass = $_POST['password'];
if(!filter_var($email,FILTER_VALIDATE_EMAIL) ){
    $_SESSION['error'] = "unvalid email";
    header("location:".$_SERVER['http_referer']);
}
if (strlen($pass)<5){
    $_SESSION['error'] = "unvalid email";
    header("location:" . $_SERVER['http_referer']);
    
}