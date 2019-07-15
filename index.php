<?php

require "app/functions/functions.php";

    $page = get_page($_GET["page"]);

    route([
        "home",
        "professionnels",
        "particuliers",
        "mobiliers",
        "accessoires",
        "atelier",
        "contact"
    ],$page);


