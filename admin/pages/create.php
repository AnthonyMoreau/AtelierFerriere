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
    
    if(!empty($_POST)){


        $_title = $_POST["title"];
        $description = $_POST["description"];
        $link_title = $_POST["link_title"];
        $link = $_POST["link"];
        $type = $_POST["type"];
        $categories = $_POST["categories"];
        

        if(!empty($_title) AND
           !empty($description)){

               if($_SESSION["verif_type"] === 0 AND ($type === "type1" || $categories === "actualites")){

                    $_SESSION["verif_type"]++;
                    ?> 
                        <script type="text/javascript">
                            alert("êtes vous sur pour Type1 ou Actualités");
                        </script>
                    <?php

                } else {

                    $pattern = "/[a-zA-Zéèàçêâîôëäïö0-9 ]+/";
                    preg_match($pattern, $_title, $matchs);
    
                    if($matchs[0] === $_title){
    
                        require "../app/pdo/pdo.php";
                
                        $req = $pdo->prepare("INSERT INTO posts SET 
    
                            title= ? ,
                            description = ? ,
                            link_title = ? ,
                            link = ? ,
                            type = ? ,
                            categories = ?
    
                        ");
                        $req->execute([
    
                            $_title, 
                            $description, 
                            $link_title, 
                            $link, 
                            $type, 
                            $categories
    
                        ]);
                        ?>
                            <script type="text/javascript">
                                alert("Votre article à bien été posté");
                            </script>
                        <?php
                        $_SESSION["verif_type"] = 0;

                        $_title = "nouvel article" ;
                        $description = "Nouvelle description" ;
                        $link_title = "";
                        $link = "";
                    }
                }
        } else {
            ?> 
                <script type="text/javascript">
                    alert("Vous n'avez pas rempli tous les champs !");
                </script>
            <?php
        }

    }
require "../app/app/html.php";
$html = new HTML();
if(!empty($_FILES) AND isset($req)){require "photos.php";}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../assets/js/create.js"></script>
    <?php $html->css("../../reset.css") ?>
    <?php $html->css("../../style.css") ?>
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
            <p class="success-create">
                <?= $_SESSION["success"] ?>
            </p>
            <div class="create">
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="create-left">
                    <p>
                        <input type="text" name="title" id="title" style="<?php if(isset($_title)){echo border_warning($_title);} ?>" placeholder="Titre" value="<?php if(!empty($_title)){echo $_title;} ?>">
                    </p>
                    <p>
                        <textarea name="description" id="description" style="<?php if(isset($description)){echo border_warning($description);} ?>" cols="30" rows="10" placeholder="Description"><?php if(!empty($description)){echo $description;} ?></textarea>
                    </p>
                    <p>
                        <input type="text" name="link_title" id="link_title" placeholder="Titre du lien" value="<?php if(!empty($link_title)){echo $link_title;} ?>">
                    </p>
                    <p>
                        <input class="link-create" type="text" name="link" id="link" placeholder="ex : http://commerce.com" value="<?php if(!empty($link)){echo $link;} ?>">
                    </p>
                </div>
                <div class="create-right">
                    <span>articles : choisissez un type et une catégorie</span>
                    <p>
                        <select name="type" id="type">
                            <option value="type1">type 1</option>
                            <option value="type2">type 2</option>
                            <option value="type3">type 3</option>
                            <option value="type4">type 4</option>
                        </select>
                    </p>
                    <p>
                        <select name="categories" id="categories"type>
                            <option value="actualites">Actualités</option>
                            <option value="professionnels">Professionnels</option>
                            <option value="particuliers">Particuliers</option>
                            <option value="mobilier">Mobilier</option>
                            <option value="accessoires">Accessoires</option>
                        </select>
                    </p>
                    <span>Choisissez des photos (de 1 à 4)</span>
                    <p>
                        <input type="file" name="photo1" id="photo1" multiple>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    </p>
                    <p>
                        <input type="file" name="photo2" id="photo2" multiple>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    </p>
                    <p>
                        <input type="file" name="photo3" id="photo3" multiple>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    </p>
                    <p>
                        <input type="file" name="photo4" id="photo4" multiple>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    </p>
                </div>
                    <p>
                        <button type="submit">Envoyer</button>
                    </p>
                </form>
            </div>
        </div>


<?php require "../template-parts/footer-admin.php" ?>