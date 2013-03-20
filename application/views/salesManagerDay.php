
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
                            <h2>Daily Sales</h2>
                        </header>
                        
                        <section class="container_6 clearfix">
                            <div class="grid_6" "> 
                                
									
									<table class="display" id="queuetable"> 
										<thead> 
											<tr>
												<th class="ui-state-default" style="width: 114px;">
													<div class="DataTables_sort_wrapper">
														Date
														<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 85px;">
													<div class="DataTables_sort_wrapper">
														Time
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 130px;">
													<div class="DataTables_sort_wrapper">
														Dish
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 102px;">
													<div class="DataTables_sort_wrapper">
														Quantity
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 70px;">
													<div class="DataTables_sort_wrapper">
														Price
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 111px;">
													<div class="DataTables_sort_wrapper">
														Customer
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
												  echo "";
												}															
											?>
											
											
											<tr class="gradeA even"> 
												<td class=" sorting_1"><?=$dataitem->order_date?></td> 
												<td><?=$dataitem->order_time?></td> 
												<td><?=$dataitem->name?></td> 
												<td class="center"><?=$dataitem->quantity?></td> 
												<td class="center">$<?=$dataitem->price?></td>
												<td class="center"><?=$dataitem->user_id?></td>											
											</tr>
											
											<? } ?>

										</tbody> 
									</table> 
																	
                            </div> 
							
							
							<header>
                            <h2>Resolved Orders</h2>
							</header>
							<div class="grid_6" "> 
                                
									
									<table class="display" id="queuetable"> 
										<thead> 
											<tr>
												<th class="ui-state-default" style="width: 114px;">
													<div class="DataTables_sort_wrapper">
														Date
														<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 85px;">
													<div class="DataTables_sort_wrapper">
														Time
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 130px;">
													<div class="DataTables_sort_wrapper">
														Dish
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 102px;">
													<div class="DataTables_sort_wrapper">
														Quantity
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 70px;">
													<div class="DataTables_sort_wrapper">
														Price
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												<th class="ui-state-default" style="width: 111px;">
													<div class="DataTables_sort_wrapper">
														Customer
														<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
													</div>
												</th>
												
											</tr>
										</thead> 
										<tbody> 
											
											<?php 
											foreach ($resolveSales as $dataitem){
																							
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
												  echo "";
												}															
											?>
											
											
											<tr class="gradeA even"> 
												<td class=" sorting_1"><?=$dataitem->order_date?></td> 
												<td><?=$dataitem->order_time?></td> 
												<td><?=$dataitem->name?></td> 
												<td class="center"><?=$dataitem->quantity?></td> 
												<td class="center">$<?=$dataitem->price?></td>
												<td class="center"><?=$dataitem->user_id?></td>											
											</tr>
											
											<? } ?>

										</tbody> 
									</table> 
																	
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


