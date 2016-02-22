<?php

	require_once('config.php');
	
	function getLang() {
		if (constant("Language_Auto") == "true") { 
			if (file_exists(constant("Website_Location").'/lang/'.$_SERVER["HTTP_CF_IPCOUNTRY"].'/language.php')) {
				return $_SERVER["HTTP_CF_IPCOUNTRY"];
			} else {
				return constant("Website_Language");
			}
		} else {
			return constant("Website_Language");
		}
	}
	
?>