<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if ($_POST['action'] == 0){
    $event = curr_event_info($_POST['event_name']);
    $event_id = $event['event_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO enrolled_events (event_id, user_id) VALUES ($event_id,$user_id)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt); 
    header("Location: ../event.php?event_name=".urlencode($_POST['event_name']));
}
    else{
        $event = curr_event_info($_POST['event_name']);
        $event_id = $event['event_id'];
        $user_id = $_SESSION['user_id'];
        $sql = "DELETE from enrolled_events where event_id = $event_id and user_id = $user_id";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_execute($stmt); 
        header("Location: ../event.php?event_name=".urlencode($_POST['event_name']));
    }
}