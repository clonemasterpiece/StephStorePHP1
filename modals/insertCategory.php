<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameCategory=$_POST['nameCategory'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameCategory==""){
            $valid=false;
        }

        if($valid){
            $insertCategory=insertCategory($nameCategory);
        }

        if($insertCategory){
           $msg="You have successfully inserted one row in table category!";
           $code=201;
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