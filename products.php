<?php
 session_start();
  if(!isset($_SESSION['user'])){
  header("location: modals/404Page.php?notFound");
  }
  else if($_SESSION['idRole']!=1){
  header("location: modals/404Page.php?notFound");
  }
  else{
  include "includes/headAdmin.php";
  include "includes/navAdmin.php";
  include "modals/functions.php";
  $products=getAllFromTable('products');
  $categories=getAllFromTable("category");
?>
  <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="adminPanel.php">Products Table</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
        </div>
      </nav>
       <!-- End Navbar -->
    <div class="content">
        <div class="container">
            <div class="row">
      <!-- update i delete -->
      <div class="col-md-12">   
        <h3>Products</h3>
        <div id="productss">
        <form action="#" enctype="multipart/form-data">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_products</th>
                  <th scope="col">price</th>
                  <th scope="col">name_products</th>
                  <th scope="col">picture_src</th>
                  <th scope="col">change src</th>
                  <th scope="col">name_cat</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($products as $p):
              ?>
                <tr>
                  <th scope="row"><?=$p->id?></th>
                  <td><input type="text" id="nameProducts<?=$p->id?>" class="form-control" value="<?=$p->name?>"></td>
                  <td><input type="text" id="cenaProducts<?=$p->id?>" class="form-control" value="<?=$p->cena?>"></td>
                  <td><input type="text" id="srcProducts<?=$p->id?>" class="form-control" value="<?=$p->src?>" disabled></td>
                  <td><input type="file" id="fileProducts<?=$p->id?>" class="form-control-file"></td>
                  <td>
                      <!-- padajuca lista -->
                      <div class="form-group">
                             <select class="form-select product<?=$p->id?>"  aria-label="Default select example">
                             
                                <?php
                                foreach($categories as $c):
                                    if($p->kategorija_id == $c->id_cat):
                                ?>
                              <option selected value="<?=$c->id_cat?>"><?=$c->name_cat?></option>

                                    <?php 
                                        else:
                                    ?>
                              <option value="<?=$c->id_cat?>"><?=$c->name_cat?></option>
                                <?php
                                  endif;
                                  endforeach;
                                ?>
                            </select>
                        </div>
                      <!-- kraj padajuce liste -->
                  </td>
                  <td><a href="#" data-id="<?=$p->id?>" class="updateProduct">Update</a></td>
                  <td><a href="#" data-id="<?=$p->id?>" class="deleteProduct">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
            </form>
            <p id="write"></p>
          </div>
          </div>
		    </div>
      <!-- kraj update i delete -->
      <!-- insert -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <form action="#" enctype="multipart/form-data">
      <table class="table">
            <h3>Insert product</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameProduct" class="form-control" placeholder="Enter name"></td>
                </tr>
                <tr>
                <td><input type="number" id="priceProduct" class="form-control" placeholder="Enter price"></td>
                </tr>
                <tr>
                <td><div class="form-group">
                             <select class="form-select catInsert" id="catInsert" aria-label="Default select example">
                              <option selected value="0">Choose category</option>
                                <?php
                                foreach($categories as $c):
                                ?>
                              <option value="<?=$c->id_cat?>"><?=$c->name_cat?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                    </div></td>
                </tr>
                
                <tr>
                  <td><input type="file" id="fileProducts" class="form-control-file"></td>
                  <td><a href="#" id="insertProduct">Insert</a></td> 
                </tr>
              </tbody>
      </table>
      </form>  
		  </div>
      </div>
      <!-- kraj inserta -->
		</div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
