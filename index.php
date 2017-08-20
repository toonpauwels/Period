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
        $task->SaveTask();
    }
    catch( Exception $e ){
        $error = $e->getMessage();
    }
}

if(!empty($_POST) && isset($_POST["commentmessage"])){
    try{
        $comment = new Comments();
        $comment->Text = $_POST["commentmessage"];
        $comment->SaveComment();
    }
    catch( Exception $e ){
        $errorcomment = $e->getMessage();
    }
}

$list = new ListItem();
$results = $list->GetLists();

$task = new TaskItem();
$resultsTasks = $task->GetTasks();
$today=time();

$vak = new Vakken();
$resultsvakken = $vak->GetVakken();

$comment = new Comments();
$resultcomments = $comment->GetComments();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Period</title>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/comments.js"></script>
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
                        <form action="" method="post" id="addtask" class="form-horizontal">
                            <?php foreach($results as $result): ?>
                            <li class="list-group-item" name="<?php $result["listitem"]?>">
                                <legend name="<?php $result["listitem"]?>"><?php echo $result["listitem"] ?></legend>
                                <div class="form-group">
                                    <input type="text" name="titel" placeholder="titel" class="form-control">
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker" name="vak">
                                    <?php foreach($resultsvakken as $resultVak): ?>
                                        <option><?php echo $resultVak["vak"]; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="date" name="datum" placeholder="datum" class="form-control">
                                </div>
                                <div class="form-group">
                                <button class="btn pull-right btn-success btn-xs " style="float: right" type="submit"">taak toevoegen</button>
                                </div>
                            </li>
                        </form>
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
            </form>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-faded" id="topnav">
                <ul class="navbar-nav ml-auto">
                    <li><a href="logout.php" >Logout</a></li>
                </ul>
            </nav>
            <ul>
            <?php foreach($resultsTasks as $resultTask): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="text-center col titel"><?php echo $resultTask["titel"] ?></div>
                        <div class="text-center col vak"><?php echo $resultTask["vak"] ?></div>
                        <div class="text-center col">
                            <?php echo $resultTask["datum"] ?>
                            <div class="text-center col resterend">
                                <?php
                                $difference = strtotime($resultTask["datum"]) - $today;
                                echo floor($difference/60/60/24)." dagen resterend";
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" placeholder="comment" name="commentmessage" class="commentmessage"/>
                                    <p class="text-danger"><?php if(isset($errorcomment)) {echo $errorcomment;};?></p>
                                    <button type="submit" class="btn btn-outline-primary btn-sm btnSubmit">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul id="listupdates">
                        <?php foreach($resultcomments as $resultcomment): ?>
                            <li class="list-group-item"><?php echo $resultcomment["comment"] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


</body>
</html>