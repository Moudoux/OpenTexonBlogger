<?php
	if (strpos($_SERVER['REQUEST_URI'],'.php')) {
		$str = $_SERVER['REQUEST_URI'];
		$str=str_replace(".php", "",$str);
		header('Location: '.constant("Website_Url").$str);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Website is on maintenance mode</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noarchive" />
	<link rel="shortcut icon" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/error_pages/favicon.png" />

	<style type="text/css">
	body {
		background: url(background.jpg);
		font-family: Helvetica, arial, sans-serif;
		color: #ccc;
	}
	.alert-container {
		background: url(textbox.png);
		width: 918px;
		height: 142px;
		margin: 82px auto 0px;
	}
	.alert-inner {
		padding: 24px 0px 0px 209px;
	}
	.alert-heading {
		font-size: 50px;
		font-weight: bold;
		line-height: 50px;
	}
	.alert-subheading {
		margin-top: 8px;
		font-size: 28px;
		line-height: 28px;
	}
	.redirect {
		width: 918px;
		margin: 24px auto 0px;
		font-size: 14px;
		line-height: 14px;
		text-align: center;
	}
	.redirect a {
		color: #ffb300;
		text-decoration: none;
	}
	</style>
</head>
<body>
	<div class="alert-container">
		<div class="alert-inner">
			<div class="alert-heading">Website is on maintenance</div>
			<div class="alert-subheading">Expected to be up <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php'); echo constant("Website_Maintaince"); ?></div>
		</div>
	</div>
	<div class="redirect">Please contact server admin at <a href="mailto:<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php'); echo constant("Website_Server_Admin"); ?>"><?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php'); echo constant("Website_Server_Admin"); ?></a> for any questions.</div>
</body>
</html>
