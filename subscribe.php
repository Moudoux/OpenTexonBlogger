<?php

	require_once('php/config.php');
	require_once('php/antixss.php');
	
	if (isxss($_GET['q'])) {
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	if (strpos($data,' ') !== false) {
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	if (strpos($data,'@') !== false) {
	} else {
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	function writefile($text,$loc) {
		$fp = fopen($loc,"wb");
		fwrite($fp,$text);
		fclose($fp);
	}
	
	$userEmail = $_GET['q'];
	
	$subscribeFolder = 'subscribers';

	$files = scandir($subscribeFolder.'/');
	
	$userExists = false;
	
	foreach($files as $file) {
		$pName = $file;
		$pName=str_replace($subscribeFolder.'/', '',$pName);
		
		$userEmailFile = $userEmail.'.token';
		
		if ($pName == $userEmailFile) {
			$userExists = true;
		}
		
	}	
	
	if ($userExists == false) {
		writefile($_SERVER['HTTP_CF_CONNECTING_IP'],$subscribeFolder.'/'.$userEmail.'.token');
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	

?>