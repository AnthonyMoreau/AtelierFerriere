<?php

session_start();
$_SESSION["auth"] = false;
$_SESSION["errors"] = "";

require "app/functions/functions.php";

if(isset($_GET["page"])){

    $page = $_GET["page"];

} else {

    $page = "home";
}

route([
    "home",
    "professionnels",
    "particuliers",
    "mobiliers",
    "accessoires",
    "atelier",
    "contact"
],$page, "pages", "home");


