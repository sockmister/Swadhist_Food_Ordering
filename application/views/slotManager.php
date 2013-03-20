
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
		loadSlot();
		//	loadOrder();
		});

	function loadSlot(){
		
		<?php for($i = 0; $i < count($slotQuota); $i++){?>
			document.getElementById("slot_<?=$i?>").value = '<?=$slotQuota[$i]->quantity ?>';
		<? } ?>
	}

	function updateSlot(){
			var slot_data = new Array();
		for(var i=0; i<48; i++){
			slot_data[i] = document.getElementById("slot_"+i).value;
		}
		
		$.ajax({
			url: "<?=site_url("stall_owner/updateSlot")?>",
			type: 'POST',
			data: {slot_data: slot_data},
			// callback handler that will be called on success
			success: function(data){
				//document.getElementById('haiz').innerHTML = data;
				
				alert("update success");
			}
		});
		
	}

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

				<section class="main-section grid_8">
					
					<nav class="collapsed">

                        <a class="chevron" href="#">&raquo;</a>

                        <ul>

                            <li class="current"><a href="<?=site_url("stall_owner/manageQueueSlot")?>" class="navicon-id-card">Slots</a></li>

                        </ul>

                    </nav>			
				
					 <div class="main-content">

						<header>

							<h2>Forms</h2>

						</header>
								
						<section class="container_6 clearfix">
						<!-- Main Section -->
							
							<!-- Forms Section -->
							<div class="grid_3">

								<div class="portlet">

									<header>

										<h2>Time: 0000-1200</h2>

									</header>

									<section>

										<form class="form has-validation">
										
											<div class="clearfix">

												<label for="form-name" class="form-label">0000 - 0030 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_0" name="name" required="required" value=""/></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0030 - 0100 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_1" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0100 - 0130 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_2" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0130 - 0200 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_3" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0200 - 0230 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_4" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0230 - 0300 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_5" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0300 - 0330 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_6" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0330 - 0400 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_7" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0400 - 0430 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_8" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0430 - 0500 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_9" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0500 - 0530 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_10" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0530 - 0600 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_11" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0600 - 0630 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_12" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0630 - 0700 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_13" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0700 - 0730 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_14" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0730 - 0800 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_15" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0800 - 0830 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_16" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">0830 - 0900 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_17" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0900 - 0930 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_18" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">0930 - 1000 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_19" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1000 - 1030 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_20" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1030 - 1100 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_21" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1100 - 1130 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_22" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1130 - 1200 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_23" name="name" required="required" /></div>

											</div>
											

										</form>

									</section>

								</div>

							</div>

							<!-- End Forms Section -->


                            <!-- Forms Section -->

                            <div class="grid_3">

                                <div class="portlet">

                                    <header>

                                        <h2>Time: 1200-2400</h2>

                                    </header>

                                    <section>

                                        <form class="form has-validation">
										
											<div class="clearfix">

												<label for="form-name" class="form-label">1200 - 1230 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_24" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1230 - 1300 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_25" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1300 - 1330 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_26" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1330 - 1400 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_27" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1400 - 1430 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_28" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1430 - 1500 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_29" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1500 - 1530 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_30" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1530 - 1600 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_31" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1600 - 1630 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_32" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1630 - 1700 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_33" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1700 - 1730 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_34" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1730 - 1800 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_35" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1800 - 1830 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_36" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1830 - 1900 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_37" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">1900 - 1930 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_38" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">1930 - 2000 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_39" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">2000 - 2030 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_40" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">2030 - 2100 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_41" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">2100 - 2130 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_42" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">2130 - 2200 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_43" name="name" required="required" /></div>

											</div>
										

                                           <div class="clearfix">

												<label for="form-name" class="form-label">2200 - 2230 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_44" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">2230 - 2300 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_45" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">2300 - 2330 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_46" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">2330 - 0000 <em>*</em><small>Enter number of quota</small></label>

												<div class="form-input"><input type="text" id="slot_47" name="name" required="required" /></div>

											</div>

                                        </form>

                                    </section>

                                </div>

                            </div>

                            <!-- End Forms Section -->
						<div class="form-action clearfix" align="middle" >	
							<button class="button" onclick="updateSlot()" data-icon-primary="ui-icon-circle-check" style="margin-top:10px">SAVE</button>
						</div>

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


