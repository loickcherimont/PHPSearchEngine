<?php

// Indic: Error near "FROM countries"

// GLOBAL DATA
$isSubmitted;
$countries = "";

// TODO: Verify if query is valid
// else return error message to user
// valid means:
// - country is in database
// - field not empty

// -- FUNCTIONS --
// Send query
// return the wanted countries/country
$isSubmitted = isset($_GET['search']) && !empty($_GET['search']);

function getCountry(string $query) {

	// -- Database setup
	$hostname = "localhost";
	$dbname = "countrypedia";
	$username = "root";
	$password = "";


	try {
		$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Fetch countries from table
		$GLOBALS['countries'] = $pdo->query("SELECT $query FROM countries", PDO::FETCH_ASSOC);

		foreach($countries as $country) {
			echo "<li class='list-group-item'>".$country['title']."</li>";
		}

	} catch(PDOException $e) {
		print "Error!: ". $e->getMessage();
		die();
	}
}