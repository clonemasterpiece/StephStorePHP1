<?php
    include_once "functions.php";

    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $message=$_POST['message'];
        $userId=$_POST['userId'];
        $msg="";
        $code=200;
        $valid=true;

        //regex 
        $messageRegex='/^[A-ZČĆŽŠĐ][a-zčćžšđ\s\.,!?]{11,300}$/'; 

        //check funx
        function formCheckServer($valueS, $regexS, $textS){
            if($valueS==""){
                $valid=false;
                $msg="You need to fill out this field.";
            }
            else{
                if(!preg_match($regexS, $valueS)){
                    $valid=false;
                    $msg=$textS;
                }
                else{
                    $valid=true;
                    $msg="";
                }
            }
        }
    
        //message
        formCheckServer($message, $messageRegex, "Message must have at least 12 letters with first letter upper case.");

        if($valid){
            $send=sendMessage($message, $userId);
            if($send){
               try{
                $code=201;
                $msg="Your message has been recieved.";
               } 
                catch(PDOException $ex){
                    $code=500;
                    $msg="Server error.";
                }
            }
            else{
                $msg="Check your fields.";
            }
        }
    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("location: 404Page.php?notFound=1");
        $code=404;
        $msg="Page not found.";
    }
?>