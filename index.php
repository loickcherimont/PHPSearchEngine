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
	$numberResults = count($countries); 
} 
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>&#x1F30D; Countrypedia</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS move to external CSS file in a future assets folder -->
	<style>
      *, ::after, ::before {
        margin: 0; padding: 0;
        box-sizing:  border-box;
      }

      body {
        height: 100vh;
        background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("main_background.jpg");
        background-size: cover;
      }

      .results {
      	background: none;
      }

    </style>
</head>
<body class="d-flex flex-column justify-content-evenly text-center text-white">

	<!-- Engine name -->
  <header class="container">
    <div class="row">
      <h1>C&#x1F30D;untrypedia</h1>
      <p class="lead">Search for a country!</p>
    </div>
  </header>

	<!-- Main page: action protected by htmlspecialchars to avoid $_SERVER['PHP_SELF'] exploits -->
	<main class="container-fluid d-flex flex-column align-items-center justify-content-center">
		<form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="container d-flex flex-row">
    		<input type="text" name="query" class="fs-5 form-control" placeholder="France, ..." value="<?= $q ?>">
  			<input type="submit" name="search" value="Search" class="mx-3 btn btn-primary">
		</form>

		<!-- Display results for query not empty -->
		<?php if(isset($_GET["search"]) && !empty($q)): ?>
			<h2><?= $numberResults ?>
				<?php if($numberResults < 2): ?>
					result
				<?php else: ?>
					results
				<?php endif; ?>
				for <span class="text-danger"><?=$q?></span>
			</h2>
			<!-- To Do: Display in white the line in list group flush mode -->
			<ul class="list-group list-group-flush">
				<?php if(empty($numberResults)): ?>
					<li class="list-group-item fs-5 text-white results">Sorry no country in our database contains this character!</li>
				<?php endif; ?>
				<?php foreach($countries as $country): ?>
					<li class="list-group-item fs-5 text-white results"><?= $country["title"] ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<!-- User doesn't enter any query, so return error message  -->
		<?php if(isset($_GET["search"]) && empty($q)): ?>
			<h2 class="text-danger pt-2">Your research is empty. Please enter a query!</h2>
		<?php endif; ?>
	</main>

	<!-- Developer signature -->
  <footer class="container-fluid text-center">
    <div class="row">
      <p class="col text-white text-center"> By <a href="https://github.com/loickcherimont" class="link-white" title="Go on Loick's Github">Loick Cherimont</a> </p>
    </div>
    <div class="row">
    	<p class="col">July 2022</p>
    </div>
  </footer>

  <!-- CDN Bootstrap JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>


<!-- HTML TEMPLATE ******************************************************************************* -->
<!-- <html lang="en">
  <head>
  </head>
  <body class="d-flex flex-column justify-content-evenly text-center text-white">


    
  </body>
</html>
 -->