<!DOCTYPE html>
<html lang="en">
<head>
	<? $this->load->view('desktop/header_au.php'); ?>
	<script language="javascript" src="<?=ASSEST_URL?>admin_template/js_pages/owner_login.js"></script> 
</head>

<body class="login">
    <div id="loading"> 
		<div id='container'>
			<p id='content'>
				<img id='loadinggraphic' width='16' height='16' src='<?=ASSEST_URL?>images/webapp/ajax-loader-eeeeee.gif' />
				Loading...
			</p>
		</div>
    </div> 
    <div class="login-box main-content">
		<header>
          <ul class="action-buttons clearfix">
          	<li>
			  	<a href="<?php echo site_url("general/ownerSignUp")?>" class="button" data-icon-primary="ui-icon-info">Register</a>
			</li>
			<li>
				<a href="<?php echo site_url("general/forgetPassword")?>" class="button" data-icon-primary="ui-icon-help">Forgot Password</a>
			</li>
          </ul>
          <h2>Stall Owner Login</h2>
      	</header>
		<section>
    		<div class="ui-widget message notice">
                <div class="ui-state-highlight ui-corner-all">
                    <p>
                    	<span class="ui-icon ui-icon-info"></span>
                        <?php if (!empty($result)) { echo $result;}?>
                    </p>
                </div>
            </div>
    		<form id="form" action="<?php echo site_url("stall_owner_auth/login")?>" method="post" class="clearfix">
				<p>
					<input type="text" id="username"  class="large" value="" name="username" required placeholder="Username" />
					<input type="password" id="password" class="large" value="" name="password" required placeholder="Password" />
					<button class="large button-gray ui-corner-all fr" type="submit">Login</button>
			   </p>
           </form>
    	</section>
    </div>
</body>
</html>