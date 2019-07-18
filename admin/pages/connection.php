<?php 
    session_start();

    if($_SERVER["REQUEST_URI"] !== "/admin/index.php?admin=connection" and $_SERVER["REQUEST_URI"] !== "/admin/"){
        header("location: ../../index.php");
    } else {
        $_SESSION["errors"] = null;
        $_SESSION["success"] = null;

        //Connection utilisateur -> retirer la ligne pour que l'utilisateur ne soit pas connecté | ajouter pour le contraire.
        // $_SESSION["auth"] = true;
    
        if($_SESSION["auth"] === false){
            $_SESSION["success"] = "Bonjour, entrez votre nom et votre password pour vous connecter";
        }
        if($_SESSION["auth"] !== true and $_SESSION["auth"] !== false){
            $_SESSION["errors"] = "Pour accéder à cette page, vous devez vous connecter !";
            $_SESSION["auth"] = false;
        }
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
    <div class="container-admin-connection">
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
                </form>
                    <p>
                        <button id="user-button" type="submit">Se connecter</button>
                    </p>
            </div>
        </div>
        </div
