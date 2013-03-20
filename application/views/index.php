<!DOCTYPE html> 
<html lang="en"> 
	<!-- HELLO  

    Don't worry, we're glad you're taking an interest in our code.

    We really take pride in our code, ensuring it's clean, semantic

    and search engine friendly.

    If you want to send us any feedback or would like your code to

    look like ours then email us at contact@nusprofectus.com. We're

    always happy to hear what people think of our website.
    
    -->
	<head> 
	<title>NUS Profectus</title>
	<!-- META -->
	
	<meta charset="utf-8">
	<META NAME="AUTHOR" CONTENT="nusprofectus.com">
	<META NAME="KEYWORDS" CONTENT="">
	<meta  property="og:title" content="" />
	<meta property="og:description" content="" />
	<!-- <meta property="og:image" content="<?=ASSEST_URL?>images/logo.jpg"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
	<link rel="apple-touch-icon" href="<?=ASSEST_URL?>images/apple-touch-icon.png"/>
	<LINK REL="SHORTCUT ICON" HREF="<?=ASSEST_URL?>images/favicon.ico" />
	-->
	
	<!-- CORE -->
	<link rel="stylesheet" href="<?=ASSEST_URL?>css/jquery.mobile-1.1.0.min.css" />	
	<link rel="stylesheet" type="text/css" href="<?=ASSEST_URL?>css/mystyle.css"/>
	
	<!-- CORE -->
	<script src="<?=ASSEST_URL?>js/jquery-1.7.1.min.js"></script>
	<script src="<?=ASSEST_URL?>js/jquery.mobile-1.1.0.min.js"></script>
	
</head> 
<body> 

<!-- index page -->
<div data-role="page" id="home_page" data-theme="b">
	<div data-role="header" data-theme="b" style="height:40px;">
		<a href="#about_page" data-icon="question" data-iconpos="notext">about</a>
		<h1>NUS Profectus</h1>
		<? if($this->session->userdata('logged_in') == FALSE) { ?>
			<a href="<?=site_url("general/login")?>" data-icon="login" data-iconpos="notext" rel="external">Login</a>
		<? } else { ?>
			<a href="#user_page" data-icon="my-account" data-iconpos="notext">My account</a>
		<? } ?>
		<div class="header_white_bar"></div>
	</div><!-- /header -->

	<div data-role="content" style="padding:0px;"  data-theme="d" id="hp_content_area">
		<p>NUSID: <?=$this->session->userdata('NUSID')?></p>
		<p>Name: <?=$this->session->userdata('name')?></p>
	</div><!-- /content -->

	<div data-role="footer" data-theme="b">
		<h4><em>&copy; 2012 NUS Profectus</em></h4>
	</div><!-- /footer -->
	
</div><!-- /index page -->

</body>
</html>