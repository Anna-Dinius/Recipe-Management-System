<?php

function getRecipe($recipes, $id)
{
  for ($i = 0; $i < count($recipes); $i++) {
    $recipe = $recipes[$i];
    if ($recipe['id'] == $id) {
      return $recipe;
    }
  }

  return null;
}

function updateViewCount($target_id)
{
  if (file_exists('visitors.csv')) {
    $lines = file('visitors.csv');
    $updated_lines = [];
    $views = 0;

    for ($i = 0; $i < count($lines); $i++) {
      $line = explode(';', $lines[$i]);

      $id = trim($line[0]);

      $views = trim($line[1]);

      if ($id == $target_id) {
        $views++;
      }

      $updated_lines[] = $id . ';' . $views;
    }

    // writing to the file
    $fp = fopen('visitors.csv', 'w');

    foreach ($updated_lines as $line) {
      fputs($fp, $line . PHP_EOL);
    }

    fclose($fp);
  } else {
    echo "
      <script>
        alert('Error: Could not update view count')
      </script>
    ";
  }
}

function displayCards($recipes)
{
  for ($i = 0; $i < count($recipes); $i++) {
    ?>
    <div class="card">
      <a href="../entity/detail.php?recipe_id=<?= $recipes[$i]['id'] ?>">
        <div class="img-div">
          <img src="<?= $recipes[$i]['image'] ?>">
        </div>

        <div class="h1-div">
          <h1 class="text-truncate"><?= $recipes[$i]['name'] ?></h1>
        </div>

        <p class="author">Author: <?= $recipes[$i]['author'] ?></p>
      </a>

      <div class="d-flex btns" id="btn-box-<?= $recipes[$i]['id'] ?>">
        <a href="../entity/delete.php?recipe_id=<?= $recipes[$i]['id'] ?>"
          class="btn btn-sm btn-danger btn-delete">Delete</a>
        <a href="../entity/edit.php?recipe_id=<?= $recipes[$i]['id'] ?>" class="btn btn-secondary update-btn">Edit</a>
      </div>
    </div>
    <?php
  }
}

function displayIngredients($recipe)
{
  for ($i = 0; $i < count($recipe['ingredients']); $i++) {
    ?>
    <li id="item-<?= $i ?>"><?= $recipe['ingredients'][$i] ?></li>
    <?php
  }
}

function displaySteps($recipe)
{
  for ($i = 0; $i < count($recipe['steps']); $i++) {
    ?>
    <li><?= $recipe['steps'][$i] ?></li>
    <?php
  }
}

function generateServingSizes($action, $recipe)
{
  $largestServing = 20;

  if ($action == 'create') {
    for ($i = 0; $i <= $largestServing; $i++) {
      ?>
      <option value="<?= $i ?>"><?= $i ?></option>
      <?php
    }
  }

  if ($action == 'edit') {
    for ($i = 0; $i <= $largestServing; $i++) {
      if ($i == $recipe['servings']) {
        ?>
        <option value="<?= $i ?>" selected><?= $i ?></option>
        <?php
      } else {
        ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php
      }
    }
  }
}

function generateTimeOptions($action, $type, $time, $recipe)
{
  $maxHours = 24;
  $maxMinutes = 60;

  if ($action == 'create') {
    if ($time == 'hours') {
      for ($i = 0; $i <= $maxHours; $i++) {
        ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php
      }
    } elseif ($time == 'minutes') {
      for ($i = 0; $i < $maxMinutes; $i += 5) {
        ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php
      }
    }
  } elseif ($action == 'edit') {
    if ($time == 'hours') {
      for ($i = 0; $i <= $maxHours; $i++) {
        if ($i == $recipe[$type . '_time_hours']) {
          ?>
          <option value="<?= $i ?>" selected><?= $i ?></option>
          <?php
        } else {
          ?>
          <option value="<?= $i ?>"><?= $i ?></option>
          <?php
        }
      }
    } elseif ($time == 'minutes') {
      for ($i = 0; $i < $maxMinutes; $i += 5) {
        if ($i == $recipe[$type . '_time_minutes']) {
          ?>
          <option value="<?= $i ?>" selected><?= $i ?></option>
          <?php
        } else {
          ?>
          <option value="<?= $i ?>"><?= $i ?></option>
          <?php
        }
      }
    }
  }
}

function generateSteps($recipe)
{
  for ($i = 0; $i < count($recipe['steps']); $i++) {
    ?>
    <div class="d-flex">
      <textarea class="form-control mb-3 step-input" id="step-<?= $i + 1 ?>"><?= $recipe['steps'][$i] ?></textarea>
      <button type="button" class="btn btn-danger del-input">X</button>
    </div>
    <?php
  }
}
function generateIngredients($recipe)
{
  for ($i = 0; $i < count($recipe['ingredients']); $i++) {
    ?>
    <div class="d-flex">
      <input class="form-control mb-3 ingredient-input" id="ingredient-<?= $i + 1 ?>"
        value="<?= $recipe['ingredients'][$i] ?>" />
      <button type="button" class="btn btn-danger del-input">X</button>
    </div>
    <?php
  }
}

function generateCategory($recipe)
{
  $categories = ['Entrees', 'Sides', 'Desserts'];

  foreach ($categories as $category) {
    if ($recipe['category'] == $category) {
      ?>
      <option value="<?= $category ?>" selected><?= $category ?></option>
      <?php
    } else {
      ?>
      <option value="<?= $category ?>"><?= $category ?></option>
      <?php
    }
  }
}

function displayTime($type, $recipe)
{
  $hours = $recipe[$type . '_time_hours'];
  $minutes = $recipe[$type . '_time_minutes'];
  $time = '';

  if ($hours == 0) {
    $hours = '';
  } elseif ($hours == 1) {
    $hours = $hours . ' hour';
  } elseif ($hours > 1) {
    $hours = $hours . ' hours';
  }

  if ($minutes == 0) {
    $minutes = '';
  } elseif ($minutes > 1) {
    $minutes = $minutes . ' minutes';
  }

  if ($hours != '' && $minutes != '') {
    $time = $hours . ', ' . $minutes;
  } else if ($hours == '') {
    $time = $minutes;
  } else if ($minutes == '') {
    $time = $hours;
  } else {
    $time = 'Error fetching time';
  }

  echo $time;
}