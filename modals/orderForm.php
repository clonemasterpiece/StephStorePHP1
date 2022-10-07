<?php
    include_once "functions.php";

    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $idUserR=$_POST['loggedIn'];
        $addressUserR=$_POST['address'];
        $phoneUserR=$_POST['phone'];
        $idFoodR=$_POST['food'];
        $msg="";
        $code=201;
        $validR=true;

        //regularni 
        $addressUserRegexR='/[^A-Za-z0-9]+/';
        $phoneUserRegexR='/^([0-9]{0,9})\s?([0-9]{0,9})\s?([0-9]{0,9})$/';

        //funkcija za proveru
        function formCheckServerR($valueS, $regexS, $textS){
            if($valueS==""){
                $validR=false;
                $msg="You need to fill out this field.";
            }
            else{
                if(!preg_match($regexS, $valueS)){
                    $validR=false;
                    $msg=$textS;
                }
                else{
                    $validR=true;
                }
            }
        }

    
        //address
        formCheckServerR( $addressUserR, $addressUserRegexR, "Address not in a good format.");

        //email
        formCheckServerR( $phoneUserR, $phoneUserRegexR, "Please enter a valid email phone number.");
    

        if($validR){
            $input=insertOrder($idUserR, $addressUserR, $phoneUserR, $idFoodR);
            var_dump($input);
            if($input){
               try{
                $code=201;
                $msg="Your order has been received.";
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