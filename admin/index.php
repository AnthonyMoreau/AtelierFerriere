<?php

session_start();

require "../app/functions/functions.php";
require '../vendor/autoload.php';

$page = (isset($_GET["admin"])) ? $_GET["admin"] : "connection";

route([
    "connection",
    "create",
    "edit"
],$page, "../admin/pages", "connection");


