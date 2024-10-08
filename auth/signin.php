<?php
include_once('../utils/functions.php');

$title = 'Sign In';

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
                <h2>Sign In</h2>
                <form class="position-absolute top-50 start-50 translate-middle card">
                    <div class="form-group m-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter email" />
                    </div>
                    <div class="form-group m-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" />
                    </div>
                    <button id="signin" type="submit" class="btn btn-primary">
                        Sign In
                    </button>
                    <br><br>
                    <div>
                        Don't have an account?
                        <a href="signup.php">Sign up here</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>