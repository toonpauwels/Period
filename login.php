<?php
spl_autoload_register( function($class) {
    include_once ("classes/" . $class . ".class.php");
});

try {
    if (!empty($_POST) && isset($_POST["emailRegister"]) && isset($_POST["passwordRegister"])) {
        if (!empty($_POST["emailRegister"]) && !empty($_POST["passwordRegister"])) {
            $user = new User();
            $user->Email = $_POST["emailRegister"];
            $user->Password = $_POST["passwordRegister"];
            $user->register();
        } else {

        }
    }
}
catch (Exception $e){
    echo  $e->getMessage();
}
try {
    if (!empty($_POST)) {
        if (!empty($_POST["emailLogin"]) && !empty($_POST["passwordLogin"])) {
            $userLogin = new User();
            $userLogin->Email = $_POST["emailLogin"];
            $userLogin->Password = $_POST["passwordLogin"];
            if ($userLogin->canLogin()) {
                $_SESSION['loggedin'] = true;
                header('Location: index.php');

            }
        } else {
            echo 'wa';
        }
    }
}
catch (Exception $e){
    echo  $e->getMessage();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in or register</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</head>
<body>
<div id="register">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginform">

        <label for="email">email</label>
        <input type="text" name="emailRegister" id="email" class="form-control" placeholder="email">

        <label for="password">wachtwoord</label>
        <input type="password" name="passwordRegister" id="password" class="form-control" placeholder="wachtwoord">

        <button type="submit" class="btn btn-default">Register</button>
    </form>


</div>

<div id="login">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginform">

        <label for="email">email</label>
        <input type="text" name="emailLogin" id="email" class="form-control" placeholder="email">

        <label for="password">wachtwoord</label>
        <input type="password" name="passwordLogin" id="password" class="form-control" placeholder="wachtwoord">

        <button type="submit" class="btn btn-default">log in</button>
    </form>

</div>
</body>
</html>