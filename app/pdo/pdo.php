<?php 

$db_charset = "UTF8";

$db_name = "epiz_24255669_atelier";
$db_host = "sql312.epizy.com";
$db_user = "epiz_24255669";
$db_pass = "mZ4snWc14YfWkn";

if(!isset($pdo)){

    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host;charset=$db_charset", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} else {

    return $pdo;
    
}
