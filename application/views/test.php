<!DOCTYPE html> 
<html lang="en"> 
	<!-- HELLO  

    Don't worry, we're glad you're taking an interest in our code.

    We really take pride in our code, ensuring it's clean, semantic

    and search engine friendly.

    If you want to send us any feedback or would like your code to

    look like ours then email us at contact@nusprofectus.com. We're

    always happy to hear what people think of our website.
    
    -->
	<head> 
	<title>NUS Profectus</title>
	<!-- META -->
	
	
	
	<!-- CORE -->
	<script src="<?=ASSEST_URL?>js/jquery-1.7.1.min.js"></script>
	<script language="javascript">
	function load_data() {
		$.get('<?=site_url("general/hello")?>', function(data) {
  			$('#abc').html(data);
		});
	}
	</script>
	
</head> 
<body> 
<button onClick="load_data()">Hello</button>
<div id="abc">

</div>
</body>
</html>