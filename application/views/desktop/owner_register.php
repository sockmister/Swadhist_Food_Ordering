<!DOCTYPE html>
<html lang="en">
<head>
	<? $this->load->view('desktop/header_au.php'); ?>
	<script language="javascript" src="<?=ASSEST_URL?>admin_template/js_pages/owner_register.js"> </script>
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
              <li><a href="<?php echo site_url("stall_owner_auth/login")?>" class="button" data-icon-primary="ui-icon-info">Back to Login</a></li>
          </ul>
          <h2>Stall Owner Registration</h2>
     	</header>
		<section>
    		<div class="ui-widget message notice">
                <div class="ui-state-highlight ui-corner-all">
                    <p>
              			<span class="ui-icon ui-icon-info"></span>
                        <?php if (!empty($result)) { echo $result; }?>
                    </p>
                </div>
            </div>

    		<form id="form" action="<?php echo site_url("general/ownerSignUp")?>" method="post" class="clearfix">
                <p>
                    <input type="text" id="username"  class="large" value="" name="username" required placeholder="Username" />
				</p>
                <p>
                    <input type="email" id="email"  class="large" value="" name="email" required placeholder="Email" />
				</p>
                <p>
                    <input type="password" id="password" class="large" value="" name="password" required placeholder="Password" />
				</p>
                <p>
                    <input type="password" id="password2" class="large" value="" name="password2" required placeholder="Re-enter Password" />
				</p>
                <p>	
                    <button class="large button-gray ui-corner-all fr" type="submit">Register</button>
                </p>
            </form>
    	</section>
    </div>
</body>
</html>