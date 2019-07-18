<?php 

$db_name = "atelier";
$db_host = "127.0.0.1";
$db_user = "admin";
$db_pass = "plop";

$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);