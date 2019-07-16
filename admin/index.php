<?php

require "../app/functions/functions.php";


if(isset($_GET["admin"])){

    $page = $_GET["admin"];

} else {

    $page = "connection";
}


route([
    "connection",
    "creation",
    "edit"
],$page, "../admin/pages", "connection");


