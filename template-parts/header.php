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
                <a href="<?= get_link("page")?>professionnels">Professionnel</a>
                <a href="<?= get_link("page")?>particuliers">Particuliers</a>
                <a href="<?= get_link("page")?>mobiliers">mobiliers</a>
                <a href="<?= get_link("page")?>accessoires">Accéssoires</a>
                <a href="<?= get_link("page")?>atelier">L'Atelier</a>
                <a href="<?= get_link("page")?>contact">Contact</a>
            </div>
        </nav>