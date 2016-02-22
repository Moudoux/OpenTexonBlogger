<?php require_once('sendmail.php');

require_once('php/config.php');

function writefile($text,$loc) {
		$fp = fopen($loc,"wb");
		fwrite($fp,$text);
		fclose($fp);
}

function createuser($n,$desc,$user,$gmail) {

	// Anti XSS check
	if (isxss($n)) {
		die;
	}
	
	if (isxss($desc)) {
		die;
	}
	
	if (isxss($gmail)) {
		die;
	}
	
	if (isxss($user)) {
		die;
	}
	

	$i = md5(uniqid(rand(), true));
	$lkey = md5(uniqid(rand(), true));
	$v = md5(uniqid(rand(), true));
	$pwtoken = md5(uniqid(rand(), true));
	$mydate=getdate(date("U"));
	
	$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	$usercountry = $_SERVER["HTTP_CF_IPCOUNTRY"];
	
	$gettodaydate = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	
	$file = constant("Website_Location")."profiles/".$n.".php";
	$file_contents = file_get_contents($file);
	$functionname = 'getposts'.$n;
	
	$fh = fopen($file, "at");
	fwrite($fh, '<?php'."\n");
	fwrite($fh, '	$id = "'.$i.'";'."\n");
	fwrite($fh, '	$name = "'.$user.'";'."\n");
	fwrite($fh, '	$description = "'.$desc.'";'."\n");
	fwrite($fh, '	$valid = "false";'."\n");
	fwrite($fh, '	$validateCode = "'.$v.'";'."\n");
	
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/data/installed.token') == false) {
		fwrite($fh, '	$admin = "true";'."\n");
	} else {
		fwrite($fh, '	$admin = "false";'."\n");
	}
	
	fwrite($fh, '	$username = "'.$n.'";'."\n");
	fwrite($fh, '	$country = "'.$usercountry.'";'."\n");
	fwrite($fh, '	$functionname = "'.$functionname.'";'."\n");
	fwrite($fh, '	$joindate = "'.$gettodaydate.'";'."\n");
	fwrite($fh, '	function getposts'.$n.'() {'."\n");
	fwrite($fh, '		echo <<<END'."\n");
	fwrite($fh, '		<p>No recent posts</p>'."\n");
	fwrite($fh, 'END;'."\n");
	fwrite($fh, '	}'."\n");
	fwrite($fh, '	$ipaddress = "'.$ip.'";'."\n");
	fwrite($fh, '	$email = "'.$gmail.'";'."\n");
	fwrite($fh, '?>');
	fclose($fh);

	mkdir(constant("Website_Location")."profiles/".$n);
	
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/data/installed.token') == false) {
		writefile('true',constant("Website_Location")."profiles/".$n.'/admin');
	} else {
		writefile('false',constant("Website_Location")."profiles/".$n.'/admin');
	}
	
	
	
	writefile($pwtoken,constant("Website_Location")."profiles/".$n.'.token');
	writefile($lkey,constant("Website_Location")."profiles/".$n.'/lkey.token');
	$subject = "Welcome to OpenTexon";
	$body = "Welcome to ".constant("Website_Name")."!\nYour username is: ".$n."\n"."Please activate your account here: https://opentexon.com/activate?id=".$n."\n"."Thank you for using OpenTexon.";
	
	$bodyadmin = "A new user named: ".$user." has registerd\nUsername is: ".$n."\nUser ip: ".$ip."\nEmail: ".$gmail."\nUser description: ".$desc;
	
	sendamail($gmail,$subject,$body);
	
	sendamail(constant("Website_Server_Admin"),'New user on '.constant("Website_Name"),$bodyadmin);
	
	writefile("installed",$_SERVER['DOCUMENT_ROOT'].'/data/installed.token');
	
	return $i;
	
}

?>