<?php

require "template-parts/header.php";
require "app/pdo/pdo.php";

$req = $pdo->prepare("SELECT * FROM posts WHERE categories= ?");
$req->execute(["professionnels"]);
$results = array_reverse($req->fetchAll());

$imagine = new Imagine\Gd\Imagine();
var_dump($imagine);
?>
<main class="main">

<div class="site-content">

    <div class="posts-professionnel">
    
    <?php foreach($results as $key => $post) : ?>

        <div class="title">
            <h2><?= $post->title ?></h2>
        </div>

        <?php if(!empty($post->date)) : ?>

        <div class="date">
            <p>
                <?= $post->date ?>
            </p>
        </div>

        <?php endif; ?>

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