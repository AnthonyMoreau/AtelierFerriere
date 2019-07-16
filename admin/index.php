<?php

require "../app/functions/functions.php";

$page = get_page($_GET["admin"], "connection");


route([
    "connection",
    "creation",
    "edit"
],$page, "../admin/pages", "connection");


