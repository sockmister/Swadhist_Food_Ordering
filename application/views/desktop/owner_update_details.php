<!DOCTYPE html>
<html lang="en">

<head>
	<? $this->load->view('desktop/header_au.php'); ?>
	<script language="javascript">
		var current_email = "<?php echo $this->session->userdata('email') ?>";
	</script>
	<script language="javascript" src="<?=ASSEST_URL?>admin_template/js_pages/owner_update_details.js"> </script>
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
          <h2>Stall Owner Details</h2>
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
    		<form id="form" action="<?php echo site_url("stall_owner_update/update_details")?>" method="post" class="clearfix">
                <p>
                    Owner ID: <?php echo $this->session->userdata('owner_id'); ?>
				</p>
                <p>
                    Username: <?php echo $this->session->userdata('name'); ?>
				</p>
                <p>
                    Email: <input type="text"  id="email"  class="large" name="email" required placeholder="<?php echo $this->session->userdata('email') ?>" value="<?php echo $this->session->userdata('email') ?>"/>
				</p>
                <p>	
                    <button class="large button-gray ui-corner-all fr" type="submit">Update</button>
                </p>
            </form>
    	</section>
    </div>
</body>
</html>