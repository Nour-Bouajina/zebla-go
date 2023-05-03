<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    

$name = $_POST['name'];
$date = $_POST['date'];
$location = $_POST['location'];


$sql = "SELECT * FROM events WHERE 1=1";


// Add conditions to the SQL query and parameters array based on the form values
if (!empty($name)) {
    $sql .= " AND name like '%$name%'";
}

if (!empty($date)) {
    $sql .= " AND start_date >= '$date'";
}

if (!empty($location)) {
    $sql .= " AND location = '$location'";
}



$_SESSION['articals'] = '';

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$_SESSION['last_search'] = $_POST;
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    // Fetch the links related to the event
    
    $stmt = mysqli_prepare($con, "SELECT link FROM pic_links WHERE event_id = ? limit 1");
    mysqli_stmt_bind_param($stmt, "i", $row['event_id']);
    mysqli_stmt_execute($stmt);
    $link = mysqli_stmt_get_result($stmt);
    $link = mysqli_fetch_assoc($link);
    $_SESSION['articals'].= '<article>
            <img src="'.$link["link"].'" alt="" />
            <div class="content">
                  <h1><a href="" title="">'.$row["name"].'</a></h1>
                  <p>'.$row["description"].'</p>
                <h5 class="footer">'.$row["start_date"].' - '.$row["end_date"].' in '.$row["location"].'</h5>

            </div>
              </article>';
  }
}else{
    $_SESSION['articals'] = '<p> No events :( </p>'.$sql;
}

header("Location: ../events.php");
exit();
}
?>