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
  $user=getAdmin(); 
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
            <a class="navbar-brand" href="adminPanel.php">User profile</a>
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
                <div class="col-md-12">      
                    <div class="card text-center mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src="img/user.png" alt="Card image cap">
                </div>
                <div class="tm-container-inner-2 tm-contact-section">
            <div class="row">
              <div class="col-md-12" id="con">
						<form>
					        <div class="form-group">
					          <input type="text" id="nameInputAdmin" class="form-control" placeholder="Name" value="<?=$user->name_user?>"/>
					        </div>
							    <div class="form-group">
					          <input type="text" id="lastNameInputAdmin" class="form-control" placeholder="Last Name" value="<?=$user->lastname_user?>"/>
					        </div>
					        <div class="form-group">
					          <input type="email" class="form-control" id="emailInputAdmin" placeholder="Email" value="<?=$user->email_user?>"/>
					        </div>
                  <div class="form-group">
					          <input type="text"  class="form-control" id="emailInputAdmin" placeholder="Email" value="<?=$user->time_register?>" disabled/>
					        </div>
						      <p id="doneA"></p>
					        <div class="form-group tm-d-flex">
					          <button type="button" id="updateAdmin" class="btn tm-btn-right">Update profile</button>
					        </div>
						</form>
					</div>
				</div>
			</div>
            </div>
        </div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
