<?php
	
	// Trim query, delete slashes and 
	// protect query
	function cleanQuery($q) {
		$q = trim($q);
		$q = stripslashes($q);
		$q = htmlspecialchars($q);

		return $q;
	}