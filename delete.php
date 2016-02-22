<?php
	require_once('php/config.php');
	checkPage();
?>
<?php

	require_once('php/config.php');
	require_once('php/account_system.php');

	if ($_GET['type'] != '' && $_GET['type'] == 'comment') {

		
		$fileFound = true;
		$postDir = 'posts';
		
		$dirS = 'posts/'.$_GET['id'];				
							
		if (file_exists($dirS.'/date')) {
		} else {
			$postDir = "projects";
		}
		
		if (file_exists('projects/'.$_GET['id'].'/date')) {
		} else {
			if (file_exists($dirS.'/date')) {
			} else {
				$fileFound = false;
			}
		}
		
		if ($fileFound) {
			
			$author = file_get_contents($postDir.'/'.$_GET['id'].'/comments/'.$_GET['cid'].'/author');
			
			if ($_SESSION['userName'] != '') {
				if ($_SESSION['userName'] == $author) {
					
					$deletePath = $postDir.'/'.$_GET['id'].'/comments/'.$_GET['cid'];
					system("rm -rf ".escapeshellarg($deletePath));
					$deletePath = 'profiles/'.$author.'/comments/'.$_GET['cid'];
					system("rm -rf ".escapeshellarg($deletePath));
					
					header('Location: '.constant("Website_Url").'/article?id='.$_GET['id']);
				} else {
					if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
						
						$deletePath = $postDir.'/'.$_GET['id'].'/comments/'.$_GET['cid'];
						system("rm -rf ".escapeshellarg($deletePath));
						$deletePath = 'profiles/'.$author.'/comments/'.$_GET['cid'];
						system("rm -rf ".escapeshellarg($deletePath));
						
						header('Location: '.constant("Website_Url").'/article?id='.$_GET['id']);
					} else {
						header('Location: '.constant("Website_Url").'/article?id='.$_GET['id']);
					}
				}
			} else {
				header('Location: '.constant("Website_Url").'/article?id='.$_GET['id']);
			}
			
		} else {
			header('Location: '.constant("Website_Url").'/article?id='.$_GET['id']);
		}
		
	} elseif ($_GET['type'] != '' && $_GET['type'] == 'account') {
		
		$allowed = false;
		
		
		if ($_SESSION['userName'] != '') {
			if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
				$allowed = true;
			} else {
				if ($_SESSION['userName'] == $_GET['id']) {
					$allowed = true;
					logoutUser();
				}
			}
		}
		
		
		if ($allowed == true) {
			$profileFile = "profiles/".$_GET['id'].".php";
			$imgFile = "profiles/".$_GET['id'].".jpg";
		
			$accountFile = constant("Website_Data_dir")."userpwd.txt";
			$uuid = md5(uniqid(rand(), true));
			unlink($profileFile);
		
			if (file_exists($imgFile)) {
				unlink($imgFile);
			}
		
			$str=file_get_contents($accountFile);
			$str=str_replace($_GET['id'], "deleted_acc_".$uuid,$str);
			file_put_contents($accountFile, $str);
						
			$userProfileFolder = "profiles/".$_GET['id'];
						
			system("rm -rf ".escapeshellarg($userProfileFolder));
						
			header('Location: '.constant("Website_Url"));
			die();
		} else {
			header('Location: '.constant("Website_Url"));
			die();
		}
	} else {
		
		
		$fileFound = true;
		$postDir = 'posts';
		
		$dirS = 'posts/'.$_GET['id'];				
							
		if (file_exists($dirS.'/date')) {
		} else {
			$postDir = "projects";
		}
		
		if (file_exists('projects/'.$_GET['id'].'/date')) {
		} else {
			if (file_exists($dirS.'/date')) {
			} else {
				$fileFound = false;
			}
			
		}
		
		if ($fileFound) {
			$author = file_get_contents($postDir.'/'.$_GET['id'].'/author');
			
			if ($_SESSION['userName'] != '') {
				if ($_SESSION['userName'] == $author) {
					
					system("rm -rf ".escapeshellarg($postDir.'/'.$_GET['id']));
					system("rm -rf ".escapeshellarg('profiles/'.$author.'/'.$_GET['id']));
					
					header('Location: '.constant("Website_Url"));
				} else {
					if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
						
						system("rm -rf ".escapeshellarg($postDir.'/'.$_GET['id']));
						system("rm -rf ".escapeshellarg('profiles/'.$author.'/'.$_GET['id']));
						
						header('Location: '.constant("Website_Url"));
					} else {
						header('Location: '.constant("Website_Url"));
					}
				}
			} else {
				header('Location: '.constant("Website_Url"));
			}
			
		} else {
			header('Location: '.constant("Website_Url"));
		}
		
	}
	

?>