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
  $category=getAllFromTable("category");
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
            <a class="navbar-brand" href="messages.php">Categories</a>
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
        <h3>Category</h3>
        <div id="category">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_cat</th>
                  <th scope="col">name_cat</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($category as $c):
              ?>
                <tr>
                  <th scope="row"><?=$c->id_cat?></th>
                  <td><input type="text" id="nameCategory<?=$c->id_cat?>" class="form-control" value="<?=$c->name_cat?>"></td>
                  <td><a href="#" data-id="<?=$c->id_cat?>" class="updateCategory">Update</a></td>
                  <td><a href="#" data-id="<?=$c->id_cat?>" class="deleteCategory">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- kraj update i delete -->
      <!-- insert -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <table class="table">
            <h3>Insert category</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameCategory" class="form-control" placeholder="Enter name"></td>
                  <td><a href="#" id="insertCategory">Insert</a></td>
                </tr>
              </tbody>
      </table>  
		  </div>
      </div>
      <!-- kraj inserta -->
		</div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
