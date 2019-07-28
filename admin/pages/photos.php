<?php

    // recuperation du dernier ID
    if(isset($req)){

        $id = $pdo->query('SELECT LAST_INSERT_ID()');
        
        $lastId = $id->fetchColumn();
        
        function title($title) {
            $title = implode('-', explode(" ", strtolower($title)));
            return $title;
        }
    }
    
    if(!empty($_FILES)) {

        $length = lengthFiles($_FILES);
    
        if($length > 0){

            $category = $_POST['categories'];
    
            $__title = $lastId.'_'.title($_POST['title']). '.jpg';
            $imagine = new Imagine\Gd\Imagine();
            $size  = new Imagine\Image\Box(400, 400);
            $count = 1;

            foreach($_FILES as $item => $value){
                if (!empty($value["tmp_name"])){
                    $photo = $value["tmp_name"];
                    $imagine->open($photo)->thumbnail($size, 'inset')->save('../photos'.'/'. $category .'/' . $count . '_' . $__title);
                    $count++;
                }
            }
        }
    }
?>
