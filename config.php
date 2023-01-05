<?php
try{
    $host = "localhost";
    $dbname  = "short-urls";
    $user = "root";
    $pass = "";
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo "error is : ". $ex->getMessage() ;
}
define("HOME", "http://localhost/short-urls");