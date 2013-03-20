
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
		
		loadOrder();
	});

	var auto_refresh = setInterval(
		function refreshTables() {		
			 loadOrder();		
		},5000
	);
	
	function loadOrder() {
		loadIncompleteOrder();
		loadBlackList();
	}
	
	function loadBlackList() {
	
		$.ajax({
			url: "<?=site_url("stall_owner/ajaxBlacklist")?>",
			type: "get",
			// callback handler that will be called on success
			success: function(data){
				// log a message to the console
				$("#orderArea1").html(data);
				$("#blacklisttable").dataTable({"sPaginationType": "full_numbers"});
				
				$('#blacklisttable_wrapper').prepend('<div id="testwrap1" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#blacklisttable_length').appendTo($('#testwrap1'));
				$('#blacklisttable_filter').appendTo($('#testwrap1'));
				
				$('#blacklisttable_wrapper').append('<div id="testwrapfooter1" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#blacklisttable_info').appendTo($('#testwrapfooter1'));
				$('#blacklisttable_paginate').appendTo($('#testwrapfooter1'));
								
			}
		});
			
	}
	
	function loadIncompleteOrder(){
		$.ajax({
			url: "<?=site_url("stall_owner/ajaxIncomplete")?>",
			type: "get",
			// callback handler that will be called on success
			success: function(data){
				// log a message to the console
				$("#orderArea").html(data);
				$("#incompletetable").dataTable({"sPaginationType": "full_numbers"});
				
				$('#incompletetable_wrapper').prepend('<div id="testwrap" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#incompletetable_length').appendTo($('#testwrap'));
				$('#incompletetable_filter').appendTo($('#testwrap'));
				
				$('#incompletetable_wrapper').append('<div id="testwrapfooter" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#incompletetable_info').appendTo($('#testwrapfooter'));
				$('#incompletetable_paginate').appendTo($('#testwrapfooter'));
				
				//$('#collectiontable_length').empty();
				//$('#collectiontable_length').append('Show <div class="selector"><span style="-moz-user-select: none;">10</span><select name="collectiontable_length" size="1" style="opacity: 0;"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div> entries');		
				
				//$('#collectiontable_wrapper').append('<div id="testwrapfooter" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				//$('#collectiontable_info').appendTo($('#testwrapfooter'));
				//$('#testwrapfooter').append('<div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers" id="example_paginate"><span class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled" id="example_first">First</span><span class="previous fg-button ui-button ui-state-default ui-state-disabled" id="example_previous">Previous</span><span><span class="fg-button ui-button ui-state-default ui-state-disabled">1</span></span><span class="next fg-button ui-button ui-state-default ui-state-disabled" id="example_next">Next</span><span class="last ui-corner-tr ui-corner-br fg-button ui-button ui-state-default ui-state-disabled" id="example_last">Last</span></div>');
				
			}
		});
	}
	
	
	function sendToCollect(orderID){

		$.ajax({
				url: "<?=site_url("stall_owner/readyToCollect")?>",
				type: 'GET',
				data: {orderID: orderID},
				// callback handler that will be called on success
				success: function(data){
					//document.getElementById('haiz').innerHTML = data;
					loadOrder();
				}
			});

	}

	function sendToOrderIncompleted(orderID){

		$.ajax({
				url: "<?=site_url("stall_owner/orderComplete")?>",
				type: 'GET',
				data: {orderID: orderID},
				// callback handler that will be called on success
				success: function(data){					
					loadOrder();
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



                <!-- Main Section -->



                <section class="main-section grid_8">
                    <nav class="collapsed">
                        <a class="chevron" href="#">&raquo;</a>
                        <ul>
                            <li class="current"><a href="<?=site_url("stall_owner/getStallOrder")?>" class="navicon-folder-open">Ongoing</a></li>
                            <li><a href="<?=site_url("stall_owner/getCollectedOrder")?>" class="navicon-id-card">Completed</a></li>

                        </ul>
                    </nav>

                    <div class="main-content">
                        <header>
                            <h2>Queue Manager</h2>
                        </header>
                        
                        <section class="container_6 clearfix">
                            <div class="grid_6" > 
                                
								<div id="orderArea">
									
								</div> 
                            </div> 
							
							<div> <p id="haiz"><br>.<br></p></div>
							
							<div class="grid_6"> 
								<div id="orderArea1">
									
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


