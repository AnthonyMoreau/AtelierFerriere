<?php

$count = 0;
?> 
    <form action="" method="POST" enctype="multipart/form-data">
        <?php foreach($_POST as $key => $value) : ?>
            <?php $count ++ ?>
            <?php $title_photo = explode("/" , $value); ?>
            <?php if($key === "photo{$count}") : ?>
            <?php $link_photo =  "../photos/$category/$title_photo[3]" ?>
                <img style="max-width: 20%" src="<?= $link_photo ?>" alt=""> 
                <p>
                    <input value="<?= $link_photo ?>" type="file" name="photo<?= $count ?>"  id="photo<?= $count ?>" multiple>
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                </p>
            <?php endif ?>
        <?php endforeach ?>
    <input name="button" type="submit" value="Envoyer">
    </form>

<?php

