<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataMenu=$_POST['dataMenu'];
        $nameMenu=$_POST['nameMenu'];
        $hrefMenu=$_POST['hrefMenu'];
        $showMenu=$_POST['showMenu'];
        $priorityMenu=$_POST['priorityMenu'];

        $msg="";
        $code=200;
        
        $updateMenu=updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu, $priorityMenu);
        
        if($updateMenu){
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