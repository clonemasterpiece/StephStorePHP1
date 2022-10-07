<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataCategory=$_POST['dataCategory'];
        $nameCategory=$_POST['nameCategory'];

        $msg="";
        $code=200;
        
        $updateCategory=updateCategory($dataCategory, $nameCategory);
        if($updateCategory){
           $category=getAllFromTabel("category");
           $msg=$category;
           $code=200;
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