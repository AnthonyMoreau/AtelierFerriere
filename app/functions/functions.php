<?php 
/**
 * debug and die
 * @param: mixed
 * @return: string
 */
function verif_link(){
    $link = "ok";
    return $link;
}
function dd($variable){
    ?> <pre> <?php
    var_dump($variable);
    ?> </pre> <?php
    die();
}
/**
 * route le site
 * @param: array, string, string, string
 * @return: mixed
 */
function route($tabs, $page, $parent, $redirection){
    session_start();
    $x = in_array($page, $tabs);
    if($x){
        foreach($tabs as $name){
            if($page === $name){
                if($name === "home"){
                    $title = "Actualités";
                } else {
                    $title_admin = "connection";
                    $title = ucfirst($name);
                }
                require "$parent/$name.php";
            }
        }
    } else {
        //Redirection
        $_SESSION["auth"] = false;
        $title = "Actualités";
        $name = $redirection;
        require "$parent/$name.php";
    }
}
/**
 * renvoie les liens de pages
 * @param: string
 * @return: string
 */
function get_link($get){
    $link = "index.php?$get=";
    return $link;
}
/**
 * gere le "active" des pages
 * @param: string
 * @param: string
 * @return: string
 */
function active($page, $page_active){
    if($page === $page_active){
        return "active";
    }
}

function border_warning($section){
    $a = null;
    if(!empty($_POST)){
        if(empty($section)){
            $a =  "border: 2px solid rgb(193, 44, 50);";
        }
    }
    return $a;
}


function lengthFiles($files){
    $count = 0;
    foreach($files as $item => $value){
        if (!empty($files[$item]['tmp_name'])){
            $count++;
        }
    }
    return $count;
}