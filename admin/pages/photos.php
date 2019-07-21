<?php

    // recuperation du dernier ID
    $id = $pdo->query('SELECT LAST_INSERT_ID()');
    
    $lastId = $id->fetchColumn();
    
    function title($title) {
        $title = implode('-', explode(" ", strtolower($title)));
        return $title;
    }
    
    if(isset($_FILES)) {
    
        $id = $_POST['categories'];

        $__title = $lastId.'_'.title($_POST['title']). '.jpg';
        $imagine = new Imagine\Gd\Imagine();
        $size  = new Imagine\Image\Box(500, 500);
        $count = 1;

        foreach($_FILES as $item => $value){
            if (!empty($_FILES[$item]['tmp_name'])){
                $photo = $_FILES[$item]['tmp_name'];
                $imagine->open($photo)->thumbnail($size, 'inset')->save('../photos'.'/'. $id .'/' . $count . '_' . $__title);
                $count++;
            }
        }
    }
?>
