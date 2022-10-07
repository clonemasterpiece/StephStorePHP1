<?php
    include "./modals/menu.php";
?>    
    <nav class="navbar navbar-expand-lg px-4">
      <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="sss"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav">
        <span class="toggler-icon"><i class="fas fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="myNav">
        <ul class="navbar-nav mx-auto text-capitalize">
            <?php foreach($menuResult as $m):
            ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?=$m->href_menu?>"><?=$m->name_menu?></a>
          </li>
                
          <?php endforeach; 
          ?>
        </ul>
        <div class="nav-info-items d-none d-lg-flex ">
          <!--  info -->
          <?php
			      if(isset($_SESSION['user'])):
            $username = $_SESSION['user']->name_user;
		      ?>
          <div class="nav-info align-items-center d-flex justify-content-between mx-lg-5">
            <!-- <span class="info-icon mx-lg-3"><i class="fas fa-phone"></i></span> -->
            <p class="mb-0">Welcome <span class="text-primary"><?php echo $username; ?></span> :)</p>
          </div>
          <?php
					  endif;
				  ?>
          <!-- info -->
          
        </div>
      </div>
    </nav>