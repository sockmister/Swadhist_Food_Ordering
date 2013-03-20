
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
		},700
	);
	
	function loadOrder() {
		loadPrepareOrder();
		loadCollectOrder();
	}
	
	function loadPrepareOrder() {
	
		$.ajax({
			url: "<?=site_url("stall_owner/pendingPrepareOrder")?>",
			type: "get",
			// callback handler that will be called on success
			success: function(data){
				// log a message to the console
				$("#orderArea1").html(data);
				$("#queuetable").dataTable({"sPaginationType": "full_numbers"});
				
				$('#queuetable_wrapper').prepend('<div id="testwrap1" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#queuetable_length').appendTo($('#testwrap1'));
				$('#queuetable_filter').appendTo($('#testwrap1'));
				
				$('#queuetable_wrapper').append('<div id="testwrapfooter1" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#queuetable_info').appendTo($('#testwrapfooter1'));
				$('#queuetable_paginate').appendTo($('#testwrapfooter1'));
								
			}
		});
			
	}
	
	function loadCollectOrder(){
		$.ajax({
			url: "<?=site_url("stall_owner/pendingCollectionOrder")?>",
			type: "get",
			// callback handler that will be called on success
			success: function(data){
				// log a message to the console
				$("#orderArea").html(data);
				$("#collectiontable").dataTable({"sPaginationType": "full_numbers"});
				
				$('#collectiontable_wrapper').prepend('<div id="testwrap" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#collectiontable_length').appendTo($('#testwrap'));
				$('#collectiontable_filter').appendTo($('#testwrap'));
				
				$('#collectiontable_wrapper').append('<div id="testwrapfooter" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>');
				$('#collectiontable_info').appendTo($('#testwrapfooter'));
				$('#collectiontable_paginate').appendTo($('#testwrapfooter'));
					
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

	function sendToOrderCompleted(orderID){
		$.ajax({
				url: "<?=site_url("stall_owner/orderCompleted")?>",
				type: 'GET',
				data: {orderID: orderID},
				// callback handler that will be called on success
				success: function(data){					
					loadOrder();
				}
			});

	}
	
	function sendToOrderIncomplete(orderID){
		$.ajax({
				url: "<?=site_url("stall_owner/orderIncomplete")?>",
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
                            <div class="grid_6" "> 
                                
								<div id="orderArea1">
									
								</div> 
                            </div> 
							
							<div> <p id="haiz"><br>.<br></p></div>
							
							<div class="grid_6"> 
								<div id="orderArea">
									
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


