<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameMenu=$_POST['nameMenu'];
        $hrefMenu=$_POST['hrefMenu'];
        $showMenu=$_POST['showMenu'];
        $priorityMenu=$_POST['priorityMenu'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameMenu=="" || $hrefMenu=="" || $showMenu=="" || $priorityMenu==""){
            $valid=false;
        }

        if($valid){
            $insertMenu=insertMenu($nameMenu, $hrefMenu, $showMenu, $priorityMenu);
        }

        if($insertMenu){
           $msg="You have successfully inserted one row in table menu!";
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