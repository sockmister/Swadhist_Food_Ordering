<!DOCTYPE html>

<html lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>Change Password</title>
<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:extralight,light,regular,bold" media="screen" rel="stylesheet" type="text/css" >
<link href="http://fonts.googleapis.com/css?family=PT+Serif+Caption" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/reset.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/grid.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/style.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/ui/default-ui/ui.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/ui/default-ui/portlet.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/ui/default-ui/jquery.ui.uniform.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?=ASSEST_URL?>css/webapp/ui/default-ui/colors/jquery.ui.colors.default.css" media="screen" rel="stylesheet" type="text/css" class="uicolor" >
<link href="<?=ASSEST_URL?>css/webapp/forms.css" media="screen" rel="stylesheet" type="text/css" >
<!--[if lt IE 8]> <link href="<?=ASSEST_URL?>/css/webapp/ie.css" media="screen" rel="stylesheet" type="text/css" ><![endif]-->
<!--[if lt IE 9]> <script type="text/javascript" src="<?=ASSEST_URL?>/js/webapp/html5.js"></script><![endif]-->
<!--[if lt IE 9]> <script type="text/javascript" src="<?=ASSEST_URL?>/js/webapp/IE9.js"></script><![endif]-->
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/jquery.min.js"></script>
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?=ASSEST_URL?>js/webapp/global.js"></script>
<!--[if lt IE 9]> <script type="text/javascript" src="<?=ASSEST_URL?>/js/webapp/ie.js"></script><![endif]-->

<script> 

$(document).ready(function(){
    

    $.tools.validator.fn("#password", function(input, value) {

        return value!='Enter current password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	
    $.tools.validator.fn("#newpassword", function(input, value) {

        return value!='Enter new password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	// validate that both passwords are different
	$.tools.validator.fn("#newpassword", function(input, value) {
		
    	return value != $('#password').val() ? true : {
			
        	en: "Passwords are the same"
   	 	};
	});
	
	// validate password length
	$.tools.validator.fn("#newpassword", function(input, value) {
    	return value.length >= 6 ? true : {
			
        	en: "Password must be at least 6 characters long"
   	 	};
	});
	
	
    var form = $("#form").validator({ 

    	position: 'bottom right', 

    	offset: [-30, 5],

    	messageClass:'form-error',

    	message: '<div><em/></div>' // em element is the arrow

    }).attr('novalidate', 'novalidate');

});

</script> 



<!-- LOADING SCRIPT -->

<script>

$(window).load(function(){

    $("#loading").fadeOut(function(){

        $(this).remove();

        $('body').css('overflow', 'auto');

    });

});

</script>



<style type = "text/css">

    body{overflow: hidden;}

    #container {position: absolute; top:50%; left:50%;}

    #content {width:800px; text-align:center; margin-left: -400px; height:50px; margin-top:-25px; line-height: 50px;}

    #content {font-family: "Helvetica", "Arial", sans-serif; font-size: 18px; color: black; text-shadow: 0px 1px 0px white; }

    #loadinggraphic {margin-right: 0.2em; margin-bottom:-2px;}

    #loading {background-color: #eeeeee; overflow:hidden; width:100%; height:100%; position: absolute; top: 0; left: 0; z-index: 9999;}

</style> 

<!-- LOADING SCRIPT END -->



</head>

<body class="login">

    <div id="loading"> 

        <script type = "text/javascript"> 

            document.write("<div id='container'><p id='content'>" +

                           "<img id='loadinggraphic' width='16' height='16' src='<?=ASSEST_URL?>images/webapp/ajax-loader-eeeeee.gif' /> " +

                           "Loading...</p></div>");

        </script> 

    </div> 



    <div class="login-box main-content">

      <header>

          <ul class="action-buttons clearfix">

			<li><a href="<?php echo site_url("stall_owner/getStallOrder")?>" class="button" data-icon-primary="ui-icon-info">Back to Dashboard</a></li>

          </ul>

          <h2>Change Password</h2>

      </header>

    	<section>

    		<div class="ui-widget message notice">

                <div class="ui-state-highlight ui-corner-all">

                    <p>

                    <span class="ui-icon ui-icon-info"></span>
						
                        <?php if (!empty($result)) {
									echo $result;
								}
						?>
                    </p>

                </div>

            </div>

    		<form id="form" action="<?php echo site_url("stall_owner_update/change_password")?>" method="post" class="clearfix">

                <p>
                    <input type="password" id="password" class="large" value="" name="password" required placeholder="Enter current password" />
				</p>
                <p>
                    <input type="password" id="newpassword" class="large" value="" name="newpassword" required placeholder="Enter new password" />
				</p>
                <p>	
                    <button class="large button-gray ui-corner-all fr" type="submit">Change</button>
                </p>

                <!--<p class="clearfix">

                    <span class="fl">

                        <input type="checkbox" id="remember" class="" value="1" name="remember"/>

                        <label class="choice" for="remember">Keep me logged-in for two weeks</label>

                    </span>

                </p>
				-->
            </form>

    	</section>

    </div>

</body>

</html>