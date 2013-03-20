<!doctype html>
<html class="no-js" lang="en">
<head>
	<? $this->load->view('mobile/header.php'); ?>
	<link rel="stylesheet" type="text/css" href="<?=ASSEST_URL?>jq_rateIt/rateit.css"/>
</head>

<body>
	<div id="container" data-role="page" > 
		<header>
			<div class="upperMenu">
				<? $this->load->view('mobile/upperMenu.php'); ?>
			</div>
			<div id="header">
				<a href="<?=site_url("general/stall_details/".$dish->stall_id)?>" class="homeButton" data-direction="reverse"></a>
				<a href="#" class="menuButton"></a>
				<h1><?=$dish->name?></h1>
				<h2>Online Order Service</h2>
			</div>
		</header>
		<div id="order_page" class="page">
	 		<div class="content">
            	<div id="pivotTabs" class="pivotTabs">
              		<div id="scroller">
                		<ul id="thelist">
                  			<li> <a href="#" data-value="#orderTab"> Online Order</a> </li>
                  			<li> <a href="#" data-value="#infoTab"> Information</a> </li>
                  			<li> <a href="#" class="goToFirst">&laquo;</a> </li>
                		</ul>
              		</div>
            	</div>
			</div>
			<div class="content">
				<div id="orderTab" class="pivotTab" >
				<? if (isset($slots)) { 
					if (count($slots) > 0 && $is_in_blacklist ==  "0")  {?>
					<p><b>AVAILABLE DELIVERY SLOTS:</b><br/><br/></p>
					<? foreach($slots as $slot) { 
						if ($slot->no_available > 0) {
					?>
					<div class="groupBox">
						<ul>
							<a href="#orderDialog" data-rel="dialog" data-transition="none" onClick="$('#deliveryTime').html('From <?=$slot->displayStartTime()?> To <?=$slot->displayEndTime()?>'); $('#orderSlot').val('<?=$slot->id?>')">
							  <li>
								  <p class="value">From <?=$slot->displayStartTime()?> To <?=$slot->displayEndTime()?></p>
								  <p class="key"><em>maximum order quantity: <? echo $slot->no_available < $dish->noAvailable() ? $slot->no_available: $dish->noAvailable(); ?></em></p>
							  </li>
							 </a>
						</ul>
					</div>
					<p>&nbsp;</p>
					<? 	}
						}
					} else {
						if ($is_in_blacklist == "1") {
							echo "<p>You are in the blacklist of this stall, so you can't make any orders. Please contact with the stall owner for more details.</p>";
						} else {
							echo "<p>There isn't any available delivery time slot for today</p>";
						}
				 }} else { 
						if (!$dish->isAvailable()) {			
							echo '<p>We are so sorry, <b>'.$dish->name.'</b> is not available today!<br/><br/></p>';
						} else if ($dish->isSoldOut()) {
							echo '<p>We are so sorry, <b>'.$dish->name.'</b> is sold out!<br/><br/></p>';
						}else {
							echo '<p>We are so sorry, there isn\'t any slot for you to order today.';
						}
			 	} ?>
			</div>
			<div id="infoTab" class="pivotTab">
				<center>
					<img src="<?=$dish->img?>" width="95%" class="mypic"/><br/>
					<em>"<?=$dish->description?>"</em>
				</center>
				<div style="float:left; margin-top:5px">
					<a target="_blank" style='text-decoration:none;' type="icon_link" href="http://www.facebook.com/sharer.php?u=<?=site_url("general/dish_details/".$dish->id)?>"><img  src="http://www.glovingchampionship.com/skin/frontend/images/fbshare.gif"/></a>
				</div>
				<div class="ow-check-in-rating">
                  <div style="padding-right: 7px; height: 18px; float:right" class="yui3-u">
                    <div class="inline">
							<div class="rateit" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5" data-rateit-readonly="<? if ($is_customer) {echo "false";} else {echo "true";}?>" data-rateit-value="<?=$avgRate?>" data-rateit-step="1" id="myrate"></div>
					</div>
            	  </div>
			 	</div>
			 	<div class="ow-g-point">
					<input type="text" placeholder="Your comment..." value="" id="comment_value"/>
					<input type="button" name="comment" value="comment" onClick="comment()"/>
				</div>
				<div id="comment_area">
					<? foreach($comments as $comment) {?>
						<div class="ow-g-point">
							<h3><?=$comment->user_name?> wrote:</h3>
							<p><?=$comment->content?></p>
						</div>
					<? } ?>
				</div>
			</div>
		 </div>
	</div>
    <div class="clearfix"></div>
	<? $this->load->view('mobile/footer.php'); ?>
  </div> <!--! end of #container -->

	<div data-role="page" id="orderDialog">
		<div data-role="header" data-theme="d" data-position="inline">
			<h1>Order</h1>
		</div>

		<div data-role="content" data-theme="c">
			<div class="ui-widget successMessage" id="orderFeedbackMessage">
                  <div class="ui-state-highlight ui-corner-all">
                    	<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    	<strong>Error!</strong> <span id="orderError"></span></p>
                  </div>
            </div>
			<? if($is_customer) { ?>
				<form action="<?=site_url("customer/makeOrder")?>" method="post" id="orderForm">
					<p style="font-size:13px; padding-bottom:5px">Stall name: <b><?=$dish->stall_name?></b></p>
					<p style="font-size:13px; padding-bottom:5px">Dish name: <b><?=$dish->name?></b></p>
					<p style="font-size:13px; padding-bottom:5px">Price: <b> $<?=$dish->price?> / unit</b></p>
					<p style="font-size:13px; padding-bottom:5px">Delivery Time: <b><span id="deliveryTime"></span></b></p>
					<p style="font-size:13px">
						<label for"orderQuantity">Quantity: <br/></label>
						<input type="number" is_posive="true" name="orderQuantity" required value="1" style="margin-top:5px"/>
					</p>
					<p><input type="button" value="Order" onClick="orderAction()"> </p>    
					<p><em>* Please note that you can't cancel the order after clicking the below button. If you don't collect the food, the stall owner may put your name in the blacklist and you can't order next time.</em></p>  
					<input type="hidden" name="orderSlot" id="orderSlot" value=""/>
					<input type="hidden" name="dishId" value="<?=$dish->id?>"/>
					<input type="hidden" name="submitted" value="submitted"/>
				</form>
			<? } else { ?>
				<p>You need to login before making order.</p>
				<a href="<?=site_url("customer_auth/login/general__dish_details__".$dish->id)?>" data-role="button" data-theme="b" rel="external">Login Now</a>     
			<? } ?>
		</div>
	</div>

  	<? $this->load->view('mobile/bottom_library.php'); ?>
	<!-- jquery star -->
	<script src="<?=ASSEST_URL?>jq_rateIt/jquery.rateit.min.js"></script>
	<script language="javascript">
		var dishID = "<?=$dish->id?>";
		var userName = "<?=$this->session->userdata('name')?>";
		var customerIndexURL = "<?=site_url("customer/index")?>";
		var commentURL = "<?=site_url("customer/comment")?>";
		var rateURL = "<?=site_url("customer/rate")?>";
		var permission = "<?=$is_customer?>";
	</script>
	<script language="javascript" src="<?=ASSEST_URL?>mobile_template/js/dish_details.js"></script>
</body>
</html>