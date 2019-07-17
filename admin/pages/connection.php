<?php 
    session_start();
    $_SESSION["errors"] = null;
    $_SESSION["success"] = null;

    if($_SESSION["auth"] === false){
        $_SESSION["success"] = "Bonjour, vous devez vous connecter pour publier";
    }
    if($_SESSION["auth"] !== true and $_SESSION["auth"] !== false){
        $_SESSION["errors"] = "Pour accéder à cette page, vous devez vous connecter !";
        $_SESSION["auth"] = false;
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

                <?php if($_SESSION["success"] !== null) : ?>
                    <p class="success">
                        <?= $_SESSION["success"] ?>
                    </p>
                <?php endif ?>

                <?php if($_SESSION["errors"] !== null) : ?>
                    <p class="errors">
                        <?= $_SESSION["errors"] ?>
                    </p>
                <?php endif ?>

                <form action="#" method="post">
                    <p>
                        <input id="user-name" type="text" placeholder="Name">
                    </p>
                    <p>
                        <input id="user-password" type="text" placeholder="password">
                    </p>
                    <p>
                        <button id="user-button" type="submit">Se connecter</button>
                    </p>
                </form>
            </div>
        </div>
        </div
