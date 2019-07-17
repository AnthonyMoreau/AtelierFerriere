<?php

    session_start();

    if($_SERVER["REQUEST_URI"] !== "/admin/index.php?admin=create"){

        header("location: ../../index.php");

    } else {

        if ($_SESSION["auth"] !== true ){

            $_SESSION["auth"] = "noPermission";
            header("location: index.php?admin=connection");
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
    <div class="container-admin-create">
        <div class="admin-content-create">
            <nav id="nav" role="nav">
                <div class="nav">
                    <a href="../../index.php">Retour sur le site</a>
                    <a href="<?= get_link("admin")?>edit">Edit</a>
                </div>
            </nav>
            <h3>Création</h3>
            <div class="create">
                <form action="#" method="post">
                <div class="create-left">
                    <p>
                        <input type="text" name="title" id="title" placeholder="Titre">
                    </p>
                    <p>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
                    </p>
                    <p>
                        <input type="text" name="link_title" id="link_title" placeholder="Titre du lien">
                    </p>
                    <p>
                        <input class="link-create" type="text" name="link" id="link" placeholder="ex : http://commerce.com">
                    </p>
                </div>
                <div class="create-right">
                    <span>articles : choisissez un type et une catégorie</span>
                    <p>
                        <select name="type" id="type" placeholder="type">
                            <option value="a">type 1</option>
                            <option value="b">type 2</option>
                            <option value="c">type 3</option>
                            <option value="d">type 4</option>
                        </select>
                    </p>
                    <p>
                        <select name="type" id="categories" placeholder="type">
                            <option value="1">Actualités</option>
                            <option value="2">professionnels</option>
                            <option value="3">Particuliers</option>
                            <option value="4">Mobilier</option>
                            <option value="5">Accessoires</option>
                        </select>
                    </p>
                    <span>Choisissez des photos (jusqu'a 4)</span>
                    <p>
                        <input type="file" name="photo1" id="photo1">
                    </p>
                    <p>
                        <input type="file" name="photo2" id="photo2">
                    </p>
                    <p>
                        <input type="file" name="photo3" id="photo3">
                    </p>
                    <p>
                        <input type="file" name="photo4" id="photo4">
                    </p>
                </div>
                    <p>
                        <button type="submit">Envoyer</button>
                    </p>
                </form>
            </div>
        </div>