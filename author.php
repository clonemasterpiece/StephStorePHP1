<?php
  session_start();
  include "includes/head.php";
?>

<body>
  <!-- header -->
  <header>
    <!-- navbar  -->
    
<?php
  include "includes/nav.php";
?>
    <!-- end of nav -->
    <!-- banner  -->
    <div class="container-fluid">
      <div class="row max-height justify-content-center align-items-center author-pozadina">
        <div class="col-10 mx-auto banner text-center">
          <h1> <strong class="banner-title-one ">About author</strong></h1>
        </div>
        </div>
      </div>
    </div> 
  </header>
  <!-- header -->
  <!-- about us -->
  <section class="about py-5" id="about">
    <div class="container">

      <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5">
          <h1 class="text-capitalize">about <strong class="banner-title ">author</strong></h1>
          <p class="my-4 text-muted w-75">Hello everybody! My name is Bojan Stefanovski, i'm coming from Serbia. This is my website for school presentation. Hope you'd enjoy 'sufring' on it! HF</p>
          <a href="index.html" class="btn btn-outline-secondary btn-black text-uppercase ">Go back to main page</a>

        </div>
        <div class="col-10 mx-auto col-md-6 align-self-center my-5">
          <div class="about-img__container">
            <img src="img/authorSlika.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
      </div>
  </section>
  <?php
    include "includes/footer.php";
  ?>