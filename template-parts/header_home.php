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
<header class="header-home">
    <nav id="nav-home" role="nav">
            <span class="beforeTitle">Atelier</span>
            <div class="reveal">
                <h1>Ferriere-Deberry</h1>
            </div>
            <div class="sub">
                <h2 class="headerSlogan"> <span>Ebeniste</span> <span>Design</span> <span>Un autre truc</span></h2>
            </div>
        <div class="toContent">
            <a href="<?= get_link("page")?>professionnels"><i class="fas fa-angle-right"></i></a>
        </div>
        <div class="continu">Continuer vers le site</div>
    </nav>
</header>