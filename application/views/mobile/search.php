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
				<h1>Swadhist</h1>
				<h2>Online Order Service</h2>
			</div>
		</header>
	 
		<div id="home_page" class="page">
			<p>&nbsp;</p>
			<div id="blogSearch" class="innerContent">
				<input type="search" id="searchField" class="searchField" placeholder="enter the name of dishes you want to search"><br/>
				<ul id="suggestions" data-role="listview" data-inset="true"></ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<? $this->load->view('mobile/footer.php'); ?>
	</div> <!--! end of #container -->
  
	<? $this->load->view('mobile/bottom_library.php'); ?>
	<script language="javascript">
		var searchURL = "<?=site_url("general/search")?>";
		var dishURL = "<?=site_url("general/dish_details")?>";
	</script>
	<script language="javascript" src="<?=ASSEST_URL?>mobile_template/js/search_page.js"></script>
</body>
</html>