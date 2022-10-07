<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataUser=$_POST['dataUser'];
        $msg="";
        $code=200;
        
        $deleteUser=delete("user", "id_user", $dataUser);
        if($deleteUser){
           $user=usersAll();
           $msg=$user;
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