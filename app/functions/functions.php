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
 * route le site
 * @param: array, string, string, string
 * @return: mixed
 */
function route($tabs, $page, $parent, $redirection){
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

/**
 * champs oubliés
 * @param: string;
 * @return: string;
 */
function border_warning($section){
    $a = null;
    if(!empty($_POST)){
        if(empty($section)){
            $a =  "border: 2px solid rgb(193, 44, 50);";
        }
    }
    return $a;
}

/**
 * retourne le nombres de photos posté lors de l'envoie
 * @param: tableaux $_FILES
 * @return: int 
 */
function lengthFiles($files){
    $count = 0;
    foreach($files as $item => $value){
        if (!empty($files[$item]['name'])){
            $count++;
        }
    }
    return $count;
}

function verif_link(){
    $link = "ok";
    return $link;
}

function get_element($tab, $category){
    $x = [$category];
    foreach($tab as $key){
        if($key !== $category){
            $x []= $key;
        }
    }
    return $x;
}
function set_element($tab){
    foreach($tab as $key){?>
        <option value="<?= $key ?>"><?= $key ?></option>
        <?php
    }
}