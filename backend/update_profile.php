<?php 
session_start();

include("connection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = mysqli_prepare($con, "SELECT user_name, email, bio, pic_link,lastname FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    $name = ($_POST['name'] != "") ? $_POST['name'] : $user['user_name'];
    $email = ($_POST['email'] != "") ? $_POST['email'] : $user['email'];
    $bio = ($_POST['bio'] != "") ? $_POST['bio'] : $user['bio'];
    $lastname = ($_POST['lastname'] != "") ? $_POST['lastname'] : $user['lastname'];
    $pic_link = $user['pic_link'];

        // check if user uploaded a new image
    if(isset($_FILES['pfp_image']) && $_FILES['pfp_image']['error'] == 0)
        {
            // check if image is valid
            $allowed_extensions = array("jpg", "jpeg", "png");
            $extension = strtolower(pathinfo($_FILES['pfp_image']['name'], PATHINFO_EXTENSION));
            if(in_array($extension, $allowed_extensions))
            {
                // generate unique filename and move file to uploads directory
                $pic_link = "../profile_pics/" . $_SESSION['user_id'] . "." . $extension;
                move_uploaded_file($_FILES['pfp_image']['tmp_name'], $pic_link);
                $pic_link = "./profile_pics/" . $_SESSION['user_id'] . "." . $extension;
 
            }
            else
            {
                $_SESSION['error_message'] = "Invalid image file type. Allowed types: jpg, jpeg, png".print_r($_FILES);
                header("Location: ../profile.php");
                exit();
            }
        }
    // update user info in database

    $stmt = mysqli_prepare($con, "SELECT user_name FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $_POST['email'] );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) == 0){
        $stmt = mysqli_prepare($con, "UPDATE users SET user_name = ?, email = ?, bio = ?, pic_link = ?, lastname = ? WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $bio, $pic_link,$lastname, $_SESSION['user_id']);
        mysqli_stmt_execute($stmt);
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: ../profile.php");
        exit();
    }else{
        $_SESSION['error_message'] = "Email already exists";
        header("Location: ../profile.php");
        exit(); 
    }
    

}