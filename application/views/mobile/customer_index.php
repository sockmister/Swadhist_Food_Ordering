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
				<h1><?=$this->session->userdata('name')?></h1>
				<h2>Online Order Service</h2>
			</div>
    	</header>
		
		<div id="customer_page" class="page">
			<div class="content">
            	<!--<h5 class="sectionTitle"> Personal </h5>-->
				<div id="pivotTabs" class="pivotTabs">
					<div id="scroller">
						<ul id="thelist">
						  <li> <a href="#" data-value="#myorderTab"> My Orders</a> </li>
						  <li> <a href="#" data-value="#logTab"> Logs</a> </li>
						  <li> <a href="#" data-value="#updateTab"> Update_Info</a> </li>
						  <li> <a href="#" class="goToFirst">&laquo;</a> </li>
						</ul>
              		</div>
            	</div>
			</div>
			<div class="content">
				<div id="myorderTab" class="pivotTab" >
				<? foreach($orders as $order) {?>
					<div class="groupBox">
							<ul>
								  <li>
									  <p class="value"><?=$order->dish_name?> - <?=$order->stall_name?></p>
									  <p class="key">
										  <? if ($order->status == '1') { ?>
											Your food is ready to collect.
										  <? } else { ?>
											Delivery time: From <?=convertTime($order->start_at)?> To <?=convertTime($order->end_at)?>
										  <? } ?>
										  <br/>Quantity: <?=$order->quantity?>
										  <br/>Total Price: $<?=$order->total_price?>
									  </p>
								  </li>
							</ul>
					</div>
					<p>&nbsp;</p>
				<? } ?>
            </div>
            <!-- end tab-->
			<div id="logTab" class="pivotTab" >
				<? foreach($order_logs as $order) {?>
					<h5 class="sectionTitle"><?=$order->order_date?></h5>
					<div class="groupBox">
							<ul>
								  <li>
									  <p class="value"><?=$order->dish_name?> - <?=$order->stall_name?></p>
									  <p class="key">
										  <br/>Quantity: <?=$order->quantity?>
										  <br/>Total Price: $<?=$order->total_price?>
									  </p>
								  </li>
							</ul>
					</div>
					<p>&nbsp;</p>
				<? } ?>
            </div>
            <!-- end tab-->
            <div id="updateTab" class="pivotTab" >
				<div class="ui-widget successMessage" id="updateSlideDown">
					<div class="ui-state-highlight ui-corner-all">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong>Success!</strong> Your information has been changed.</p>
					</div>
				</div>

             	<form action="<?=site_url("customer/update_info")?>" method="POST" data-enhance="false" id="updateInfoForm">
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
					  <input type="button" class="button buttonStrong right" value="Update" name="buttonSubmit" onClick="updateAction()">
					  <div class="clearfix"></div>
					</div>
					<!-- end group box -->
              	</form>
            </div>
            	<!-- end tab-->
			</div>
		</div>
    	<div class="clearfix"></div>

    	<? $this->load->view('mobile/footer.php'); ?>
	</div> <!--! end of #container -->
	
	<? $this->load->view('mobile/bottom_library.php'); ?>
	<script language="javascript" src="<?=ASSEST_URL?>mobile_template/js/customer_index.js"></script>
</body>
</html>