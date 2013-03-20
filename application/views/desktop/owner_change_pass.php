<!DOCTYPE html>
<html lang="en">
<head>
	<? $this->load->view('desktop/header_au.php'); ?>
	<script language="javascript" src="<?=ASSEST_URL?>admin_template/js_pages/owner_change_pass.js"> </script>
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
			<li><a href="<?php echo site_url("stall_owner/getStallOrder")?>" class="button" data-icon-primary="ui-icon-info">Back to Dashboard</a></li>
          </ul>
          <h2>Change Password</h2>
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
    		<form id="form" action="<?php echo site_url("stall_owner_update/change_password")?>" method="post" class="clearfix">
                <p>
                    <input type="password" id="password" class="large" value="" name="password" required placeholder="Enter current password" />
				</p>
                <p>
                    <input type="password" id="newpassword" class="large" value="" name="newpassword" required placeholder="Enter new password" />
				</p>
                <p>	
                    <button class="large button-gray ui-corner-all fr" type="submit">Change</button>
                </p>
            </form>
    	</section>
    </div>
</body>
</html>