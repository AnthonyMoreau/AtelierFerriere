<?php 
    session_start();
    
    if($_SESSION["auth"] !==true ){
        $_SESSION["auth"] = "noPermission";
        header("location: index.php?admin=connection");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="../../style.css">
    <title><?= $title ?></title>
</head>
<body>
    <div class="container-admin">
        <nav id="nav" role="nav">
            <div class="nav">
                <a href="../../index.php">Retour sur le site</a>
                <a href="<?= get_link("admin")?>edit">Edit</a>
            </div>
        </nav>