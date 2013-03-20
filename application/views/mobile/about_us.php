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
				<h1>About Us</h1>
			</div>
		</header>
   
		<div id="home_page" class="page">
			<div class="content">
				<div class="groupBox innerContent">
					<h1><center>Swadhist</center></h1>
					<ul class="list">
						<li>
							<p>Our team has developed Swadhist, an online web-based application that seeks to alleviate the issue at hand.</p>
						</li>
						<li>
							<p>For stall owners, Swadhist features a highly-intuitive interface for</p>
							<p> 1. Initializing a dish inventory.</p>
							<p> 2. Scheduling food orders based on timeslots.</p>
							<p> 3. Sales report generation for logging sales attributed to online orders.</p>
						</li>
						<li>
							<p>For customers, Swadhist is easily accessible via a web browser with an internet connection. Upon successful authentication using his/her NUSNET account, Swadhist provides the customer with a simple ordering process, starting with</p>
							<p> 1. A view to browse all available stalls and their respective menus.</p>
							<p> 2. An interface for placing a dish order, based on the selected timeslot and specified quantity</p>
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