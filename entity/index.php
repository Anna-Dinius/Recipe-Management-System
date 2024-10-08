<?php
include_once('../utils/functions.php');

$file = '../data/recipes.json';
$content = file_get_contents($file);
$recipes = json_decode($content, true);

?>

<!doctype html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
		crossorigin="anonymous"></script>
	<script type="module" src="./js/form.js"></script>

	<title>Recipes</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light mb-2 turqoise">
		<div class="container-fluid">
			<a class="navbar-brand text-light" href="index.php">SavorySagas</a>

			<div id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link" href="../auth/signin.php" id="signinBtn">Sign in</a>
					<a class="nav-link" href="../auth/signup.php" id="signupBtn">Sign up</a>
				</div>
			</div>
		</div>
	</nav>

	<main>
		<div class="d-flex ms-3">
			<div id="create">
				<a href="create.php" id="create-btn" class="btn btn-primary">
					Create
				</a>
			</div>
		</div>

		<div id="content">
			<?php
			displayCards($recipes);
			?>
		</div>
	</main>
</body>

</html>