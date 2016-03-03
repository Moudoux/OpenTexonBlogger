<?php

    require_once('php/config.php');

    if (strpos(constant("Blocker_Blocked_IPS"), $_GET['i']) !== false) {
		echo 'Blocked';
	} else {
        echo 'Not blocked';
    }

?>
