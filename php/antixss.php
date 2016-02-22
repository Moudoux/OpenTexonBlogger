<?php

	// Protects agains XSS attacts
	function isxss($data) {
		$result = false;
		if (strpos($data,'<') !== false) {
			$result = true;
		}
		if (strpos($data,'>') !== false) {
			$result = true;
		}
		if (strpos($data,'(') !== false) {
			$result = true;
		}
		if (strpos($data,')') !== false) {
			$result = true;
		}
		if (strpos($data,'{') !== false) {
			$result = true;
		}
		if (strpos($data,'}') !== false) {
			$result = true;
		}
		return $result;
	}

?>