<?php
    $iterator = scandir('photos/particuliers');
    foreach($iterator as $files){
        $file = explode("_", $files);
        if(isset($file[1])){
            print_r($file[1]);
        }
    }
    die();
?>