<?php

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
    <div class="container-admin-edit">
        <div class="edit-container">    
            <nav id="nav" role="nav">
                <div class="nav">
                    <a href="../../index.php">Retour sur le site</a>
                    <a href="<?= get_link("admin")?>create">Creation</a>
                </div>
            </nav>
                <?php if(empty($_POST)) : ?>
                <p><?php if(!empty($_SESSION["id"])) : {?>
                    <p><?= $_SESSION["id"] ?></p> à bien été supprimer <?php } ?></p>
                <?php endif ?>
                <p><?php if(!empty($_SESSION["id-modif"])) : {?>
                    <p><?= $_SESSION["id-modif"] ?></p> à bien été modifié <?php } ?></p>
                <?php endif ?>
                <?php 
                
                    $_SESSION["id"] = "";

                    $_SESSION["id-modif"] = "";
                ?>
                <div class="choice">
                    <p>
                        <select name="categories" id="categories"type>
                            <option value="tous">Tous les articles</option>
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
                                <div class="edit-info">
                                    <p>Modifier son article</p>
                                </div>
                                <form action="" method="post">
                                    <label for="date">Date</label>
                                    <p>
                                        <input type="text" name="date" value="<?= $post->date ?>">
                                    </p>
                                    <label for="title">Titre</label>
                                    <p>
                                        <input type="text" name="title" value="<?= $post->title ?>">
                                    </p>
                                    <label for="description">Description</label>
                                    <p>
                                        <textarea cols="30" rows="10" type="text" name="description"><?= $post->description ?></textarea>
                                    </p>
                                    <label for="link_title">Titre de lien</label>
                                    <p>
                                        <input type="text" name="link_title" value="<?= $post->link_title ?>">
                                    </p>
                                    <label for="link">Lien</label>
                                    <p>
                                        <input type="text" name="link" value="<?= $post->link ?>">
                                    </p>
                                    <input name="<?= $post->id ?>" type="submit" value="Envoyer la modification">
                                </form>
                                <?php

                            }
                            if($_POST[$post->id] === "modification"){
                                
                                $id = $post->id;
                                $date = $_POST["date"];
                                $_title = $_POST["title"];
                                $description = $_POST["description"];
                                $link_title = $_POST["link_title"];
                                $link = $_POST["link"];
                                $_SESSION["id-modif"] = $post->title;

                                $req = $pdo->prepare("UPDATE posts SET date= ?, title= ?, description= ?, link_title= ?, link= ? WHERE id=$id");
                                $req->execute([$date, $_title, $description, $link_title, $link]);
                                header("location: index.php?admin=edit");
                            }
                            if($_POST[$post->id] === "supprimer"){

                                ?>
                                    <div class="suppression">
                                        <div class="edit-info">
                                            <p>Supprimer son article</p>
                                        </div>
                                        <form action="" method="post">
                                            <span>etes vous sur de vouloir supprimer cet article</span>
                                            <p>
                                                <p><label for="title">Titre</label></p>
                                                <input type="text" name="title" value="<?= $post->title ?>">
                                            </p>
                                            <p>
                                                <p><label for="description">Description</label></p>
                                                <textarea type="text" name="description"><?= $post->description ?></textarea>
                                            </p>
                                            <p><input name="<?= $post->id ?>" type="submit" value="suppression"></p>
                                        </form>
                                    </div>
                                <?php

                            }

                            if($_POST[$post->id] === "suppression"){

                                $id = $post->id;
                                $category = $post->categories;

                                $photos = scandir("../photos/$category");

                                foreach($photos as $key => $value){
                                    $pos = strpos($value, $id);
                                    if($pos !== false AND $pos !== 0){
                                        unlink("../photos/$category/$value");
                                    }
                                }

                                $pdo->query("DELETE FROM posts WHERE id=$id");

                                $_SESSION["location"] = true;
                                $_SESSION["id"] = $post->title;

                                if($_SESSION["location"]){
                                    header("location: index.php?admin=edit");
                                }
                                
                            }
                        } else {

                            ?>
                            <div class="form-container">
                                <form name="<?= $post->categories ?>" action="" method="post">
                                    <label name="<?= $post->id ?>" for="title-edit" value="<?= $post->id ?>"><?= $post->id ?> : </label>
                                    <label name="<?= $post->title ?>" for="title-edit" value="<?= $post->title ?>"><?= $post->title ?> : </label>
                                    <label name="<?= $post->description ?>" for="title-edit" value="<?= $post->description ?>"><?= substr($post->description , 0 , 30) ?>... : </label>
                                    <?php if(!empty($post->link_title AND !empty($post->link))) : ?>
                                        <label name="<?= $post->link_title ?>" for="title-edit" value="<?= $post->link_title ?>"><?= $post->link_title ?> : </label>
                                        <label name="<?= $post->link ?>" for="title-edit" value="<?= $post->link ?>"><?= $post->link ?> : </label>
                                    <?php endif ?>
                                    <label style="display: none" name="<?= $post->categories ?>" for="title-edit" value="<?= $post->categories ?>"><?= $post->categories ?> : </label>
                    
                                    <input name="<?= $post->id ?>" type="submit" value="modifier">
                                    <input name="<?= $post->id ?>" type="submit" value="supprimer">
                                </form>
                            </div>
                            <?php
                        }
                    ?>
                    
                    <?php endforeach ?>
                    <script src="../assets/js/edit.js"></script>
                </div>
        </div>

<?php require "../template-parts/footer-admin.php" ?>