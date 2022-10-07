<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataCat=$_POST['dataCat'];
        $msg="";
        $code=200;
        
        $deleteCategory=delete("category", "id_cat", $dataCat);
        
        if($deleteCategory){
           $category=getAllFromTable("category");
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