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
		<div id="update_page" class="page">
			<div class="content" style="margin:0">
				<h5 class="sectionTitle"> Update your information.</h5>  
			  	<form action="<?=site_url("customer/update_info")?>" method="POST" data-enhance="false" id="updateInfoform">
					<div class="groupBox">
						<ul>
							<li>
								<input type="text" placeholder="Name" required name="contactName" id="contactName" value="<?=$this->session->userdata('name')?>">
							</li>
							<li>
								<input type="email" placeholder="Email" required name="contactEmail" id="contactEmail" value="<?=$this->session->userdata('email')?>">
							</li>
							<li>
								<input type="tel" placeholder="Phone" required name="contactPhone" id="contactPhone" value="<?=$this->session->userdata('phone_number')?>">
							</li>
						</ul>
						<input type="hidden" value="submitted" name="submitted"/>
						<input type="button" class="button buttonStrong right" value="Update" onClick="updateAction()">
						<div class="clearfix"></div>
					</div>
					<!-- end group box -->
			  	</form>
			</div>
		</div>
		<div class="clearfix"></div>
		<? $this->load->view('mobile/footer.php'); ?>
	</div> <!--! end of #container -->
	
	<? $this->load->view('mobile/bottom_library.php'); ?>
	<script language="javascript" src="<?=ASSEST_URL?>mobile_template/js/update_info.js"></script>
</body>
</html>