<?php

session_start();

$_SESSION["auth"] = false;
$_SESSION["errors"] = "";

require "app/functions/functions.php";
require 'vendor/autoload.php';

$page = (isset($_GET["page"])) ? $_GET["page"] : "home";

route([
    "home",
    "professionnels",
    "particuliers",
    "mobiliers",
    "accessoires",
    "atelier",
    "contact"
],$page, "pages", "home");


