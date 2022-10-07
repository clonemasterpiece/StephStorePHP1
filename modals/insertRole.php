<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameRole=$_POST['nameRole'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameRole==""){
            $valid=false;
        }

        if($valid){
            $insertRole=insertRole($nameRole);
        }

        if($insertRole){
           $msg="You have successfully inserted one row in table roles!";
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