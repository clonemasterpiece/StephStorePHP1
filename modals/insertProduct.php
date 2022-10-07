<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameProduct=$_POST['nameProduct'];
        $cenaProduct=$_POST['cenaProduct'];
        $catValue=$_POST['catValue'];
        $filePicture=$_FILES['filePicture'];
        $tmpName=$filePicture['tmp_name'];
        $type=$filePicture['type'];
        $name=$filePicture['name'];
        $src="../img/".$name;
        $typeNew=explode("/", $type);
        $msg="";
        $code=200;
        $valid=true;

        if($typeNew[1]!="png" && $typeNew[1]!="jpg" && $typeNew[1]!="jpeg"){
            $valid=false;
        }

        if($nameProduct=="" || $catValue=="0"){
            $valid=false;     
        }

        if($valid){
            $insertProduct=insertProduct($nameProduct, $cenaProduct, $catValue, $name);
        }

        if($insertProduct){
            $result=move_uploaded_file($tmpName, $src.$name);
            if($result){
                $msg="You have successfully inserted one row in table products!";
                $code=201;
            }
        }
        else{
            $msg="Server error.";
            $code=500;
        }

    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("location: 404Page.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>