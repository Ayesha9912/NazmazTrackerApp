<?php

header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow Content-Type and Authorization headers
header("Access-Control-Allow-Credentials: true"); // Allow credentials (optional)

$db_name = 'mysql:host=localhost;dbname=namaz_db';
$user = 'root';
$user_password = '';
try{
    $conn = new PDO($db_name, $user, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    //there are other modes too like errmode_ailent and errmode_warning but for production projects errmode_exception is best
}catch(Exception $e){
    $e->getMessage();
}
?>