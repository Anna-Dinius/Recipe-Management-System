<?php
include_once('../utils/functions.php');

$file = '../data/recipes.json';
$content = file_get_contents($file);
$recipes = json_decode($content, true);

$title = 'Recipes';

?>

<!doctype html>
<html lang="en">

<head>
	<?= getHead($title); ?>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light mb-2 turqoise">
		<?= getNav(); ?>
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