<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $idMessage=$_POST['id'];
        $msg="";
        $code=200;
        
        $deleteMessage=deleteMessage($idMessage);
        
        if($deleteMessage){
           $messages=messagesReturn();
           $msg=$messages;
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