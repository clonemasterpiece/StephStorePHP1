<?php
     include "functions.php";

     header('Content-Type: application/json');
     if(isset($_GET['button'])){
        $msg="";
        $code=200;
        
        $products=getAllFromTable("products");
        if($products){
           $msg=$products;
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