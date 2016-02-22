<?php

session_start();

require_once('antixss.php');
require_once('config.php');

function registerUser($user,$pass1,$pass2,$desc,$fullname,$gmail){
	$errorText = '';
	
	$xss = false;
	
	if (isxss($user)) {
		$xss = true;
	}
	
	if (isxss($pass1)) {
		$xss = true;
	}
	
	if (isxss($pass2)) {
		$xss = true;
	}
	
	if (isxss($desc)) {
		$xss = true;
	}
	
	if (isxss($fullname)) {
		$xss = true;
	}
	
	if (isxss($gmail)) {
		$xss = true;
	}
	
	if ($xss) {
		$errorText = "Input fields contains illegal characters!";
	} else {
	// Check passwords
	if ($pass1 != $pass2) $errorText = "Passwords are not identical!";
	elseif (strlen($pass1) < 6) $errorText = "Password is to short!";
	
	// Check user existance	
	$pfile = fopen(constant("Website_Data_dir")."userpwd.txt","a+");
    rewind($pfile);
	
    while (!feof($pfile)) {
        $line = fgets($pfile);
        $tmp = explode(':', $line);
        if ($tmp[0] == $user) {
            $errorText = "The selected user name is taken!";
            break;
        }
    }	
	}
	
	$redirect = "";
	
	$blockedUsernames = 'fuck cunt whore dick penis vagina murder';
	
	if (strpos(strtolower($blockedUsernames),strtolower($user)) !== false) {
		$errorText = "No inappropriate usernames is allowed!";
	}
	
    // If everything is OK -> store user data
    if ($errorText == ''){
		
		// Secure password string
		$userpass = crypt($pass1, '$6$rounds=5000$'.$user.'$');
    	
		fwrite($pfile, "\r\n$user:$userpass");

		require_once('users.php');

		$userid = createuser($user,$desc,$fullname,$gmail);
		
		$filename = "accountLogger.txt";
	
		$LogFileLocation = constant("Website_Data_dir") . $filename;
	
		$fh = fopen($LogFileLocation,'at');
		fwrite($fh,"opentexon.com ".date('d M y H:i:s')."\t".$_SERVER['REMOTE_ADDR']."\t"."New account: ".$user."\n");
		fclose($fh);
		
		$_SESSION['validUser'] = true;
		$_SESSION['userName'] = $user;
	
		// Get the user ip address by bypassing CloudFlare
		$redirect = "/profile?id=".$user;
	
		fclose($pfile);
	
		
	
    } else {
		if ($xss) {
			
		} else {
					fclose($pfile);
		}

	}
	
	return $errorText;
}

function authUser($user,$pass){
	$validUser = false;
	
	
	
	$xss = false;
	
	if (isxss($user)) {
		$xss = true;
	}
	
	if (isxss($pass)) {
		$xss = true;
	}
	
	if ($xss) {
		
	} else {
	
	// Check user existance	
	$pfile = fopen(constant("Website_Data_dir")."userpwd.txt","r");
    rewind($pfile);

    while (!feof($pfile)) {
        $line = fgets($pfile);
        $tmp = explode(':', $line);
        if ($tmp[0] == $user) {
            // User exists, check password
            if (trim($tmp[1]) == trim(crypt($pass, '$6$rounds=5000$'.$user.'$'))){
            	$validUser= true;
            }
            break;
        }
    }
    fclose($pfile);

	}
	
	return $validUser;	
}

function getUsername() {
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		echo $_SESSION['userName'];
	} else {
  		echo "";
    }
}

function isAdminUser() {
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		return 'false';
	} else {
		if ($_SESSION['admin'] == 'true') {
			return 'true';
		}
	}
}

function loginUser($user,$pass){
	$errorText = '';
	$validUser = false;
	
	
	
	$xss = false;
	
	if (isxss($user)) {
		$xss = true;
	}
	
	if (isxss($pass)) {
		$xss = true;
	}
	
	if ($xss) {
		$errorText = "Input fields contains illegal characters!";
	} else {
		// Check user existance	
	$pfile = fopen(constant("Website_Data_dir")."userpwd.txt","r");
    rewind($pfile);

    while (!feof($pfile)) {
        $line = fgets($pfile);
        $tmp = explode(':', $line);
        if ($tmp[0] == $user) {
            // User exists, check password
            if (trim($tmp[1]) == trim(crypt($pass, '$6$rounds=5000$'.$user.'$'))){
            	$validUser= true;
            	$_SESSION['userName'] = $user;
            }
            break;
        }
    }
    fclose($pfile);

    if ($validUser != true) $errorText = "Invalid username or password!";
    
    if ($validUser == true) $_SESSION['validUser'] = true;
    else $_SESSION['validUser'] = false;
	
    if ($_SESSION['validUser'] == true) {
	$filename = "accountLogger.txt";

	$LogFileLocation = constant("Website_Data_dir") . $filename;

	$fh = fopen($LogFileLocation,'at');
	fwrite($fh,"opentexon.com ".date('d M y H:i:s')."\t".$_SERVER['REMOTE_ADDR']."\t"."Logged in: ".$_SESSION['userName']."\n");
	fclose($fh);
	
    }
	}

	
	
	return $errorText;	
}

function logoutUser(){
	unset($_SESSION['validUser']);
	unset($_SESSION['userName']);
}

function getUserLoginLogutLink(){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		echo "login";
	} else {
  		echo "logout";
    }
}

function loginCheck($page){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		header('Location: login?url='.$page);
	}
}

function projectsLoginCheck(){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		header('Location: login?url=projects');
	}
}

function hireusLoginCheck(){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		header('Location: login?url=hireus');
	}
}

function getPageHits() {
	$handle = fopen("/var/opentexon/counter.txt", "r");
	$counter = (int ) fread($handle,20);
	fclose ($handle);
	return strval($counter);
}

function loginMan($url){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		header('Location: /login?url='.$url);
	} else {
		header('Location: /logout?url='.$url);
	}
}

function getAccountLink() {
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		return "login";
	} else {
  		return "profile?id=".$_SESSION['userName'];
    }
}

function isLoggedIn() {
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		return "false";
	} else {
  		return "true";
    }
}

function checkUser(){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		return "Login";
	} else {
  		return "Logout";
    }
}

?>