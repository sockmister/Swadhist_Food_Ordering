<!DOCTYPE html><html lang="en">
<head>
	<? $this->load->view('desktop/header.php'); ?>

	<!-- LOADING SCRIPT -->
	<script>
		$(window).load(function(){
			$("#loading").fadeOut(function(){
				$(this).remove();
				$('body').css('overflow', 'auto');
			});
		});
		
		function updateStallInfo() {
			var name = $("#name").val();
			var contact = $("#contact").val();
			if (name == "" || contact == "") {
				alert("the name  and contact are required.");
				return;
			} else {
				$("#update_stall_info_form").submit();
			}
		}
	</script>
</head>

<body style="overflow: hidden;">
	<div id="loading"> 
		<div id='container'>
			<p id='content'>
				<img id='loadinggraphic' width='16' height='16' src='<?=ASSEST_URL?>images/webapp/ajax-loader-eeeeee.gif' />
				Loading...
			</p>
		</div>
    </div> 

    <div id="wrapper" class="clearfix">
        <header class="container_8 clearfix">
            <? $this->load->view('desktop/top_bar.php'); ?>
			<script language="javascript">
				$("#<?=$top_bar_selected?>").addClass("active");
			</script>
        </header>

        <section>
            <div class="container_8 clearfix">                
				<section class="main-section grid_8">
					<nav class="collapsed">
                        <a class="chevron" href="#">&raquo;</a>
                        <ul>
                            <li class="current"><a href="<?=site_url("stall_owner/updateStallInfo")?>" class="navicon-id-card">Stall Information</a></li>
                        </ul>
                    </nav>
					 <div class="main-content">
						<header>
							<h2>Stall Information</h2>
						</header>
						<section class="container_6 clearfix">
						<!-- Main Section -->
						<?php if (!empty($message)) { ?>
							<div class="ui-widget message notice">
								<div class="ui-state-highlight ui-corner-all">
									<p>
										<span class="ui-icon ui-icon-info"></span>
										<?=$message?>
									</p>
								</div>
							</div>
						<? } ?>
							<!-- Forms Section -->
							<div class="grid_6">
								<div class="portlet">
									<section>
										<form method="post" action="" id="update_stall_info_form">
											<p>Stall Name*: <br/><input type="text" value="<?=$stall->name?>" id="name" name="name" style="width:500px"/></p>
											<p>Stall Contact*: <br/><input type="text" value="<?=$stall->contact?>" id="contact" name="contact" style="width:500px"/></p>
											<p>Image url: <br/><input type="text" value="<?=$stall->img?>" id="img" name="img" style="width:500px"/></p>
											<p>Description: <br>
												<textarea name="description" style="width:850px" id="description" rows="7"><?=$stall->description?></textarea>
											</p>
											<p><button type="button" onClick="updateStallInfo()">UPDATE INFORMATION</button></p>
											<input type="hidden" value="submitted" name="submitted"/>
										</form>
									</section>
								</div>
							</div>
							<!-- End Forms Section -->
						<!-- Main Section End -->
						</section>
					</div>
				</section>
            </div>
        </section>
    </div>
	<? $this->load->view('desktop/footer.php'); ?>
    
</body>
</html>


