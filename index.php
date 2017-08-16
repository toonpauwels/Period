<?php
session_start();
include_once("classes/User.class.php");
include_once("classes/Feature.class.php");
if(isset($_SESSION['loggedin'])){

}
else {
header('Location: login.php');
}

if(!empty($_POST) && isset($_POST["addlist"])){
    try {
        $list = new ListItem();
        $list->AddList = $_POST["addlist"];
        $list->SaveList();
    }
    catch( Exception $e ){
        $error1 = $e->getMessage();
    }
}

if(!empty($_POST) && isset($_POST["deletelist"])){
    try {
        $list = new ListItem();
        $list->DelList = $_POST["deletelist"];
        $list->DeleteList();
    }
    catch( Exception $e ){
        $error2 = $e->getMessage();
    }
}

if(!empty($_POST) && isset($_POST["titel"]) && isset($_POST["vak"]) && isset($_POST["datum"])){
    try {
        $task = new TaskItem();
        $task->titel = $_POST["titel"];
        $task->vak = $_POST["vak"];
        $task->datum = $_POST["datum"];
        $task->listitem = $result["listitem"];
        $task->SaveTask();
    }
    catch( Exception $e ){
        $error = $e->getMessage();
    }
}


$list = new ListItem();
$results = $list->GetLists();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Period</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div id="leftnav" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <form action="" method="post" id="addlist" class="form-horizontal">
                <div class="form-group">
                <input type="text" name="addlist" placeholder="Lijst toevoegen" class="form-control">
                    <p class="text-danger"><?php if(isset($error1)) {echo $error1;};?></p>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Voeg toe</button>
                </div>
            </form>

                <ul class="list-group" id="lists">
                <?php foreach($results as $result): ?>
                    <li class="list-group-item" name="<?php $result["listitem"]?>">
                        <?php echo $result["listitem"] ?>

                        <form action="" method="post" id="addtask" class="form-horizontal">
                        <div class="form-group">
                            <input type="text" name="titel" placeholder="titel" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="vak" placeholder="vak" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="date" name="datum" placeholder="datum" class="form-control">
                        </div>
                        <div class="form-group">
                        <button class="btn pull-right btn-success btn-xs " style="float: right" type="submit"">taak toevoegen</button>
                        </div>
                        </form>
                    </li>
                <?php endforeach; ?>
                </ul>

            <form action="" method="post" id="deletelist" class="form-horizontal bottom">
                <div class="form-group">
                    <input type="text" name="deletelist" placeholder="Lijst verwijderen" class="form-control">
                    <p class="text-danger"><?php if(isset($error2)) {echo $error2;};?></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-block">verwijder</button>
                </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-faded" id="topnav">
                <ul class="navbar-nav ml-auto">
                    <li><a href="logout.php" >Logout</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</body>
</html>