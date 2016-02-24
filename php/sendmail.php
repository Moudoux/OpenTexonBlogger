<?php require_once('antixss.php');

require_once('config.php');

function sendamail($to,$subject,$body) {

	// Anti XSS check
	if (isxss($to)) {
		die;
	}

	if (isxss($subject)) {
		die;
	}
	
	if (isxss($body)) {
		die;
	}
	
	try {
		require_once('/usr/share/php/Mail.php');
	
		$from = constant("Email_Username");
	
		$host = constant("Email_Host");
		$port = constant("Email_Port");
		$username = constant("Email_Username");
		$password = constant("Email_Password");
	
		$headers = array ('debug' => true,
			'From' => $from,
			'To' => $to,
			'Subject' => $subject);
	
		$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
	
		$mail = $smtp->send($to, $headers, $body);
	
		if (PEAR::isError($mail)) {
			echo("<p>" . $mail->getMessage() . "</p>");
		}
	
	} catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
}
function sendamailwithmail($to,$subject,$body,$username) {
	
	// Anti XSS check
	if (isxss($to)) {
		die;
	}

	if (isxss($subject)) {
		die;
	}
	
	if (isxss($body)) {
		die;
	}
	
	try {
		require_once('/usr/share/php/Mail.php');
	
		$from = constant("Email_Username");
	
		$host = constant("Email_Host");
		$port = constant("Email_Port");
		$username = constant("Email_Username");
		$password = constant("Email_Password");
	
		$headers = array ('debug' => true,
			'From' => $from,
			'To' => $to,
			'Subject' => $subject);
	
		$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
	
		$mail = $smtp->send($to, $headers, $body);
	
		if (PEAR::isError($mail)) {
			echo("<p>" . $mail->getMessage() . "</p>");
		} else {
			echo("<p>Message successfully sent!</p>");
		}
	
	} catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
}
?>
