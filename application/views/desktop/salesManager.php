
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
                            <li class="current"><a href="<?=site_url("stall_owner/manageSales")?>" class="navicon-folder-open">My Sales</a></li>
                            <li><a href="<?=site_url("stall_owner/report")?>" class="navicon-id-card">Reports</a></li>

                        </ul>
                    </nav>

                    <div class="main-content">
                        <header>
                            <h2>Sales</h2>
                        </header>
                        
                        <section class="container_6 clearfix">
                            <div class="grid_6" "> 
                                
								<div id="orderArea1">
									
									<table class="display" id="queuetable"> 
										<thead> 
											<tr>
												<th class="ui-state-default" style="width: 114px;">
													<div class="DataTables_sort_wrapper">
														Year
														<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 85px;">
													<div class="DataTables_sort_wrapper">
														Month
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 130px;">
													<div class="DataTables_sort_wrapper">
														Revenue
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>								
												
											</tr>
										</thead> 
										<tbody> 
											
											<?php 
											foreach ($sales as $dataitem){
																							
												switch ($dataitem->month)
												{
												case 1:
												  $month = 'January';
												  break;
												case 2:
												  $month = 'Febuary';
												  break;
												case 3:
												  $month = 'March';
												  break;
												 case 4:
												  $month = 'April';
												  break;
												 case 5:
												  $month = 'May';
												  break;
												 case 6:
												  $month = 'June';
												  break;
												 case 7:
												  $month = 'July';
												  break;
												 case 8:
												  $month = 'August';
												  break;
												 case 9:
												  $month = 'September';
												  break;
												 case 10:
												  $month = 'October';
												  break;
												 case 11:
												  $month = 'November';
												  break;
												 case 12:
												  $month = 'December';
												  break;
												 case 3:
												  $month = 'January';
												  break;
												default:
												  echo "Error";
												}															
											?>

											<tr class="gradeA even" onclick="window.location='<?=site_url("stall_owner/monthSales/".$dataitem->year."/".$dataitem->month)?>'"> 
												<td class=" sorting_1" style="text-align:center"><?=$dataitem->year?></td> 
												<td  style="text-align:center"><?=$month?></td> 
												<td  style="text-align:center">$<?=$dataitem->revenue?></td> 																						
											</tr>
											
											<? } ?>
											

										</tbody> 
									</table> 

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


