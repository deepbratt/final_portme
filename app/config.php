<?php
		//$mysqli = new mysqli("localhost", "root", "", "portme_semifinal");
		$mysqli = new mysqli("localhost","deepbratt5","Samadder5#","portme");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		SESSION_START();
		ERROR_REPORTING(0);
		date_default_timezone_set('Asia/Kolkata');
?>