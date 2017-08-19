<?php
session_start();
include_once("classes/User.class.php");
include_once("classes/Feature.class.php");
if(isset($_SESSION['admin'])){

}
else {
    header('Location: login.php');
}

if(!empty($_POST) && isset($_POST["addvakken"])){
    try {
        $vak = new Vakken();
        $vak->Vak = $_POST["addvakken"];
        $vak->SaveVak();
    }
    catch( Exception $e ){
        $error1 = $e->getMessage();
    }
}

if(!empty($_POST) && isset($_POST["deletevak"])){
    try {
        $vak = new Vakken();
        $vak->Vak = $_POST["deletevak"];
        $vak->DeleteVak();
    }
    catch( Exception $e ){
        $error2 = $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Period - admin</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>"/>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-faded" id="topnav">
        <ul class="navbar-nav ml-auto">
            <li><a href="logout.php" >Logout</a></li>
        </ul>
    </nav>
    <form action="" method="post" id="addvakken" class="form-horizontal bottom col-6">
        <div class="form-group">
            <input type="text" name="addvakken" placeholder="voeg een vak toe" class="form-control">
            <p class="text-danger"><?php if(isset($error1)) {echo $error1;};?></p>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">voeg toe</button>
        </div>
    </form>
    <form action="" method="post" id="deletevak" class="form-horizontal bottom col-6">
        <div class="form-group">
            <input type="text" name="deletevak" placeholder="vak verwijderen" class="form-control">
            <p class="text-danger"><?php if(isset($error2)) {echo $error2;};?></p>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning btn-block">verwijder vak</button>
        </div>
    </form>
</div>

</body>
</html>