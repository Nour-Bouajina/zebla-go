<?php 
session_start();

include("connection.php");
include("functions.php");   

$event_titles = get_artical_titles(False);

if($_SERVER['REQUEST_METHOD'] == "GET"){
	$event_title = $_GET['event_title'];
	$sql = "SELECT * FROM events WHERE 	name = '$event_title'";
	$result = mysqli_query($con, $sql);
	$event_data = mysqli_fetch_assoc($result);
    //indicate that the respose is json (wont work witout it)
	header('Content-Type: application/json');
	echo json_encode($event_data);
}
?>