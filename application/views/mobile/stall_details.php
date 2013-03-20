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
				<a href="<?=site_url("general/index")?>" class="homeButton" data-direction="reverse"></a>
				<a href="#" class="menuButton"></a>
				<h1><?=$stall->name?></h1>
				<h2><?=$stall->contact?></h2>
			</div>
		</header>
		<div id="stall_details_page" class="page">
			<div class="content">
				<center><img src="<?=$stall->img?>" width="95%" class="mypic"/></center>
				<div style="margin-bottom: 7px;" class="ow-g-sub-h">
					<h1><?=$stall->name?></h1>
					<p><?=$stall->description?><p>
				</div>
				<? foreach($dishes as $dish) {?>
				<div class="ow-check-in" onClick="location.href='<?=site_url("general/dish_details/".$dish->id)?>'">
					<table>
						<tbody><tr>
						<th>
							<div class="ow-check-in-pic">
								<a href="<?=site_url("general/dish_details/".$dish->id)?>"><img src="<?=$dish->img?>" class="ow-check-in-img"></a>
							</div>
							<div class="ow-check-in-shadow"></div>
						</th>
						<td class="ow-check-in-m">
							<div class="blueheader"><?=$dish->name?></div>
							<div><?=$dish->displayDay()?></div>
							<div class="ow-check-in-rating">
								<div class="yui3-g">
									<div style="padding-right: 7px; height: 18px;" class="yui3-u">
										<div class="inline">
											<div class="rateit" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5" data-rateit-readonly="true" data-rateit-value="<?=$dish->avgRate?>" data-rateit-step="1" id="myrate"></div>
											<div class="clear"></div>
										</div>
									</div>
									<p><b>$<?=$dish->price?></b></p>
								</div>
							</div>
						</td>
						</tr></tbody>
					</table>
				</div>
				<? } ?>
	  		</div>
		</div>
    	<div class="clearfix"></div>
    	<? $this->load->view('mobile/footer.php'); ?>
	</div> <!--! end of #container -->
	
	<? $this->load->view('mobile/bottom_library.php'); ?>
	<!-- jquery star -->
	<script src="<?=ASSEST_URL?>jq_rateIt/jquery.rateit.min.js"></script>

</body>
</html>