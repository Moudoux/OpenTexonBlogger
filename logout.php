<?php
	require_once('php/config.php');
	checkPage();
?>
<?php 
	require_once('php/account_system.php');
	logoutUser();
	header('Location: '.$_GET['url']);
?>	