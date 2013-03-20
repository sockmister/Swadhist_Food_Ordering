<div class="upperMenu">
	<div class="pagesMenu flexslider">
			<ul class="slides">
				<li>
					<a href="<?=site_url()?>" id="linkHome">
					  <img src="<?=ASSEST_URL?>mobile_template/img/home_page.png" alt="Login">
					 </a>
				</li>
				<? if($this->session->userdata('logged_in') == "customer") { ?>
				<li>
					<a href="<?=site_url("customer/index")?>" id="linkAccount">
					  <img src="<?=ASSEST_URL?>mobile_template/img/account.png" alt="Account">
					 </a>
				</li>
				<? } else { ?>
				<li>
					<a href="<?=site_url("customer_auth/login")?>" id="linkLogin" data-ajax="false">
					  <img src="<?=ASSEST_URL?>mobile_template/img/login.png" alt="Login">
					 </a>
				</li>
				<? } ?>
				<li>
					<a href="<?=site_url("general/search")?>" id="linkSearch" data-ajax="false">
						<img src="<?=ASSEST_URL?>mobile_template/img/search.png" alt="Search">
					</a>
				</li>
				<li>
					<a href="<?=site_url("general/aboutUs")?>" id="linkAbout" data-ajax="false">
						<img src="<?=ASSEST_URL?>mobile_template/img/about.png" alt="About">
					</a>
				</li>
				<li>
					<a href="<?=site_url("general/contact")?>" id="linkContact" data-ajax="false">
						<img src="<?=ASSEST_URL?>mobile_template/img/contact.png" alt="Contact">
					</a>
				</li>
				
				<? if($this->session->userdata('logged_in') == "customer") { ?>
				<li>
					<a href="<?=site_url("customer_auth/logout")?>" id="linkLogout" data-ajax="false">
					  <img src="<?=ASSEST_URL?>mobile_template/img/logout.png" alt="Logout">
					 </a>
				</li>
				<? } ?>
			</ul>
		</div>    
</div>