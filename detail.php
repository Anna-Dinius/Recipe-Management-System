<?php
include_once('functions.php');

$file = 'data/recipes.json';
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
							<?= $recipe['prep_time'] ?>
						</div>

						<div class="fw-bold text-center">Cook Time:</div>
						<div id="cook_time" class="text-center">
							<?= $recipe['cook_time'] ?>
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
							for ($i = 0; $i < count($recipe['ingredients']); $i++) {
								?>
								<li id="item-<?= $i ?>"><?= $recipe['ingredients'][$i] ?></li>
								<?php
							}
							?>
						</ul>
					</div>

					<h3>Steps</h3>
					<div class="centerContent">
						<ol id="steps">
							<?php
							for ($i = 0; $i < count($recipe['steps']); $i++) {
								?>
								<li><?= $recipe['steps'][$i] ?></li>
								<?php
							}
							?>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modify-title"></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div id="modify-area">
							<!-- prevents submissions -->
							<form onsubmit="return false;" id="change-form">

								<p>
									<strong>Name: </strong>
									<span class="required">*</span>
									<input type="text" class="form-control" name="name" id="recipe-name" />
								</p>
								<p>
									<strong>Author: </strong>
									<input type="text" class="form-control" name="author" id="m-authorName" disabled />
								</p>
								<p>
									<strong>Category: &nbsp;&nbsp;</strong>
									<select name="category" id="m-category">
										<option value="Entrees">Entrees</option>
										<option value="Sides">Sides</option>
										<option value="Desserts">Desserts</option>
									</select>
								</p>
								<p class="prep_cook_time">
									<strong>Prep Time: </strong>
									<span class="required">*</span>
								<div style="display:flex">
									<div>
										&nbsp;&nbsp;Hours:&nbsp;&nbsp;
										<br>
										&nbsp;&nbsp;Minutes:&nbsp;&nbsp;
									</div>
									<div class="time_options">
										<select name="prep_time_hours" class="time_hrs prep_time" id="prep_time_hrs">

										</select>
										<br>
										<select name="prep_time_minutes" class="time_mins prep_time" id="prep_time_mins">

										</select>
									</div>
								</div>
								</p>
								<p class="prep_cook_time">
									<strong>Cook Time: </strong>
								<div style="display:flex">
									<div>
										&nbsp;&nbsp;Hours:&nbsp;&nbsp;
										<br>
										&nbsp;&nbsp;Minutes:&nbsp;&nbsp;
									</div>
									<div class="time_options">
										<select name="cook_time_hours" class="time_hrs cook_time" id="cook_time_hrs">

										</select>
										<br>
										<select name="cook_time_minutes" class="time_mins cook_time" id="cook_time_mins">

										</select>
									</div>
								</div>
								</p>
								<p>
									<strong>Total Time: &nbsp;&nbsp;</strong><input type="text" class="form-control" name="total_time"
										id="m-total-time" disabled />
								</p>
								<p>
									<strong>Servings: </strong>
									<span class="required">*</span>
									<select name="servings" id="servingSizes">

									</select>
								</p>
								<p>
									<strong>Image URL: &nbsp;&nbsp;</strong><input class="form-control" name="image" />
								</p>
								<p>

									<strong>Ingredients: </strong>
									<span class="required">*</span>
								<div id="m-ingredients"></div>
								<button id="add-ingredient" class="btn btn-secondary">Add Ingredient</button>
								</p>
								<p>
									<strong>Steps: </strong>
									<span class="required">*</span>
								<div id="m-steps"></div>
								<button id="add-step" class="btn btn-secondary">Add Step</button>
								</p>
							</form>
						</div>
					</div>
					<div class="modal-footer" id="modalButton">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-cancel">
							Cancel
						</button>
						<button type="button" class="btn btn-primary" id="save-changes-btn">
							Save
						</button>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>