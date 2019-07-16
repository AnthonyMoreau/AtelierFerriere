<?php

session_start();
$_SESSION["auth"] = false;
$_SESSION["errors"] = null;

require "app/functions/functions.php";

    $page = get_page($_GET["page"], "home");

    route([
        "home",
        "professionnels",
        "particuliers",
        "mobiliers",
        "accessoires",
        "atelier",
        "contact"
    ],$page, "pages", "home");


