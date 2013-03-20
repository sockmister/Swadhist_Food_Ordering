
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

		//	loadOrder();
		});
		
		function newDish(){
			$("#save_button span.ui-button-text").html("Save New Dish");
			//document.getElementById('save_button').innerHTML = "Save New Dish";
			document.getElementById('dish_name').value = "";
			document.getElementById('dish_price').value = "";
			document.getElementById('dish_image_link').value = "";
			document.getElementById('dish_description').value = "";
			document.getElementById('monday').value = "";
			document.getElementById('tuesday').value = "";
			document.getElementById('wednesday').value = "";
			document.getElementById('thursday').value = "";
			document.getElementById('friday').value = "";
			document.getElementById('saturday').value = "";
			document.getElementById('sunday').value = "";
			document.getElementById('save_button').onclick = function(){ saveNewDish();};
		}
		
		function saveNewDish(){
			alert("adding new dish");
				
			var dish_name = document.getElementById('dish_name').value;
			alert("onthe way");
			var dish_price = document.getElementById('dish_price').value;
			
			var dish_image_link = document.getElementById('dish_image_link').value;
			var dish_description = document.getElementById('dish_description').value;
			
			var days_checked = new Array();
			days_checked[0] = document.getElementById('monday').value;
			days_checked[1] = document.getElementById('tuesday').value;
			days_checked[2] = document.getElementById('wednesday').value;
			days_checked[3] = document.getElementById('thursday').value;
			days_checked[4] = document.getElementById('friday').value;
			days_checked[5] = document.getElementById('saturday').value;
			days_checked[6] = document.getElementById('sunday').value;	
			

			$.ajax({
					url: "<?=site_url("stall_owner/addDish")?>",
					type: 'POST',
					data: {days_checked:days_checked, dish_name:dish_name, dish_price:dish_price, dish_image_link:dish_image_link, dish_description:dish_description  },
					success: function(data){
						alert("add success");
						location.reload();
					}
				});
			
		}
		
		function updateMenu(id){
				
			var dish_name = document.getElementById('dish_name').value;
			var dish_price = document.getElementById('dish_price').value;		
			var dish_image_link = document.getElementById('dish_image_link').value;
			var dish_description = document.getElementById('dish_description').value;
		
			var days_checked = new Array();
			days_checked[0] = document.getElementById('monday').value;
			days_checked[1] = document.getElementById('tuesday').value;
			days_checked[2] = document.getElementById('wednesday').value;
			days_checked[3] = document.getElementById('thursday').value;
			days_checked[4] = document.getElementById('friday').value;
			days_checked[5] = document.getElementById('saturday').value;
			days_checked[6] = document.getElementById('sunday').value;	

			$.ajax({
					url: "<?=site_url("stall_owner/updateDish")?>",
					type: 'POST',
					data: {dish_id:id, days_checked:days_checked, dish_name:dish_name, dish_price:dish_price, dish_image_link:dish_image_link, dish_description:dish_description  },
					success: function(data){					
						alert(data);
					}
				});
		}

		var dishArray = new Array();
		<?php 
			foreach ($dishes as $dataitem){?>
			var dish = new Array("<?=$dataitem->name?>", "<?=$dataitem->price?>", "<?=$dataitem->img?>", "<?=$dataitem->description?>", "<?=$menuArray[$dataitem->id][0]?>", "<?=$menuArray[$dataitem->id][1]?>", "<?=$menuArray[$dataitem->id][2]?>", "<?=$menuArray[$dataitem->id][3]?>", "<?=$menuArray[$dataitem->id][4]?>", "<?=$menuArray[$dataitem->id][5]?>", "<?=$menuArray[$dataitem->id][6]?>");
			dishArray[<?=$dataitem->id?>] = dish;
		<? } ?>

	function loadDish(id){
		$("#save_button span.ui-button-text").html("Update Dish");
		//document.getElementById('save_button').innerHTML = "Update Dish";
		dish = dishArray[id];
		document.getElementById('dish_name').value = dish[0];
		document.getElementById('dish_price').value = dish[1];
		document.getElementById('dish_image_link').value = dish[2];
		document.getElementById('dish_description').value = dish[3];
		document.getElementById('save_button').onclick = function(){ updateMenu(id);};
		
		document.getElementById('monday').value = dish[4];
		document.getElementById('tuesday').value = dish[5];
		document.getElementById('wednesday').value = dish[6];
		document.getElementById('thursday').value = dish[7];
		document.getElementById('friday').value = dish[6];
		document.getElementById('saturday').value = dish[6];
		document.getElementById('sunday').value = dish[6];

	}

	function deleteDish(id){
		
		$.ajax({
					url: "<?=site_url("stall_owner/deleteDish")?>"+'/'+id,
					type: 'GET',
					// callback handler that will be called on success
					success: function(data){					
						alert("delete success");
						location.reload();
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

							<h2>Menu Manager</h2>

						</header>
								
						<section class="container_6 clearfix">
						<!-- Main Section -->
							
							<!-- Forms Section -->

							<div class="grid_3">	
								<table class="display" id="queuetable" > 
									<thead> 
										<tr>
											<th class="ui-state-default" style="width: 114px;">
												<div class="DataTables_sort_wrapper">
													Dish
													<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
												</div>
											</th>

											<th class="ui-state-default" style="width: 130px;">
												<div class="DataTables_sort_wrapper">
													Delete
													<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
												</div>
											</th>
										</tr>
									</thead> 
									<tbody> 
										
										<?php 
										foreach ($dishes as $dataitem){?>
																				
										<tr class="gradeA even"> 
											<td class=" sorting_1" onclick="loadDish('<?=$dataitem->id?>')"><?=$dataitem->name?></td> 								
											<td class="center"><input type="button" value="Delete" onclick="deleteDish('<?=$dataitem->id?>')"></td> 										
										</tr>
										
										<? } ?>

									</tbody> 
								</table> 
							</div>
							<!-- End Forms Section -->



                            <!-- Forms Section -->
							<div class="grid_3">

								<div class="portlet">

									<header>

										<h2>Dish Information</h2>

									</header>

									<section>

										<div class="form has-validation">
										
											<div class="clearfix">

												<label for="form-name" class="form-label">Dish name <em>*</em><small>Please enter name of dish</small></label>

												<div class="form-input"><input type="text" id="dish_name" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">Dish Price <em>*</em><small>Please enter price of dish</small></label>

												<div class="form-input"><input type="text" id="dish_price" name="name" required="required" /></div>

											</div>
											
											<div class="clearfix">

												<label for="form-name" class="form-label">Image Link <em>*</em><small>Please provide the link to image</small></label>

												<div class="form-input"><input type="text" id="dish_image_link" name="name" required="required" /></div>

											</div>

											<div class="clearfix">

												<label for="form-name" class="form-label">Description <em>*</em><small>Please provide a description of the dish</small></label>

												<div class="form-input"><textarea id ="dish_description" rows="4" cols="50" name="name" required="required"></textarea></div>

											</div>
											
											<div class="clearfix">
												
                                                <label for="form2-updates" class="form-label">Quantity<small>Enter quantity of dish available </small></label>
												
                                                <div class="form-input">
													<input type="text" id="monday" style="width:50px; margin-right:5px" />Monday<br>
													<input type="text" id="tuesday" style="width:50px; margin-right:5px" />Tuesday<br>
													<input type="text" id="wednesday" style="width:50px; margin-right:5px" />Wednesday<br>
													<input type="text" id="thursday" style="width:50px; margin-right:5px" />Thursday<br>
													<input type="text" id="friday" style="width:50px; margin-right:5px" />Friday<br>
													<input type="text" id="saturday" style="width:50px; margin-right:5px" />Saturday<br>
													<input type="text" id="sunday" style="width:50px; margin-right:5px" />Sunday<br>											
												
												</div>

                                            </div>
																			
										
											<div >

												<button class="button" id="save_button" onclick="saveNewDish()"  data-icon-primary="ui-icon-circle-check">Save New Dish</button>
												
												<button class="button" type="reset">Reset</button>
												
												<button class="button" id="new_dish_button" onclick="newDish()" style="float:right" >New Dish</button>

											</div>

										</div>

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


