<?php 
/**
 * debug and die
 * @param: mixed
 * @return: string
 */
function dd($variable){
    ?> <pre> <?php
    var_dump($variable);
    ?> </pre> <?php
    die();
}
/**
 * verifie le get
 * @param: $_GET
 * @return: string
 */
function get_page($get_page){
    
    if(isset($get_page)){

        $page = $get_page;

    } else {

        $page = "home";
    }
    return $page;
}
/**
 * route le site
 * @param: array, string
 * @return: mixed
 */
function route($tabs, $page){
    $x = in_array($page, $tabs);
    if($x === true){
        foreach($tabs as $name){
            if($page === $name){
                if($name === "home"){
                    $title = "Actualités";
                } else {
                    $title = ucfirst($name);
                }
                require "pages/$name.php";
            }
        }
    } else {

        $title = "Actualités";
        $name = "home";
        require "pages/$name.php";
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