
<!DOCTYPE html><html lang="en">

<head>
	<? $this->load->view('desktop/header.php'); ?>
	<!-- LOADING SCRIPT -->

	<script>

		$(window).load(function(){

			$("#loading").fadeOut(function(){

				$(this).remove();

				$('body').removeAttr('style');

			});
			
			
		});



	</script>

<!-- LOADING SCRIPT END -->

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

                <!-- Main Section -->

                <section class="main-section grid_8">
                    <nav class="collapsed">
                        <a class="chevron" href="#">&raquo;</a>
                        <ul>
                            <li><a href="<?=site_url("stall_owner/manageSales")?>" class="navicon-folder-open">My Sales</a></li>
                            <li class="current"><a href="<?=site_url("stall_owner/report")?>" class="navicon-id-card">Reports</a></li>

                        </ul>
                    </nav>

                    <div class="main-content">
                        <header>
                            <h2>Reports</h2>
                        </header>
                        
                        <section class="container_6 clearfix">
                            <div class="grid_6 leading">
                                <div class="portlet">
                                    
                                    <section>
                                        <div class="tabs">
                                            <ul>
                                                <li><a href="#portlet-pane-1">Best Seller</a></li>
                                                <li><a href="#portlet-pane-2">Hourly Seller</a></li>
                                            </ul>
                                            <section id="portlet-pane-1">
													<img src="<?=$bestSeller?>" align="centre">
											</section>
                                            <section id="portlet-pane-2">
													<img src="<?=$hourlySelling?>" align="centre">
											</section>
                                            
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>

                <!-- Main Section End -->

            </div>

        </section>

    </div>

	<? $this->load->view('desktop/footer.php'); ?>

</body>

</html>


