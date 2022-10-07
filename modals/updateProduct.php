<?php
     include "functions.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataProducts=$_POST['dataProducts'];
        $nameProducts=$_POST['nameProducts'];
        $cenaProducts=$_POST['cenaProducts'];
        $catValue=$_POST['catValue'];
        $msg="";
        $code=200;
        $valid=true;
       
        if(empty($_FILES['filePicture'])){
            $name=$_POST['filePicture'];
        }
        else{
            $filePicture=$_FILES['filePicture'];
            $tmpName=$filePicture['tmp_name'];
            $type=$filePicture['type'];
            $name=$filePicture['name'];
            $src="../img/";
            $typeNew=explode("/", $type);

            if($typeNew[1]!="png" && $typeNew[1]!="jpg" && $typeNew[1]!="jpeg"){
                $valid=false;
            }
        }
        if($valid){
            $updateProduct=updateProduct($dataProducts, $nameProducts, $cenaProducts, $catValue, $name);
        }
        
        if($updateProduct){
            if(!empty($_FILES['filePicture'])){
                $result=move_uploaded_file($tmpName, $src.$name);
            }
           $products=getProducts();
           $cat=getAllFromTable("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat,
                "msg"=>"You have you have successfully updated this row!"
           ]);
           $msg=$arrayBack;
           $code=200;
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