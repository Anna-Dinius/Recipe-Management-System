<?php
include_once('../utils/functions.php');

$title = 'Sign Up';

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
      <div class="h-100 d-flex align-items-center justify-content-center signInUp">
        <h2>Sign Up</h2>
        <form class="position-absolute top-50 start-50 translate-middle card">
          <div class="form-group m-3">
            <label for="First Name">First Name</label><span class="required">*</span>
            <input type="text" class="form-control" id="firstName" aria-describedby="firstNameHelp"
              placeholder="Enter First Name" />
          </div>

          <div class="form-group m-3">
            <label for="Last Name">Last Name</label><span class="required">*</span>
            <input type="text" class="form-control" id="lastName" aria-describedby="lastNameHelp"
              placeholder="Enter Last Name" />
          </div>

          <div class="form-group m-3">
            <label for="email">Email address</label><span class="required">*</span>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
              placeholder="Enter email" />
          </div>

          <div class="form-group m-3">
            <label for="password">Password</label><span class="required">*</span>
            <input type="password" class="form-control" id="password" placeholder="Password" />
          </div>

          <button id="signup" type="submit" class="btn btn-primary">
            Sign up
          </button>
          <br><br>

          <div>
            Already have an account?
            <a href="signin.php">Sign in here</a>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>