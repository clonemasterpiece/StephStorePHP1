<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataProduct=$_POST['dataProduct'];
        $msg="";
        $code=200;
        
        $deleteProduct=delete("products", "id", $dataProduct);
        if($deleteProduct){
           $products=getProducts();
           $cat=getAllFromTable("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat
           ]);
           $msg=$arrayBack;
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