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
  $menu=getAllFromTable("menu");
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
            <a class="navbar-brand" href="messages.php">Menu</a>
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
        <h3>Menu</h3>
        <div id="menu">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_menu</th>
                  <th scope="col">name_menu</th>
                  <th scope="col">href_menu</th>
                  <th scope="col">show_menu</th>
                  <th scope="col">priority_menu</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($menu as $m):
              ?>
                <tr>
                  <th scope="row"><?=$m->id_menu?></th>
                  <td><input type="text" id="nameMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->name_menu?>"></td>
                  <td><input type="text" id="hrefMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->href_menu?>"></td>
                  <td><input type="number" id="showMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->show_menu?>"></td>
                  <td><input type="number" id="priorityMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->priority_menu?>"></td>
                  <td><a href="#" data-id="<?=$m->id_menu?>" class="updateMenu">Update</a></td>
                  <td><a href="#" data-id="<?=$m->id_menu?>" class="deleteMenu">Delete</a></td>
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
            <h3>Insert menu</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameMenu" class="form-control" placeholder="Enter name"></td>
                  <td><input type="text" id="hrefMenu" class="form-control" placeholder="Enter href"></td>
                  <td><input type="number" id="showMenu" class="form-control" placeholder="Enter show_menu"></td>
                  <td><input type="number" id="priorityMenu" class="form-control" placeholder="Enter priority_menu"></td>
                  <td><a href="#" id="insertMenu">Insert</a></td>
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
