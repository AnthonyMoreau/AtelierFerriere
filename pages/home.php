<?php
require "template-parts/header_home.php";
require "app/pdo/pdo.php";

$req = $pdo->prepare("SELECT * FROM posts WHERE categories= ?");
$req->execute(["actualites"]);
$results = array_reverse($req->fetchAll());

var_dump($results);

?>
<main class="main">

<div class="site-content">

    <div class="posts-actualites">
    
    <?php foreach($results as $key => $post) : ?>

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