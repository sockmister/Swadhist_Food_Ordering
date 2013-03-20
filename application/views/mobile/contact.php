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
				<a href="<?=site_url("general/index")?>" class="homeButton" data-direction="reverse"></a>
				<a href="#" class="menuButton"></a>
				<h1>Contact Us</h1>
			</div>
		</header>
   
		<div id="home_page" class="page">
			<div class="content">
				<div class="groupBox innerContent">
					<h1><center>Swadhist</center></h1>
					<ul class="list">
						<li>
							<p>Address: 25 Prince George's Park Residence 6 BLK 28 S[118424]</p>
						</li>
						<li>
							<p>Phone number: +65 8179 1386</p>
						</li>
						<li>
							<p>Email address: contact@nusprofectus.com</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
    	<? $this->load->view('mobile/footer.php'); ?>
		
  	</div> <!--! end of #container -->
	<? $this->load->view('mobile/bottom_library.php'); ?>
</body>

</html>