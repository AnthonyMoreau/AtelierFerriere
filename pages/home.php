<?php
require "template-parts/header_home.php";
require "app/pdo/pdo.php";

$self = isset($_GET["page"]) ? $_GET["page"] : "actualites";

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
            ?>
            <div class="item-article-<?= $post->type ?>">
            <?php
                $count = 0;
                foreach($photos as $key => $value){
                    $pos = strpos($value, $post->id);
                    if($pos !== false AND $pos !== 0){
                        $count++
                        ?>
                        <div class="image-<?= $count ?>">
                            <img src="<?= $way ?>/<?= $value ?>" alt="<?= $post->title ?>">
                        </div>
                        <?php
                    }
                }
            }
        ?>
        <!-- fin photo -->
        <?php if($post->date) : ?>
            <div class="date">
                <?= $post->date ?>
            </div>
        <?php  endif ?>
        <div class="content-title">
            <div class="title">
                <h2><?= $post->title ?></h2>
            </div>
            <div class="description">
                <pre><p><?= $post->description ?></p></pre>
            </div>
        </div>
            <?php if($post->link_title !== null AND $post->link !== null) :?>
            <div class="link">
                <a target="_blank" href="<?= $post->link ?>"><h5><?= $post->link_title ?></h5></a>
            </div>
            <?php endif ?>
        </div>
    <?php endforeach ?>
    </div>
</div>

</main>
<?php
require "template-parts/footer.php";