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



function generateHours($action, $type, $recipe)
{
  $maxHours = 24;

  if ($action == 'create') {
    for ($i = 0; $i <= $maxHours; $i++) {
      ?>
      <option value="<?= $i ?>"><?= $i ?></option>
      <?php
    }
  }

  if ($action == 'edit') {
    if ($type == 'prep') {
      for ($i = 0; $i <= $maxHours; $i++) {
        if ($i == $recipe['prep_time_hours']) {
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

    if ($type == 'cook') {
      for ($i = 0; $i <= $maxHours; $i++) {
        if ($i == $recipe['cook_time_hours']) {
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

function generateMinutes($action, $type, $recipe)
{
  $maxMinutes = 60;

  if ($action == 'create') {
    for ($i = 0; $i < $maxMinutes; $i += 5) {
      ?>
      <option value="<?= $i ?>"><?= $i ?></option>
      <?php
    }
  }

  if ($action == 'edit') {
    if ($type == 'prep') {
      for ($i = 0; $i < $maxMinutes; $i += 5) {
        if ($i == $recipe['prep_time_minutes']) {
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

    if ($type == 'cook') {
      for ($i = 0; $i < $maxMinutes; $i += 5) {
        if ($i == $recipe['cook_time_minutes']) {
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
      <button class="btn btn-danger del-input">X</button>
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
      <button class="btn btn-danger del-input">X</button>
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