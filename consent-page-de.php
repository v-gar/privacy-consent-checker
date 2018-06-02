<!DOCTYPE html>
<html>
	<head>
		<title>Datenschutzerkl&auml;rung einwilligen</title>
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
		<h1>Datenschutzerkl&auml;rung</h1>
		<p>Bitte lesen Sie die Datenschutzerkl&auml;rung f&uuml;r dieses
		Internetangebot. Zur weiteren Benutzung ist Ihre Einwilligung
		erforderlich.</p>
		
		<p style="text-align: center; font-style: italic;">
		    Gesamte Datenschutzerkl&auml;rung durchscrollen,
		    um Buttons zu aktivieren.
		</p>
		
		<div class="privacyinfo" id="privacyinfo">
		    <?php echo file_get_contents("privacy-statement.html"); ?>
		</div>
		<div class="consent-box">
		    <p>
		        <strong>Willigen Sie der Datenschutzerkl&auml;rung ein?</strong>
		    </p>
		    <form method="post" class="inner">
	            <input type="submit" name="consent" value="Ja" id="yes" />
		    </form>
		    <div class="inner">
		        <input type="submit" name="consent" value="Nein" id="no" />
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
