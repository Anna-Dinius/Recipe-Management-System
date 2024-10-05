<?php
include_once('../utils/functions.php');

$file = '../data/recipes.json';
$content = file_get_contents($file);
$recipes = json_decode($content, true);

$id = $_GET['recipe_id'];
$recipe = getRecipe($recipes, $id);

updateViewCount($id);

?>

<!doctype html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
		crossorigin="anonymous"></script>
	<script type="module" src="./js/form.js"></script>

	<title>Recipe Details</title>
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
		<div class="container">
			<div class="row">
				<div id="btns">
					<a href="index.php">
						<button class="btn btn-secondary update-btn">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
								class="bi bi-arrow-left" viewBox="0 0 16 16">
								<path fill-rule="evenodd"
									d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
							</svg>
							Back to Index
						</button>
					</a>
					<br><br><br>
				</div>

				<div class="colpic">
					<img class="pic" src="<?= $recipe['image'] ?>" alt="Recipe photo" id="photo" />
				</div>

				<div class="col">
					<h3 id="name">
						<?= $recipe['name'] ?>
					</h3>
					<h3 id="author">
						By: <?= $recipe['author'] ?>
					</h3>

					<div class="d-flex justify-content-center flex-column">
						<div class="fw-bold text-center">Category:</div>
						<div id="category" class="text-center">
							<?= $recipe['category'] ?>
						</div>

						<div class="fw-bold text-center">Prep Time:</div>
						<div id="prep_time" class="text-center">
							<?php displayTime('prep', $recipe); ?>
						</div>

						<div class="fw-bold text-center">Cook Time:</div>
						<div id="cook_time" class="text-center">
							<?php displayTime('cook', $recipe); ?>
						</div>

						<div class="fw-bold text-center">Total Time:</div>
						<div id="total_time" class="text-center">
							<?= $recipe['total_time'] ?>
						</div>

						<div class="fw-bold text-center">Servings:</div>
						<div id="servings" class="text-center">
							<?= $recipe['servings'] ?>
						</div>
					</div>

					<h3>Ingredients</h3>
					<div class="centerContent">
						<ul id="ingredients">
							<?php
							displayIngredients($recipe);
							?>
						</ul>
					</div>

					<h3>Steps</h3>
					<div class="centerContent">
						<ol id="steps">
							<?php
							displaySteps($recipe);
							?>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>