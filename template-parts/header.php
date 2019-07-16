<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
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
                <a href="<?= get_link("page")?>accessoires" class="<?= active($page, "accessoires") ?>">Accéssoires</a>
                <a href="<?= get_link("page")?>atelier" class="<?= active($page, "atelier") ?>">L'Atelier</a>
                <a href="<?= get_link("page")?>contact" class="<?= active($page, "contact") ?>">Contact</a>
            </div>
        </nav>