<!doctype html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <title>Sign In</title>
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
            <a class="navbar-brand text-light" href="../entity/index.php">SavorySagas</a>
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
    <?php 
        if(count($_POST) > 0){
            echo '<pre>';
            print_r($_POST);
            //Opens file
            $file = '../data/users.csv';
            $fp = fopen($file, 'r');
            //Checks for correct log in information.
            while(($data = fgetcsv($fp)) !== FALSE){
                echo(count($data));
                if($_POST['email'] == $data[2] && $_POST['password'] == $data[3]){
                    echo('LOGIN!'); //Log in functionality
                }
            }
            $fp = fclose($fp);
        }else{
    ?>
    <main>
        <div class="d-flex ms-3">
            <div class="h-100 d-flex align-items-center justify-content-center signInUp">
                <h2>Sign In</h2>
                <form class="position-absolute top-50 start-50 translate-middle card" method="POST" action = "signin.php">
                    <div class="form-group m-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required
                            placeholder="Enter email" />
                    </div>
                    <div class="form-group m-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required/>
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
    <?php 
        }
    ?>
</body>

</html>