<?php
    include "connection.php";
    define("OFFSET", 6);//6 proizvoda 

    function sendMessage($msg, $userId){
        global $conn;
        
        try{
            $query="INSERT INTO msguser(id_msg, message_user, id_user) VALUES(NULL, :msg, $userId)";
            $send=$conn->prepare($query);
            $send->bindParam(":msg", $msg);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    

    function getAllFromTable($nameTabel){
        global $conn;

        try{
            $query="SELECT * FROM $nameTabel";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function filterCat($id){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.kategorija_id=c.id_cat WHERE c.id_cat=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->execute();
            $result=$send->fetchAll();
            return $result;

        }
        catch(PDOException $e){
            $message="Server error";
        }
    
    }

    function registerUser($firstNameR, $lastNameR, $emailR, $passR){
        global $conn;

        try{
            $pass=md5($passR);
            $query="INSERT INTO user(id_user, name_user, last_name, email_user, password_user, id_roles) VALUES(NULL,:firstNameR, :lastNameR, :emailR, :pass, 2)";
            $send=$conn->prepare($query);
            $send->bindParam(":firstNameR", $firstNameR);
            $send->bindParam(":lastNameR", $lastNameR);
            $send->bindParam(":emailR", $emailR);
            $send->bindParam(":pass", $pass);
 
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function loginUser($emailL, $pass){
        global $conn;

        try{
            $query="SELECT * FROM user u JOIN roles r ON u.id_roles=r.id_roles WHERE u.email_user=:emailL AND u.password_user=:pass";
            $send=$conn->prepare($query);
            $send->bindParam(":emailL", $emailL);
            $send->bindParam(":pass", $pass);

            $send->execute();
            $result=$send->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function search($valueS){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.kategorija_id=c.id_cat WHERE p.name LIKE '%$valueS%' OR c.name_cat LIKE '%$valueS%'";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }


    function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM msguser m INNER JOIN user u ON m.id_user=u.id_user";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function deleteMessage($idMessage){
        global $conn;
        
        try{
            $query="DELETE FROM msguser WHERE id_msg=:idMessage";
            $send=$conn->prepare($query);
            $send->bindParam(":idMessage", $idMessage);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }


    function insertOrder($idUser, $addressUser, $phoneUser, $idFood){
        global $conn;

        try{
            $query="INSERT INTO food_order(user_id, user_address, user_phone, id_food) VALUES(:idUser, :addressUser, :phoneUser, :idFood)";
            $send=$conn->prepare($query);
            $send->bindParam(":idUser", $idUser);
            $send->bindParam(":addressUser", $addressUser);
            $send->bindParam(":phoneUser", $phoneUser);
            $send->bindParam(":idFood", $idFood);
 
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }



    function getAdmin(){
        global $conn;

        try{
            $query="SELECT * FROM user WHERE id_roles=1";
            $result=$conn->query($query)->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateAdmin($nameAdmin, $lastNameAdmin, $emailAdmin){
        global $conn;

        try{
            $query="UPDATE user SET name_user = :nameAdmin, lastname_user = :lastNameAdmin, email_user = :emailAdmin WHERE id_roles=1";
            $send=$conn->prepare($query);
            $send->bindParam(":nameAdmin", $nameAdmin);
            $send->bindParam(":lastNameAdmin", $lastNameAdmin);
            $send->bindParam(":emailAdmin", $emailAdmin);
            
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function deleteMenu($dataMenu){
        global $conn;
        
        try{
            $query="DELETE FROM menu WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu, $priorityMenu){
        global $conn;

        try{
            $query="UPDATE menu SET name_menu = :nameMenu, href_menu = :hrefMenu, show_menu = :showMenu, priority_menu = :priorityMenu WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":showMenu", $showMenu);
            $send->bindParam(":priorityMenu", $priorityMenu);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertMenu($nameMenu, $hrefMenu, $showMenu, $priorityMenu){
        global $conn;
        
        try{
            $query="INSERT INTO menu(id_menu, name_menu, href_menu, priority_menu, show_menu) VALUES(NULL, :nameMenu, :hrefMenu, :priorityMenu, :showMenu)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":priorityMenu", $priorityMenu);
            $send->bindParam(":showMenu", $showMenu);
            

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function delete($table, $column, $id){
        global $conn;
        
        try{
            $query="DELETE FROM $table WHERE $column=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function updateCategory($dataCategory, $nameCategory){
        global $conn;

        try{
            $query="UPDATE category SET name_cat = :nameCategory WHERE id_cat=:dataCategory";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);
            $send->bindParam(":dataCategory", $dataCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertCategory($nameCategory){
        global $conn;
        
        try{
            $query="INSERT INTO category(id_cat, name_cat) VALUES(NULL, :nameCategory)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateArtist($dataArtist, $nameArtist){
        global $conn;

        try{
            $query="UPDATE artist SET name_artist = :nameArtist WHERE id_artist=:dataArtist";
            $send=$conn->prepare($query);
            $send->bindParam(":nameArtist", $nameArtist);
            $send->bindParam(":dataArtist", $dataArtist);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertArtist($nameArtist){
        global $conn;
        
        try{
            $query="INSERT INTO artist(id_artist, name_artist) VALUES(NULL, :nameArtist)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameArtist", $nameArtist);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function priceProduct(){
        global $conn;

        try{
            $query="SELECT * FROM price p INNER JOIN products pr ON p.id_products=pr.id_products";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updatePrice($dataPrice, $priceOld, $priceNow){
        global $conn;

        try{
            $query="UPDATE price SET price_old = :priceOld, price_now = :priceNow WHERE id_price=:dataPrice";
            $send=$conn->prepare($query);
            $send->bindParam(":priceOld", $priceOld);
            $send->bindParam(":priceNow", $priceNow);
            $send->bindParam(":dataPrice", $dataPrice);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function usersAll(){
        global $conn;

        try{
            $query="SELECT * FROM user u INNER JOIN roles r ON u.id_roles=r.id_roles";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateRole($dataUser, $role){
        global $conn;

        try{
            $query="UPDATE user SET id_roles = :roleId WHERE id_user=:dataUser";
            $send=$conn->prepare($query);
            $send->bindParam(":roleId", $role);
            $send->bindParam(":dataUser", $dataUser);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateRoleUser($dataRole, $nameRole){
        global $conn;

        try{
            $query="UPDATE roles SET role = :nameRole WHERE id_roles=:dataRole";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);
            $send->bindParam(":dataRole", $dataRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertRole($nameRole){
        global $conn;
        
        try{
            $query="INSERT INTO roles(id_roles, role) VALUES(NULL, :nameRole)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateProduct($dataProducts, $nameProducts, $cenaProducts, $catValue, $name){
        global $conn;

        try{
            $query="UPDATE products SET name = :nameProducts, src=:name, cena=:cena, kategorija_id = :catValue WHERE id=:dataProducts";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProducts", $nameProducts);
            $send->bindParam(":cena", $cenaProducts);
            $send->bindParam(":name", $name);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":dataProducts", $dataProducts);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message=$e->getMessage();
            echo $e->getMessage();
        } 
    }

    function insertProduct($nameProduct, $cenaProduct, $catValue, $src){
        global $conn;
        
        try{
            $query="INSERT INTO products(id, name, cena, src, alt, kategorija_id) VALUES(NULL, :nameProduct, :cena, :src, :alt, :catValue)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProduct", $nameProduct);
            $send->bindParam(":cena", $cenaProduct);
            $send->bindParam(":src", $src);
            $send->bindParam(":alt", $nameProduct);
            $send->bindParam(":catValue", $catValue);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
            echo $e->getMessage();
        }
    }

    function insertUser($idUser){
        global $conn;
        
        try{
            $query="INSERT INTO shoppingdone(id_cart, id_user) VALUES(NULL, :idUser)";
            $send=$conn->prepare($query);
            $send->bindParam(":idUser", $idUser);

            $result=$send->execute();
            if($result){
                $lastId=$conn->lastInsertId();
                return $lastId;
            }
            else{
                return $result;
            }
           
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getProducts(){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.kategorija_id=c.id_cat ORDER BY p.id_products";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertToCart($insertUser, $quantity, $idProducts){
        global $conn;
        
        try{
            $query="INSERT INTO items_shop(id_item, id_cart, id_product, quantity) VALUES(NULL, :insertUser, :idProducts, :quantity)";
            $send=$conn->prepare($query);
            $send->bindParam(":insertUser", $insertUser);
            $send->bindParam(":idProducts", $idProducts);
            $send->bindParam(":quantity", $quantity);


            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    
?>