<?php
	include "includes/head.php";
	include "includes/nav.php";
?>
<header class="row tm-welcome-section" id="contact">
				<h2 class="col-12 text-center tm-section-title">Welcome back.</h2>
				<p class="col-12 text-center">Use your credentials to log in below.</p>
			</header>
			<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">
					<div class="col-md-12" id="con">
						<form>
					        <div class="form-group">
					          <input type="email" name="email" class="form-control" id="emailInputL" placeholder="Email"/>
					        </div>
							<span id="errorEmailL"></span>
							<div class="form-group">
					          <input type="password" name="password" class="form-control" id="passwordInputL" placeholder="Password"/>
					        </div>
							<span id="errorPassL"></span>
							<p id="doneL"></p>
					        <div class="form-group tm-d-flex">
					          <button id="buttonSubmitL" class="tm-btn tm-btn-success tm-btn-right">Log in</button>
					        </div>
						</form>
					</div>
				</div>
			</div>
<?php
	include "includes/footer.php";
?>