<!doctype html>
<html class="no-js" lang="en">
<head>
	<? $this->load->view('mobile/header.php'); ?>
</head>

<body>
 	<div id="container" data-role="page" > 
		<header>
			<div class="upperMenu">
				<? $this->load->view('mobile/upperMenu.php'); ?>
			</div>
			<div id="header">
				<a href="#" class="menuButton"></a>
				<h1>Swadhist</h1>
				<h2>Online Order Service</h2>
			</div>
		</header>
		
		<div id="home_page" class="page">
			<div class="content" style="margin:0">
				<? if($this->session->userdata('logged_in') == "customer") { ?>
					<!--<div class="instruction" align="right"> 2 orders - <em> tap to view </em></div>-->
				<? }; ?>
				<div class="groupBox innerContent ">
					<div id="bannerSlider" class="flexslider">
					  <ul class="slides">
						<li>
						  <img src="<?=ASSEST_URL?>mobile_template/img/front_img1.jpg" alt="Slide" />
						</li>
						<li>
						  <img src="<?=ASSEST_URL?>mobile_template/img/front_img2.jpg" alt="Slide" />
						</li>
						<li>
						  <img src="<?=ASSEST_URL?>mobile_template/img/front_img3.jpg" alt="Slide" />
						</li>
						<li>
						  <img src="<?=ASSEST_URL?>mobile_template/img/front_img4.jpg" alt="Slide" />
						</li>
						<li>
						  <img src="<?=ASSEST_URL?>mobile_template/img/front_img5.jpg" alt="Slide" />
						</li>
					  </ul>
					</div>
				</div>
			</div>
			<div data-role="content" style="padding-top:0px; margin-top:-1px">
				<ul data-role="listview" style="margin-top: 0;">
					<? foreach($stalls as $stall) {?>
						<li>
							<a href="<?=site_url("general/stall_details/".$stall->id)?>">
								<h3><?=$stall->name?></h3>
								<p><?=$stall->no_dishes?> dishes</p>
							</a>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
    	<div class="clearfix"></div>
    	<? $this->load->view('mobile/footer.php'); ?>
	</div> <!--! end of #container -->
	<? $this->load->view('mobile/bottom_library.php'); ?>
</body>
</html>