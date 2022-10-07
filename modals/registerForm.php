<?php
    include_once "functions.php";

    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $firstNameR=$_POST['firstNameR'];
        $lastNameR=$_POST['lastNameR'];
        $emailR=$_POST['emailR'];
        $passR=$_POST['passR'];
        $msg="";
        $code=201;
        $validR=true;

        //regularni 
        $fullNameRegexR='/^[A-ZČĆŽŠĐ][A-Za-zčćžšđ\s]{2,15}$/';
        $eMailRegexR='/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/';
        $passRegexR='/^.{6,30}$/';

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

        //first name
        formCheckServerR($firstNameR, $fullNameRegexR, "Name not in a good format - start with upper case leading up to at least 3 letters.");

        //last name
        formCheckServerR($lastNameR, $fullNameRegexR, "Last name not in a good format - start with upper case leading up to at least 3 letters.");

        //email
        formCheckServerR($emailR, $eMailRegexR, "Please enter a valid email address.");
    
        //message
        formCheckServerR($passR, $passRegexR, "Password not in a good format - it must have at least 6 charachters.");

        if($validR){
            $input=registerUser($firstNameR, $lastNameR, $emailR, $passR);
            if($input){
               try{
                $code=201;
                $msg="You have been registered.";
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