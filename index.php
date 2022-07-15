<?php include "process.php"?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search engine</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <h1>Countrypedia</h1>
    <!-- Search engine to looking for 
    countries from MySQL
	-->
	<form method="GET">
    	<input type="text" id="country" name="query">
  		<input type="submit" name="search" value="Search">
	</form>
	<!-- Get response when user submit the query -->
	<?php if($isSubmitted): ?>
	<ul class="list-group">
		<?php var_dump($countries); ?>
		<?php getCountry($_GET['query']); ?>
	</ul>
	<?php endif; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>