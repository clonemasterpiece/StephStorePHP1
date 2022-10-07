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
  $messages=messagesReturn();
  $questions=getAllFromTable("survey");
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
            <a class="navbar-brand" href="messages.php">Messages</a>
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
        <div class="row">
          <div class="col-md-12">
            <h3>User messages</h3>
          <div id="messages">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Message</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $rb=1;
                foreach($messages as $message):
              ?>
                <tr>
                  <th scope="row"><?=$rb?></th>
                  <td><?=$message->name_user?></td>
                  <td><?=$message->last_name?></td>
                  <td><?=$message->email_user?></td>
                  <td><?=$message->message_user?></td>
                  <td><a href="#" data-id="<?=$message->id_msg?>" class="idDelete">Delete</a></td>
                </tr>
              <?php
                $rb++;
                endforeach;
              ?>
                </tbody>
            </table>
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
