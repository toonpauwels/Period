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
            if (empty($_POST["emailRegister"])){
                $err_register1 = "Vul een emailadres in.";
            }
            if (empty($_POST["passwordRegister"])){
                $err_register2 = "Vul een wachtwoord in.";
            }

        }
    }
}
catch (Exception $e){
    $err_register3 = $e->getMessage();
}

try {
    if (!empty($_POST) && isset($_POST["emailLogin"]) && isset($_POST["passwordLogin"])) {
        if (!empty($_POST["emailLogin"]) && !empty($_POST["passwordLogin"])) {
            $userLogin = new User();
            $userLogin->Email = $_POST["emailLogin"];
            $userLogin->Password = $_POST["passwordLogin"];
            if ($userLogin->canLogin()) {
                if ($_POST["emailLogin"] == "admin@admin.com"){
                    $_SESSION['admin'] == true;
                    header('Location: admin.php');
                }
                else{
                $_SESSION['loggedin'] = true;
                header('Location: index.php');
                }
            }
        } else {
            if (empty($_POST["emailLogin"])){
                $err_login1 = "Vul een emailadres in.";
            }
            if (empty($_POST["passwordLogin"])){
                $err_login2 = "Vul een wachtwoord in.";
            }
        }
    }
}
catch (Exception $e){
    $err_login3 = $e->getMessage();
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

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container">
    <div class="row">
<div id="register" class="col">
        <form action="" method="post" id="registerform" class="justify-content-center">
        <div class="form-group">
            <label class="sr-only">Email</label>
            <input type="text" name="emailRegister" id="defaultForm-email" class="form-control" placeholder="email">
            <p class="text-danger"><?php if(isset($err_register1)) {echo $err_register1;};?></p>
            <p class="text-danger"><?php if(isset($err_register3)) {echo $err_register3;};?></p>
        </div>
        <div class="form-group">
            <label class="sr-only">Wachtwoord</label>
            <input type="password" name="passwordRegister" id="defaultForm-pass" class="form-control" placeholder="wachtwoord">
            <p class="text-danger"><?php if(isset($err_register2)) {echo $err_register2;};?></p>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-default" id="button1">Register</button>
        </div>
    </form>
</div>


<div id="login" class="col">
    <form action="" method="post" id="loginform" class="justify-content-center">
        <div class="form-group">
            <label class="sr-only">email</label>
            <input type="text" name="emailLogin" id="email" class="form-control" placeholder="email">
            <p class="text-danger"><?php if(isset($err_login1)) {echo $err_login1;};?></p>
            <p class="text-danger"><?php if(isset($error_login3)) {echo $error_login3;};?></p>
        </div>
        <div class="form-group">
            <label class="sr-only">wachtwoord</label>
            <input type="password" name="passwordLogin" id="password" class="form-control" placeholder="wachtwoord">
            <p class="text-danger"><?php if(isset($err_login2)) {echo $err_login2;};?></p>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-default userbutton">log in</button>
        </div>
    </form>

</div>
    </div>
</div>
</body>
</html>