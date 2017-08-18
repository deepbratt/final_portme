<?php
		//$mysqli = new mysqli("localhost", "root", "", "quiz_like");
		$mysqli = new mysqli("localhost", "deepbratt5", "Samadder5#", "prebooking_sales");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		SESSION_START();
		ERROR_REPORTING(0);
?>