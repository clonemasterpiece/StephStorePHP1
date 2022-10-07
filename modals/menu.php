<?php
    include "connection.php";
    $query="SELECT * FROM menu WHERE show_menu=1";  
    
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        
        if($user->id_roles=="1"){
            $query.=" OR show_menu=2 OR show_menu=3";
        }
        else{
            $query.=" OR show_menu=2";
        }
    }
    else{ 
        $query.=" OR show_menu=0";
    }

    $query.=" ORDER BY priority_menu";

    try{    
        $menuResult=$conn->query($query)->fetchAll();
    }
    catch(PDOException $e){
        $message=$e;
    }
?>