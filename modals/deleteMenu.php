<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataMenu=$_POST['dataMenu'];
        $msg="";
        $code=200;
        
        $deleteMenu=deleteMenu($dataMenu);
        
        if($deleteMenu){
           $menu=getAllFromTable("menu");
           $msg=$menu;
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