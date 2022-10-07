<?php
    session_start();
    if(!isset($_SESSION['user'])){
    header('location: modals/404Page.php?notLogedIn');
    }
    else{
	include "includes/head.php";
	include "includes/nav.php";
?>
			<header class="row tm-welcome-section" id="contact">
				<h2 class="col-12 text-center tm-section-title">Contact Page</h2>
				<p class="col-12 text-center">Let our administrator know what's on your mind!</p>
			</header>
			<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">
				<div class="col-md-6" id="con">
					<form>
						<div class="tm-contact-form">
						<input type="hidden" id="messageLogesIn" value="<?=$_SESSION['user']->id_user?>">
					        <div class="form-group">
					          <textarea rows="5" name="message" class="form-control" id="messageInput" placeholder="Enter a message for administrator"></textarea>
					        </div>
							<span id="errorMsg"></span>
							<p id="done"></p>
					        <div class="form-group tm-d-flex">
					          <button type="button" id="buttonSubmit" class="tm-btn tm-btn-success tm-btn-right" name="buttonSubmit">Send message</button>
					        </div>
						</div>
					</form>
					</div>
					<div class="col-md-6">
						<div class="tm-address-box" id="address">
							<h4 class="tm-info-title tm-text-success">Our Address</h4>
							<address>
								Trg Borisa Kidrica 214a
							</address>
							<a href="tel:069-0901-0110" class="tm-contact-link">
								<i class="fas fa-phone tm-contact-icon"></i> 069-0901-0110
							</a><br>
							<a href="mailto:stephstor@sb.rs" class="tm-contact-link">
								<i class="fas fa-envelope tm-contact-icon"></i> stephstore@sb.rs
							</a>
						</div>
					</div>
				</div>
			</div>
<?php
	}
	include "includes/footer.php";
?>