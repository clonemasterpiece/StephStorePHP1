<?php

   require_once "connectionCredentials.php";

    try{
        $conn=new PDO("mysql:host=".SERVER.";dbname=".DATABASE, USERNAME, PASSWORD);

        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
        echo "Error message: ".$ex->errorMessage();
    }
?>