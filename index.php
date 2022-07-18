<?php
// Include required files
include "process.php";


// Required data to connect with PDO
// to database countrypedia
$hostname = "localhost";
$dbname = "countrypedia";
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $hostname, $dbname); // To avoid SQL injections
$username = "root";
$password = "";

// Database connection
// if failure, display an error
// to the developer
try {
	$pdo = new PDO($dsn, $username, $password);
} catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

// User submits a query
if (isset($_GET["search"])) {

	// Clean form
	// and protect it
	$q = cleanQuery($_GET["query"]);

	// Get countries/y like this query
	$query = $pdo->prepare("SELECT * FROM countries WHERE title LIKE '%$q%'");
	$query->execute(array());
	$countries = $query->fetchAll(PDO::FETCH_ASSOC);
} 
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search engine</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<header class="container-fluid p-3">
		<div class="row">
			<h1 class="col bg-dark text-white text-center">Countrypedia</h1>
		</div>
	</header>

	<!-- Main page: action protected by htmlspecialchars to avoid $_SERVER['PHP_SELF'] exploits -->
	<div class="container-fluid d-flex flex-column align-items-center justify-content-center">
		<form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    		<input type="text" name="query">
  			<input type="submit" name="search" value="Search">
		</form>
		<?php if(isset($_GET["search"])): ?>
			<!-- Display results for the query -->
			<h2><?= count($countries ?? array()) . " result(s) for <span style='color:red'>$q</span>" ?></h2>
			<ul class="list-group list-group-flush">
				<?php foreach($countries as $country): ?>
					<li class="list-group-item fs-5"><?= $country["title"] ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

	<!-- Developer signature -->
	<footer class="container-fluid">
		<div class="row">
			<p class="col bg-dark text-white text-center">&copy; <a href="https://github.com/loickcherimont" class="link-white">Loick Cherimont</a> 2022</p>
		</div>
	</footer>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>