<?php
header('Content-Type: application/json');
include_once("../classes/Feature.class.php");
$comment = new Comments();

if(!empty($_POST['commentmessage']))
{
    $comment->Text = $_POST['commentmessage'];
    try
    {
        $comment->SaveComment();
        $feedback = [
            "code" => 200,
            "message" => htmlspecialchars($_POST['commentmessage'])
        ];
    }
    catch (Exception $e)
    {
        $error = $e->getMessage();
        $feedback = [
            "code" => 500,
            "message" => $error
        ];
    }

    echo json_encode($feedback);
}
?>