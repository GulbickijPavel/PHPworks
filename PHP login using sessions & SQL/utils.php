<?php

	function isUserLoggedIn() {
		return isset($_SESSION['user']) && isset($_SESSION['user']['username']) && $_SESSION['user']['username'] != null;
	}
	
?>