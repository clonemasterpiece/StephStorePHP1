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
  $roles=getAllFromTable("roles");
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
            <a class="navbar-brand" href="messages.php">User Roles</a>
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
        <h3>Roles</h3>
        <div id="roles">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_roles</th>
                  <th scope="col">role</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($roles as $r):
              ?>
                <tr>
                  <th scope="row"><?=$r->id_roles?></th>
                  <td><input type="text" id="nameRole<?=$r->id_roles?>" class="form-control" value="<?=$r->role?>"></td>
                  <td><a href="#" data-id="<?=$r->id_roles?>" class="updateRole">Update</a></td>
                  <td><a href="#" data-id="<?=$r->id_roles?>" class="deleteRole">Delete</a></td>
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
            <h3>Insert role</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameRole" class="form-control" placeholder="Enter name"></td>
                  <td><a href="#" id="insertRole">Insert</a></td>
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
