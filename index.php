<?php
include_once('functions.php');

$file = 'data/recipes.json';
$content = file_get_contents($file);
$recipes = json_decode($content, true);

?>

<!doctype html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
		crossorigin="anonymous"></script>
	<script type="module" src="./js/index.js"></script>
	<script type="module" src="./js/modal.js"></script>

	<title>Recipes</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
	<link rel="stylesheet" href="./css/styles.css" type="text/css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light mb-2 turqoise">
		<div class="container-fluid">
			<a class="navbar-brand text-light" href="index.php">SavorySagas</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link" href="signin.php" id="signinBtn">Sign in</a>
					<a class="nav-link" href="signup.php" id="signupBtn">Sign up</a>
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

			<div id="filter">
				<p>Filter Results By: </p>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						All
					</button>

					<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<button class="dropdown-item" type="button" data-id="all">All</button>
						<button class="dropdown-item" type="button" data-id="entree">Entrees</button>
						<button class="dropdown-item" type="button" data-id="Side Dish">Sides</button>
						<button class="dropdown-item" type="button" data-id="dessert">Desserts</button>
					</div>
				</div>
			</div>

		</div>

		<div id="content">
			<?php
			for ($i = 0; $i < count($recipes); $i++) {
				?>
				<div class="card">
					<a href="detail.php?recipe_id=<?= $recipes[$i]['id'] ?>">
						<div class="img-div">
							<img src="<?= $recipes[$i]['image'] ?>">
						</div>

						<div class="h1-div">
							<h1 class="text-truncate"><?= $recipes[$i]['name'] ?></h1>
						</div>

						<p class="author">Author: <?= $recipes[$i]['author'] ?></p>
					</a>

					<div class="d-flex btns" id="btn-box-<?= $recipes[$i]['id'] ?>">
						<a href="delete.php?recipe_id=<?= $recipes[$i]['id'] ?>" class="btn btn-sm btn-danger btn-delete">Delete</a>
						<a href="edit.php?recipe_id=<?= $recipes[$i]['id'] ?>" class="btn btn-secondary update-btn">Edit</a>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		<!-- <div id="loadmore" class="btn-container">
			<button class="btn load-btn btn-primary" id="load-more">Load More</button>
		</div> -->
	</main>
</body>

</html>