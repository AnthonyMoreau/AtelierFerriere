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
    $imagine = $imagine = new Imagine\Gd\Imagine();
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
                    <a href="../../index.php">Retour sur le site (déconnexion)</a>
                    <a href="<?= get_link("admin")?>create">Creation</a>
                </div>
            </nav>
                <?php if(empty($_POST)) : ?>
                <div class="user-info">
                    <?php if(!empty($_SESSION["id"])) : {?>
                        <p class ="title"><?= $_SESSION["id"] ?></p><p> à bien été supprimer <?php } ?></p>
                    <?php endif ?>
                    <?php if(!empty($_SESSION["id-modif"])) : {?>
                        <p class ="title"><?= $_SESSION["id-modif"] ?></p><p> à bien été modifié <?php } ?></p>
                    <?php endif ?>
                </div>
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

                            $post_entry = (isset($_POST[$post->id])) ? $_POST[$post->id] : null;

                            if($post_entry === "modifier"){ 
                                $photos = scandir("../photos/$post->categories");
                                ?> 
                                <form  action="" method="POST">
                                    <?php
                                    $count = 0;
                                        foreach($photos as $key => $value){
                                            $pos = strpos($value, $post->id);
                                            $values = "../photos/$post->categories/$value";
                                            if($pos !== false AND $pos !== 0){
                                                $count++;
                                                ?><input style="display: none;" value="<?= $values  ?>" type="text" name="photo<?= $count ?>" id="photo<?= $count ?>" ><?php
                                            }
                                        }
                                    ?> 
                               
                                <?php

                                ?>
                                <div class="edit-info">
                                    <p>Modifier son article</p>
                                </div>
                                
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
                                    <?php
                                        $type = ["type-1", "type-2", "type-3"];
                                        $categories = [
                                            "actualites", 
                                            "professionnels", 
                                            "particuliers",
                                            "mobiliers",
                                            "accessoires"
                                        ];
                                        $types = get_element($type, $post->type);
                                        $category = get_element($categories, $post->categories);

                                    ?>
                                    <span>Changer les photos</span>
                                    <p>
                                        <input type="radio" name="photo_change" id="photo-oui" value="oui">oui
                                        <input type="radio" name="photo_change" id="photo-non" value="non" checked>non
                                    </p>
                                    <p>
                                        <select name="type" id="type">
                                            <?= set_element($types) ?>
                                        </select>
                                    </p>
                                    <p>
                                        <select name="categories" id="categories"type>
                                            <?= set_element($category) ?>
                                        </select>
                                    </p>
                                    <input name="<?= $post->id ?>" type="submit" value="Envoyer la modification">
                                </form>
                                <?php

                            }
                            if($post_entry === "Envoyer la modification"){

                                $count = 0;
                                $tab_photos = [];
                                foreach($_POST as $key => $value){
                                    $count++;
                                    if($key === "photo{$count}"){
                                        $tab_photos []= $value;
                                    }
                                }
                                $id = $post->id;
                                $date = $_POST["date"];
                                $_title = $_POST["title"];
                                $description = $_POST["description"];
                                $link_title = $_POST["link_title"];
                                $link = $_POST["link"];
                                $type = $_POST["type"];
                                $category = $_POST["categories"];
                                $photo_change = $_POST["photo_change"];
                                $_SESSION["id-modif"] = $post->title;
                                $title_photo;

                                foreach($tab_photos as $value){

                                    $title_photo = explode("/" , $value);
                                    if($title_photo[2] !== $category){
                                        $photo = $imagine->open($value)->save("../photos/$category/$title_photo[3]");
                                        unlink($value);
                                    }
                                }
                                $req = $pdo->prepare("UPDATE posts SET date= ?, title= ?, description= ?, link_title= ?, link= ?, categories= ?, type= ? WHERE id=$id");
                                $req->execute([$date, $_title, $description, $link_title, $link, $category, $type]);
                                if($photo_change === "non"){

                                    header("location: index.php?admin=edit");

                                } else {
                                    $count = 0;
                                    $count_photos = 0;
                                    ?> 
                                        <p class="red">Attention il faut au moins une photo avant d'enregister</p>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <?php foreach($_POST as $key => $value) : ?>
                                                <?php $count ++ ?>
                                                <?php $title_photo = explode("/" , $value); ?>
                                                <?php if($key === "photo{$count}") : ?>
                                                <input type="checkbox" name="supprime-photo<?= $count_photos + 1 ?>" id="supprime-photo">Supprimer la photo
                                                <?php $count_photos++; ?>
                                                <?php $link_photo =  "../photos/$category/$title_photo[3]" ?>
                                                    <img style="max-width: 20%" src="<?= $link_photo ?>" alt=""> 
                                                    <p>
                                                        <input type="hidden" name="photo<?= $count_photos ?>" value="<?= $link_photo ?>">
                                                        <input value="<?= $link_photo ?>" type="file" name="photo<?= $count_photos ?>"  id="photo<?= $count ?>" multiple>
                                                    </p>

                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <?php if($count_photos < 4) : ?>
                                                <?php 
                                                    $x = $count_photos;
                                                    for ($i=$x + 1; $i < 5; $i++) { 
                                                        ?>
                                                        <p>
                                                            <input type="file" name="photo<?= $i ?>"  id="photo<?= $i ?>" multiple>
                                                        </p>
                                                        <?php
                                                    } 

                                                ?>
                                            <?php endif ?>
                                        <input name="<?= $post->id ?>" type="submit" value="Envoyer les nouvelles photos">
                                        </form>
                                        <?php
                                }
                                
                            }
                            if($post_entry === "Envoyer les nouvelles photos"){

                                if($_FILES){
                                    $count = 0;
                                    $category = explode("/", $_POST["photo1"]);
                                    $title = explode("_", $category[3]);
                                    $size  = new Imagine\Image\Box(400, 400);
                                    
                                    foreach($_FILES as $item => $value){

                                        $count++;

                                        //replace
                                        if (!empty($_FILES[$item]["tmp_name"])){

                                            $link = isset($_POST["photo{$count}"]) ? $_POST["photo{$count}"] : false ;

                                            $photo = $_FILES[$item]["tmp_name"];

                                            if($link) {
                                                
                                                $imagine->open($photo)->thumbnail($size, 'inset')->save($link);

                                            } else {
                                                // rec
                                                $test_photo = '../photos/'. $category[2] .'/' . $count . '_' . $title[1].'_'.$title[2];
                                                
                                                
                                                $test_image = (file_exists($test_photo)) ? true : false;

                                                if($test_image){
                                                    
                                                    $photos = scandir("../photos/$category[2]");
                                                    $count_photo = 0;
                                                    
                                                    foreach($photos as $key => $value){
                                                        
                                                        if($value !== "." AND $value !== ".."){
                                                            
                                                            $pos = (strpos($value, $title[1], 2)) ? true : false;

                                                            
                                                            if($pos){
                                                                
                                                                $count_photo++;
                                                                
                                                                $link_value = "../photos/$category[2]/$value";

                                                                $rec = $imagine->open($link_value)->save('../photos/'. $category[2] .'/' . $count_photo . '_' . $title[1].'_'.$title[2]);
                                                            }
                                                        }
                                                    }
                                                    //rec new
                                                    $rec = $imagine->open($photo)->thumbnail($size, 'inset')->save('../photos/'. $category[2] .'/' . ($count_photo + 1) . '_' . $title[1].'_'.$title[2]);
                                                
                                                } else {
                                                    // normal rec
                                                    $imagine->open($photo)->thumbnail($size, 'inset')->save('../photos/'. $category[2] .'/' . $count . '_' . $title[1].'_'.$title[2]);
                                                }
                                            }
                                        }
                                    }
                                    if(empty($_POST)){

                                        $_SESSION["id-modif"] = $post->title;
                                        header("location: index.php?admin=edit");

                                    }
                                    
                                } 
                                if($_POST){
                                    //supr
                                    for($i = 1; $i < 5; $i++){
                                        if(isset($_POST["supprime-photo{$i}"])){
                                            unlink($_POST["photo{$i}"]);
                                        }
                                    }
                                    $_SESSION["id-modif"] = $post->title;
                                    header("location: index.php?admin=edit");
                                }
                            }
                            if($post_entry === "supprimer"){
                                ?>
                                    <div class="suppression">
                                        <div class="edit-info">
                                            <p>Supprimer son article</p>
                                        </div>
                                        <form action="" method="post">
                                            <span>etes vous sur de vouloir supprimer cet article</span>
                                            <p>
                                                ID : <?php echo "<span class=".id.">$post->id</span>"  ?> 
                                            </p>
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
                            if($post_entry === "suppression"){

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
                                    <label class="id" name="<?= $post->id ?>" for="title-edit" value="<?= $post->id ?>"><?= $post->id ?> : </label>
                                    <label name="<?= $post->title ?>" for="title-edit" value="<?= $post->title ?>"><?= $post->title ?> : </label>
                                    <label name="<?= htmlentities($post->description) ?>" for="title-edit" value="<?= htmlentities($post->description) ?>"><?= htmlentities(substr($post->description , 0 , 30)) ?>... : </label>
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