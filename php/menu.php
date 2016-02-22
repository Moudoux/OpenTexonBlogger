<?php

require_once('account_system.php');
require_once('config.php');

require_once('lang.php'); 
$LangDir = getLang(); 
require_once(constant("Website_Location").'lang/'.$LangDir.'/language.php'); 


	function isActive($pName) {
		if (strpos($_SERVER['REQUEST_URI'],'/'.$pName) !== false) {
			return true;
		} else {
			return false;
		}
	}

 
 
		echo '<div id="navbar" class="navbar-collapse collapse">';
          echo '<ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">';
           echo '<li><a href="index">'.constant("Lang_Menu_Index").'</a></li>';
            echo '<li><a href="about">'.constant("Lang_Menu_About").'</a></li>'; 
            echo '<li><a href="project">'.constant("Lang_Menu_Projects").'</a></li>'; 	
			echo '<li><a href="hire">'.constant("Lang_Menu_Hire").'</a></li>'; 					
            echo '<!-- <li><a href="services">'.constant("Lang_Menu_Services").'</a></li> -->';
            echo '<li><a href="contact">'.constant("Lang_Menu_Contact").'</a></li>';

			
			if ($_SESSION['userName'] != '') {
				if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
					echo '<li><a href="log">'.constant("Lang_Menu_Log").'</a></li>';
					echo '<li><a href="notify">'.constant("Lang_Menu_Notify").'</a></li>';
				}
			}
			
			
			$loginLabel = checkUser();
			
			if ($loginLabel == "Login") {
				$loginLabel = constant("Lang_Menu_Login");
			} else {
				$loginLabel = constant("Lang_Menu_Logout");
			}
			
			
            echo '<li><a href="accountman">'.$loginLabel.'</a></li>';
			
			echo <<<END
          </ul>                            
        </div>
 
END;

?>
