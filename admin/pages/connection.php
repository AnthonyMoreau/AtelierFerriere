<?php 
    session_start();
    $_SESSION["errors"] = "";

    if($_SESSION["auth"] === false){
        $_SESSION["errors"] = "Bonjour, vous devez vous connecter pour créer un article";
    }
    if($_SESSION["auth"] !== true and $_SESSION["auth"] !== false){
        $_SESSION["errors"] = "Pour accéder à cette page, vous devez vous connecter !";
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
        <div class="admin-content-connection">
            <nav id="nav" role="nav">
                <div class="nav">
                    <a href="../index.php">Retour sur le site</a>
                </div>
            </nav>
            <div class="connection">
                <h3>Connection</h3>
                <p class="error">
                    <?= $_SESSION["errors"] ?>
                </p>

                <form action="#" method="post">
                    <p>
                        <input id="user-name" type="text" placeholder="Name">
                    </p>
                    <p>
                        <input id="user-password" type="text" placeholder="password">
                    </p>
                    <p>
                        <input id="user-password" type="submit" value="Connection">
                    </p>
                </form>
            </div>
        </div>
        </div
