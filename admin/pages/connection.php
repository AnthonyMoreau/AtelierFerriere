<?php 
    if($_SERVER["REQUEST_URI"] !== "/admin/index.php?admin=connection" and $_SERVER["REQUEST_URI"] !== "/admin/"){
        header("location: ../../index.php");
    } else {
        $_SESSION["errors"] = null;
        $_SESSION["success"] = null;

        //Connection utilisateur -> décommenter pour vous connecter sans mot de passe.
        //$_SESSION["auth"] = true;
    
        if($_SESSION["auth"] === false){
            $_SESSION["success"] = "Bonjour, entrez votre nom et votre password pour vous connecter";
        }
        if($_SESSION["auth"] !== true and $_SESSION["auth"] !== false){
            $_SESSION["errors"] = "Pour accéder à cette page, vous devez vous connecter !";
            $_SESSION["auth"] = false;
        }


        if(!empty($_POST)){

            $name = $_POST["name"];
            $password = $_POST["password"];

            require_once "../app/pdo/pdo.php";
            
            $req = $pdo->prepare("SELECT * FROM users WHERE (name= ?) AND (pass= ?)");
            $req->execute([$name, $password]);
            $result = $req->fetchAll();

            if($result){

                $_SESSION["success"] = "Vous etes connectés";
                $_SESSION["auth"] = true;
                header("location: index.php?admin=create");

            } else {

                $_SESSION["errors"] = "nom ou mot de passe invalide";

            }
            
        }
    }
$_SESSION["verif_type"] = 0;
require "../app/app/html.php";
$html = new HTML();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $html->css("../../reset.css") ?>
    <?php $html->css("../../style.css") ?>
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
                <?php if($_SESSION["success"] !== null and $_SESSION["errors"] !== null){
                    $_SESSION["success"] = null;
                } ?>
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
                        <input id="user-name" type="text" name="name" placeholder="Name">
                    </p>
                    <p>
                        <input id="user-password" type="password" name="password" placeholder="password">
                    </p>
                    <p>
                        <button id="user-button" type="submit">Se connecter</button>
                    </p>
                </form>
            </div>
        </div>
        </div


<?php require "../template-parts/footer-admin.php" ?>