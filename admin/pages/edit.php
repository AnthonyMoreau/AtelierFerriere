<?php
    session_start();


    if($_SERVER["REQUEST_URI"] !== "/admin/index.php?admin=edit"){

        header("location: ../../index.php");

    } else {

        if ($_SESSION["auth"] !== true ){

            $_SESSION["auth"] = "noPermission";
            header("location: index.php?admin=connection");
        }
    }

    require "../app/pdo/pdo.php";

    $req = $pdo->query("SELECT * FROM posts");
    $results = array_reverse($req->fetchAll());
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
                <a href="<?= get_link("admin")?>create">Creation</a>
            </div>
        </nav>
            <?php if(empty($_POST)) : ?>
            <div class="choice">
                <p>
                    <select name="categories" id="categories"type>
                        <option value="tous">Tous</option>
                        <option value="actualites">Actualités</option>
                        <option value="professionnels">Professionnels</option>
                        <option value="particuliers">Particuliers</option>
                        <option value="mobilier">Mobilier</option>
                        <option value="accessoires">Accessoires</option>
                    </select>
                </p>
            </div>
            <?php endif ?>
        <div class="edit-posts">

            <?php foreach($results as $key => $post) : ?>

            

            <?php 

                if($_POST){

                    if($_POST[$post->id] === "modifier"){
                        ?>
                        <form action="" method="post">
                            <input type="text" name="title" value="<?= $post->title ?>">
                            <textarea type="text" name="description"><?= $post->description ?></textarea>
                            <input type="text" name="link_title" value="<?= $post->link_title ?>">
                            <input type="text" name="link" value="<?= $post->link ?>">

                            <input name="<?= $post->id ?>" type="submit" value="modification">
                        </form>
                        <?php

                    }
                    if($_POST[$post->id] === "modification"){
                        
                        $id = $post->id;
                        $_title = $_POST["title"];
                        $description = $_POST["description"];
                        $link_title = $_POST["link_title"];
                        $link = $_POST["link"];

                        $req = $pdo->prepare("UPDATE posts SET title= ?, description= ?, link_title= ?, link= ? WHERE id=$id");
                        $req->execute([$_title, $description, $link_title, $link]);
                        header("location: index.php?admin=edit");
                    }
                    if($_POST[$post->id] === "supprimer"){
                        ?>
                        <form action="" method="post">

                            <p>etes vous sur de vouloir supprimer cet article</p>
                            <input type="text" name="title" value="<?= $post->title ?>">
                            <textarea type="text" name="description"><?= $post->description ?></textarea>
                            <input name="<?= $post->id ?>" type="submit" value="suppression">
                        </form>
                        <?php

                    }
                    if($_POST[$post->id] === "suppression"){

                        $id = $post->id;

                        $req = $pdo->query("DELETE FROM posts WHERE id=$id");

                        ?>
                            <script type="text/javascript">
                                alert("Votre article à bien été supprimer");
                            </script>
                        <?php
                        $_SESSION["location"] = true;
                        if($_SESSION["location"]){
                            header("location: index.php?admin=edit");
                        }
                        
                    }
                } else {

                    ?>
                <form name="<?= $post->categories ?>" action="" method="post">
                    <label name="<?= $post->id ?>" for="title-edit" value="<?= $post->id ?>"><?= $post->id ?> : </label>
                    <label name="<?= $post->title ?>" for="title-edit" value="<?= $post->title ?>"><?= $post->title ?> : </label>
                    <label name="<?= $post->description ?>" for="title-edit" value="<?= $post->description ?>"><?= substr($post->description , 0 , 30) ?>... : </label>
                    <label name="<?= $post->link_title ?>" for="title-edit" value="<?= $post->link_title ?>"><?= $post->link_title ?> : </label>
                    <label name="<?= $post->link_title ?>" for="title-edit" value="<?= $post->link ?>"><?= $post->link ?> : </label>
                    <label style="display: none" name="<?= $post->categories ?>" for="title-edit" value="<?= $post->categories ?>"><?= $post->categories ?> : </label>
    
                    <input name="<?= $post->id ?>" type="submit" value="modifier">
                    <input name="<?= $post->id ?>" type="submit" value="supprimer">
                </form>
                     <?php
                }
            ?>
            
            <?php endforeach ?>
            <script src="../assets/js/edit.js"></script>
        </div>

<?php require "../template-parts/footer-admin.php" ?>