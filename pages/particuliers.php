<?php

require "template-parts/header.php";
require "app/pdo/pdo.php";

$self = isset($_GET["page"]) ? $_GET["page"] : null;

if($self){

    $req = $pdo->prepare("SELECT * FROM posts WHERE categories= ?");
    $req->execute([$self]);
    $results = array_reverse($req->fetchAll());
    $way = ($self) ? "photos/$self" : null;
}

?>
<main class="main">

<div class="site-content">

    <div class="posts-<?= $self ?>">

    <?php $photos = ($way) ? scandir($way) : null ?>

    <?php foreach($results as $key => $post) : ?>
    
        <?php 
            if($photos){
                foreach($photos as $key => $value){
                    $pos = strpos($value, $post->id);
                    if($pos !== false AND $pos !== 0){
                        ?>

                            <img src="<?= $way ?>/<?= $value ?>" alt="<?= $post->title ?>">

                        <?php
                    }
                }
            }
        ?>
        <!-- fin photo -->
        <div class="title">
            <h2><?= $post->title ?></h2>
        </div>
        <div class="description">
            <p><?= $post->description ?></p>
        </div>
            <?php if($post->link_title !== null AND $post->link !== null) :?>

                <a target="_blank" href="<?= $post->link ?>"><h5><?= $post->link_title ?></h5></a>

            <?php endif ?>

    <?php endforeach ?>

    </div>

</div>

</main>
<?php
require "template-parts/footer.php";