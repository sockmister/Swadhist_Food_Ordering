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
			<a href="#" class="homeButton" data-direction="reverse"></a>
        	<a href="#" class="menuButton"></a>
        	<h1>Profectus</h1>
        	<h2>Online Order Food</h2>
 		</div>
    </header>
   
	<div id="dishes_page" class="page">
		<div class="innerContent">
			<input type="search" class="searchField" placeholder="search blog">
		</div>
		<div class="blogListing" >
			<ul>
			  
			  <li>
				<div class="groupBox innerContent">
				  <div class="postDetails left">
					<a class="thumb" href="blog-detail.php">
					  <img src="img/slides/1.jpg" alt="Post 1">
					</a>
				  </div>
				  
				  <div class="description">
					<div class="title">
					  <a href="blog-detail.php"> Company going public </a>
					</div>
					<div class="about">
					  This is the biggest day for our company as we will be going public.This is the biggest day for our company as we will be going public.This is the biggest day for our company as we will be going public.
					</div>
					<a href="blog-detail.php" class="website">  &raquo; </a>
				  </div>
				  <div class="clearfix"></div>
				  
				  <div class="tags left">
					<a class="category" href="#"> News </a>
					<a class="date" href="#"> 12 Aug 2012</a>
					<a class="writer" href="#"> Rolf Mandy</a>
					<div class="clearfix"></div>
				  </div>
				  <div class="clearfix"></div>
				</div>
				
			  </li>
			  
			  
			  
			  
			  <li>
				<div class="groupBox innerContent">
				  <div class="postDetails left">
					<a class="thumb" href="blog-detail.php">
					  <img src="img/slides/4.jpg" alt="Post 1">
					</a>
				  </div>
				  
				  <div class="description">
					<div class="title">
					  <a href="blog-detail.php"> Release preview postponed.</a>
					</div>
					<div class="about">
					  We have delayed the release of the new software..
					</div>
					<a href="blog-detail.php" class="website">  &raquo; </a>
				  </div>
				  <div class="clearfix"></div>
				  
				  
				  <div class="tags left">
					<a class="category" href="#"> Press</a>
					<a class="date" href="#"> 10 Aug 2012</a>
					<a class="writer" href="#"> Mark D</a>
					<div class="clearfix"></div>
				  </div>
				  <div class="clearfix"></div>
				</div>
				
			  </li>
			</ul>
		</div>
		
	</div>
    <div class="clearfix"></div>

    <? $this->load->view('mobile/footer.php'); ?>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
  
  <script src="<?=ASSEST_URL?>mobile_template/js/iscroll.js"></script>
  <script src="<?=ASSEST_URL?>mobile_template/js/jquery.flexslider-min.js"></script>
  <script src="<?=ASSEST_URL?>mobile_template/js/photoswipe/klass.min.js"></script>
  <script src="<?=ASSEST_URL?>mobile_template/js/photoswipe/code.photoswipe.jquery-3.0.5.min.js"></script>
  <script>
    $(document).bind("mobileinit", function(){
       $.mobile.defaultPageTransition = 'none'; 
          $.mobile.ignoreContentEnabled = true;
    });
  </script>
  <script src="<?=ASSEST_URL?>js/jquery.mobile-1.1.0.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="<?=ASSEST_URL?>mobile_template/js/helper.js"></script>
  <script src="<?=ASSEST_URL?>mobile_template/js/script.js"></script>
  <!-- end scripts-->


</body>
</html>