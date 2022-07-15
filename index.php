<?php
// PDO connection
try {
	$db = new PDO("mysql:host=localhost;dbname=countrypedia;charset=utf8", "root", "");
} catch(PDOException $e) {
	echo $e->getMessage();
}

// Form handling
if (isset($_GET['search'])) {
	$search = trim($_GET['query']);
	$q = $db->prepare("SELECT * FROM countries WHERE title LIKE '%$search%'");
	$q->execute(array());
	$control = $q->fetchAll(PDO::FETCH_ASSOC);
}

if (empty($_GET['query'])) {
	$q = $db->prepare("SELECT * FROM countries");
	$q->execute(array());
	$control = $q->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Correction Search Engine</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="bg-primary">
	<div class="container d-flex flex-column align-items-center justify-content-center text-white">
		<h1 class="">Countrypedia</h1>
		<p>Search engine for countries</p>
		<form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    		<input type="text" id="country" name="query" value="<?= htmlspecialchars($_GET['query']) ?? '' ?>">
  			<input type="submit" name="search" value="Search">
		</form>
		<h2><?= count($control) . " result(s):" ?></h2>
		<ul class="list-group list-group-flush">
			<?php foreach($control as $c): ?>
				<li class="list-group-item bg-primary"><?= $c['title'] ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>