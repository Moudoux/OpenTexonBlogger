<?php
	
	/**
		Attention!, This software only works with Linux/Mac NOT Windows
	**/

	require_once('account_system.php');

	// General settings
	define("Website_Url","https://example.com");
	define("Website_Name","Company");
	define("Website_Copyright","Copyright &copy; ".constant("Website_Name")." 2014-".date("Y")." All Rights Reserved<br>Powered by the <a href='https://opentexon.com/blog'>OpenTexon Blog Platform</a> | <a href='terms'>Terms & Conditions</a>");
	define("Website_Lockdown","false");
	define("Excpetions_IP_Addresses","");
	define("Blocker_Blocked_IPS","");
	define("Blocker_Blocked_Countries","");
	define("Excpetions_IP_Ignore_Log","");
	define("Website_Server_Admin","webadminexample@gmail.com");
	define("Website_Maintaince","Some date");
	define("Website_Article_CanPost","false");
	define("Website_Language","EN");
	define("Language_Auto","false");
	define("Website_Allow_Register","true");
	define("Website_Require_Login","false");
	define("Security_EmailLoginVerification","true");
	define("Block_AdBlock","false");
	
	// Email server settings
	define("Email_Username","");
	define("Email_Password","");
	define("Email_Host","");
	define("Email_Port","");
	
	// Location settings
	define("Logger_Dir","/var/wwwlogs/");
	define("Website_Data_dir","/var/example/");
	define("Website_Location","/var/www/example.com/");
	
	// Website software information (Do not change)
	define("Website_Version","0.0.3");
	
	// Update settigns
	define("Update_LookForUpdates","true");
	
	// Social media Links
	define("Social_Facebook","");
	define("Social_Twitter","");
	define("Social_GPlus","");
	define("Social_YouTube","");
	define("Social_LinkedIn","");
	define("Social_Dribbble","");
	
	// Website info (Don't change this)
	define("Website_Build_Date",file_get_contents('data/build_date.token'));
	
	// Functions
	
	function AdblockCheck() {
		if (constant("Block_AdBlock")) == "true") {
			echo <<<END
				<script src="js/fuckadblock.js"></script>
				<script>
					function adBlockDetected() {
						
					}
		
					if(typeof fuckAdBlock === 'undefined') {
						adBlockDetected();
					} else {
						fuckAdBlock.setOption({ debug: true });
						fuckAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
					}
				</script>
END;
		}
	}
	
    	// Check if .htaccess is working

    	function _checkHtaccess() {
		if (strpos($_SERVER['REQUEST_URI'],'.php')) {
			header('Location: /error_pages/enable_htaccess.html');
		}
	 }

	// Check if they have to login 

	function _loginCheck() {
		if (constant("Website_Require_Login") == "true") {
			if (isPageActive('login') == false) {
				if (isPageActive('register') == false) {
					if ($_SESSION['userName'] == '') {
						header('Location: '.constant("Website_Url").'/login?url='.constant("Website_Url").$_SERVER['REQUEST_URI']);	
					}
				}
			}
		}
	}

	// Check for updates
	
	function CheckForUpdates() {
		$version = file_get_contents('https://update.opentexon.com/blog/version.php');
		if ($version != constant("Website_Version")) {
			if (constant("Update_LookForUpdates") == "true") {
				header('Location: https://opentexon.com/blog?ref=update');
			}
		}
	}
	
	// Check if the user agent is a bot
	
	function _bot_detected() {

		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
			return TRUE;
		} else {
			return FALSE;
		}

	}
	
	// Log ip to database
	
	function logIp() {
		if (_bot_detected()) {
			return;
		}
	
		$load = sys_getloadavg();

		$ignoreIpAddresses = constant("Excpetions_IP_Ignore_Log");
	
		// Check if the client user is ignored
		if (strpos($ignoreIpAddresses, $_SERVER['HTTP_CF_CONNECTING_IP']) !== false) {
			return;
		}
	
		$filename = date('d-M-y') . ".txt";

		$LogFileLocation = constant("Logger_Dir").$filename;

		$useragent = $_SERVER['HTTP_USER_AGENT'];

		$fh = fopen($LogFileLocation,'at');
		fwrite($fh,date('d M y H:i:s')."\t".$_SERVER['HTTP_CF_CONNECTING_IP']."\t".$_SERVER["HTTP_CF_IPCOUNTRY"]."\t".$_SERVER['REQUEST_URI']."\t".'<span style="color: #009F6A;">'.$load[0].'</span>'."\t".$useragent."\n");
		fclose($fh);

		$handle = fopen(constant("Website_Data_dir")."counter.txt", "r");
		$counter = (int ) fread($handle,20);
		fclose ($handle);
		$counter++;
		$save = fopen(constant("Website_Data_dir")."counter.txt", "w" );
		fwrite($save,$counter);
		fclose ($save);
	}
	
	// Check if a page is active
	
	function isPageActive($pName) {
		if (strpos($_SERVER['REQUEST_URI'],'/'.$pName) !== false) {
			return true;
		} else {
			return false;
		}
	}
	
	// Make sure The OpenTexon Blogger Is installed
	
	function CheckInstallation() {
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/data/installed.token') == false) {
			if (isPageActive('install') == false) {
				if (isPageActive('register?ref=install') == false) {
					header('Location: '.'/install.php');
				}
			}
		}
	}
	
	// Page check
	
	function checkPage() {

		$userip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$usercountry = $_SERVER["HTTP_CF_IPCOUNTRY"];
		if (strpos($_SERVER['REQUEST_URI'],'.php')) {
			$str = $_SERVER['REQUEST_URI'];
			$str=str_replace(".php", "",$str);
			header('Location: '.constant("Website_Url").$str);
			return;
		}
		
		_checkHtaccess();

		_loginCheck();
		CheckInstallation();

		if (constant("Website_Lockdown") == "true") {
			if (strpos(constant("Excpetions_IP_Addresses"),$userip) !== false) {
			
			} else {
				header('Location: '.constant("Website_Url")."/error_pages/maintenance");
			}
		}
		if (strpos(constant("Blocker_Blocked_IPS"),$userip) !== false) {
			header('Location: '.constant("Website_Url")."/error_pages/blocked");
		}
		if (strpos(constant("Blocker_Blocked_Countries"),$usercountry) !== false) {
			header('Location: '.constant("Website_Url")."/error_pages/blocked_country");
		}
		if (file_get_contents("http://www.shroomery.org/ythan/proxycheck.php?ip=".$userip) == "Y") {
			header('Location: '.constant("Website_Url")."/error_pages/blocked_malicious");
		}

		logIp();
		CheckForUpdates();
	}
	
?>
