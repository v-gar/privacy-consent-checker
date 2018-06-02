<?php
/*
    PHP Consent Checker
    
    Due to the new GDPR regulations it's possible that the consent for the
    privacy statement is required.
    
    This is a way to ask the user for consent before entering the page.
    
    ----
    
    MIT License

    Copyright (c) 2018 Viktor Garske (info@v-gar.de)

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
*/

/* detect domain and set $DOMAIN to the second-level domain */
$domainparts = array_map('strrev', 
    explode(".", strrev($_SERVER['HTTP_HOST'])));

if (sizeof($domainparts) >= 2) {
    $workingDomain = implode(".", 
        array_reverse(array_slice($domainparts, 0, 2)));

    $DOMAIN = $workingDomain;
} else {
    $DOMAIN = $_SERVER['HTTP_HOST'];
}

/* consentNeeded: whether the consent isn't already given
    true:   show consent message
    false:  return to normal script execution */
$consentNeeded = true;

/* process the form and enable the consent cookie when cons. given */
if (isset($_POST['consent'])) {
	if ($_POST['consent'] == "Ja" || $_POST['consent'] == "Yes") {
		setcookie('consent', 'true', time() + 4*7*24*60*60, '/', 
		$DOMAIN, false);
		echo "<meta http-equiv='refresh' content='0' />";
		exit();
	}
}

/* if consent already given (cookie) disable message*/
if (isset($_COOKIE['consent']))
	$consentNeeded = false;

/* don't disturb the web crawlers with the consent message */
if (isset($_SERVER['HTTP_USER_AGENT']) && 
	preg_match('/bot|crawl|slurp|spider|mediapartners/i',
	$_SERVER['HTTP_USER_AGENT']))
	$consentNeeded = false;

/* don't disturb the feed readers and amp processors with
   a consent msg */
if (preg_match('/feed|amp/i', $_SERVER['REQUEST_URI']))
    $consentNeeded = false;

/* if ?removeconsent is passed, remove the given consent 
   and all other cookies */
if (isset($_GET['removeconsent'])) {
    $consentNeeded = true;
    
    /* unset all former cookies for this page */
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', 1);
            setcookie($name, '', 1, '/');
            setcookie($name, '', 1, '/', $DOMAIN);
        }
    }
    
    echo "<meta http-equiv='refresh' content='0; URL=./' />";
    exit();
}

/* when consentNeeded (default) */
if ($consentNeeded) {
    /* unset all former cookies for this page */
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', 1);
            setcookie($name, '', 1, '/');
            setcookie($name, '', 1, '/', $DOMAIN);
        }
    }
    
    /* load the (localized) consent form */
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if (isset($_GET['lang']))
        $lang = substr($_GET['lang'], 0, 2);
    switch ($lang) {
        case "de":
            require "consent-page-de.php";
            break;
        default:
            require "consent-page-en.php";
            break;
    }
	
	
	/* stop everything after this statement to ensure only
	   the consent message is loaded */
    exit();
}
?>
