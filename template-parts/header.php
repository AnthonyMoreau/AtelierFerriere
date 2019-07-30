<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="swup.css">
    <title><?= $title ?></title>
</head>
<body>
    <div class="container">
        <nav id="nav" role="nav">
            <div class="nav">
                <a href="index.php">Actualités</a>
                <a href="<?= get_link("page")?>professionnels" class="<?= active($page, "professionnels") ?>">Professionnels</a>
                <a href="<?= get_link("page")?>particuliers" class="<?= active($page, "particuliers") ?>">Particuliers</a>
                <a href="<?= get_link("page")?>mobiliers" class="<?= active($page, "mobiliers") ?>">Mobiliers</a>
                <a href="<?= get_link("page")?>accessoires" class="<?= active($page, "accessoires") ?>">Accessoires</a>
                <a href="<?= get_link("page")?>atelier" class="<?= active($page, "atelier") ?>">L'Atelier</a>
                <a href="<?= get_link("page")?>contact" class="<?= active($page, "contact") ?>">Contact</a>
                <div class="network">
                    <a href="https://fr-fr.facebook.com/AtelierFerriere/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="https://www.instagram.com/atelier_fd/" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="modal">
                <button onclick="document.getElementById('modal').style.display='block'" class="my-button"><?= $page ?><span><i class="fas fa-sort-down"></i></span></button>
                <div id="modal" class="my-modal">
                    <div class="my-modal-content">
                        <div class="my-container">
                            <span style="color: white;" onclick="document.getElementById('modal').style.display='none'" class="my-button"><span style="cursor: pointer">close</span></span>
                                <a href="index.php">Actualités</a>
                                <a href="<?= get_link("page")?>professionnels" class="<?= active($page, "professionnels") ?>">Professionnels</a>
                                <a href="<?= get_link("page")?>particuliers" class="<?= active($page, "particuliers") ?>">Particuliers</a>
                                <a href="<?= get_link("page")?>mobiliers" class="<?= active($page, "mobiliers") ?>">Mobiliers</a>
                                <a href="<?= get_link("page")?>accessoires" class="<?= active($page, "accessoires") ?>">Accessoires</a>
                                <a href="<?= get_link("page")?>atelier" class="<?= active($page, "atelier") ?>">L'Atelier</a>
                                <a href="<?= get_link("page")?>contact" class="<?= active($page, "contact") ?>">Contact</a>
                                <div class="network-small-screen">
                                    <a href="https://fr-fr.facebook.com/AtelierFerriere/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                                    <a href="https://www.instagram.com/atelier_fd/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <script type="text/javascript">

            let size = window.innerWidth;

            if(size < 768) {
                document.addEventListener("DOMContentLoaded", function(){ 
                    
                    
                    document.addEventListener("scroll", function(e) {
                        let nav = document.querySelector("#nav")
                        nav.style.opacity = 0;
                        nav.style.transition = "opacity .3s linear";
                        setTimeout(function(){
                            nav.style.opacity = 1;
                            nav.style.transition = "opacity 1s linear";}, 800)
                    })
                })
            } else {
                // on ne fait rien
            }

        </script>