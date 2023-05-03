
<?php 
session_start();

include("connection.php");
include("functions.php");

$event_titles = get_artical_titles(False);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];
    $region_name = $_POST['region_name'];
    $long = $_POST['longitude'];
    $lat = $_POST['latitude'];
    $uid = $_SESSION['user_id'];
    if (!in_array($name, $event_titles)) {

        if(isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0)
        {
            // check if image is valid
            $allowed_extensions = array("jpg", "jpeg", "png");
            $extension = strtolower(pathinfo($_FILES['event_image']['name'], PATHINFO_EXTENSION));
            if(in_array($extension, $allowed_extensions))
            {
                $pic_link = "../event_pics/" . $name . "." . $extension;
                move_uploaded_file($_FILES['event_image']['tmp_name'], $pic_link);
                $pic_link = "./event_pics/" . $name . "." . $extension;
                
            }
            else
            {
                $_SESSION['error_message'] = "Invalid image file type. Allowed types: jpg, jpeg, png";
                header("Location: ../CreateEvent.php");
                exit();
            }
        }


        $sql = "INSERT INTO events (name, description, start_date, end_date, location, region_name, user_id,longi,lat) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssidd", $name, $description, $start_date, $end_date, $location, $region_name, $uid,$long,$lat);
        mysqli_stmt_execute($stmt);
        $event_id = mysqli_insert_id($con);
        // insert pic links into pic
        $sql = "INSERT INTO pic_links (event_id, link) VALUES ($event_id,'$pic_link')";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_execute($stmt);
        $_SESSION['success_message'] = "Event created sucessfully";
        header("Location: ../CreateEvent.php");
        exit(); 
    }else{
        $_SESSION['error_message'] = "Event already exists";
        header("Location: ../CreateEvent.php");
        exit(); 
    }

}
?>