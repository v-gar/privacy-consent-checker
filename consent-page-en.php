<!DOCTYPE html>
<html>
	<head>
		<title>Privacy statement</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<style>
		    body {
		        font-family: "Arial", sans-serif;
		    }
		    div.privacyinfo {
		        max-width: 90%;
		        height: 400px;
		        border: 1px solid black;
		        overflow-y: scroll;
		        overflow-x: auto;
		        padding: 4px;
		        margin: auto;
		    }
		    div.consent-box {
		        margin-top: 10px;
		        text-align: center;
		    }
		    #yes {
		        background-color: green;
		        color: white;
		        padding: 6px;
		        border: none;
		        width: 100px;
		        height: 60px;
		        margin-bottom: 2px;
		        font-size: 18pt;
		    }
		    #no {
		        background-color: red;
		        color: white;
		        padding: 6px;
		        border: none;
		        width: 100px;
		        height: 60px;
		        font-size: 18pt;
		    }
		    .inner {
		        display: inline-block;
		    }
		</style>
	</head>
	<body>
		<h1>Privacy statement</h1>
		<p>Please read the privacy statement for this homepage.
		You need to give consent for this statement in order
		to use the homepage.</p>
		
		<p style="text-align: center; font-style: italic;">
		    Please scroll through the whole privacy statement
		    to activate the buttons.
		</p>
		
		<div class="privacyinfo" id="privacyinfo">
		    <?php echo file_get_contents("privacy-statement.html"); ?>
		</div>
		<div class="consent-box">
		    <p>
		        <strong>Do you accept this privacy statement?</strong>
		    </p>
		    <form method="post" class="inner">
	            <input type="submit" name="consent" value="Yes" id="yes" />
		    </form>
		    <div class="inner">
		        <input type="submit" name="consent" value="No" id="no" />
	        </div>
		</div>
		
		<script>
		    // Set variables for elements
		    var yes = document.getElementById("yes");
		    var no = document.getElementById("no");
		    var privacyinfo = document.getElementById("privacyinfo");
		    var height = window.innerHeight;
		    
		    // Disable buttons after loading
		    yes.disabled = true;
		    no.disabled = true;
		    
		    yes.style['background-color'] = 'grey';
		    no.style['background-color'] = 'grey';
		    
		    // Button link when cancelling
		    no.addEventListener("click", function() {
	            window.location.href = 'https://www.datenschutz-mv.de/';
		    }, false);
		    
		    // Enable buttons scrolled through privacy statement
		    privacyinfo.addEventListener("scroll", function() {
		        if (privacyinfo.scrollTop >= (privacyinfo.scrollHeight - privacyinfo.offsetHeight)) {
		            yes.disabled = false;
		            no.disabled = false;
		            yes.style['background-color'] = 'green';
		            no.style['background-color'] = 'red';
	            }
		    }, false);
		    
		    // better formatting for different display sizes
		    privacyinfo.style["height"] = height * 0.5 + "px";
		</script>
	</body>
</html>
