<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // check if all fields are filled
    if(!empty($current_password) && !empty($new_password) && !empty($confirm_password))
    {
        // check if new password and confirm password match
        if($new_password != $confirm_password)
        {
            $_SESSION['error_message'] = "New password and confirm password do not match";
            header("Location: ../profile.php");
            exit();
        }

        // retrieve user info from database
        $stmt = mysqli_prepare($con, "SELECT password FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        // verify current password
        if(password_verify($current_password, $user['password']))
        {
            // hash and update new password in database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($con, "UPDATE users SET password = ? WHERE user_id = ?");
            mysqli_stmt_bind_param($stmt, "si", $hashed_password, $_SESSION['user_id']);
            mysqli_stmt_execute($stmt);

            $_SESSION['success_message'] = "Password changed successfully!";
            header("Location: ../profile.php");
            exit();
        }
        else
        {
            $_SESSION['error_message'] = "Current password is incorrect";
            header("Location: ../profile.php");
            exit();
        }
    }
    else
    {
        $_SESSION['error_message'] = "Please fill all fields";
        header("Location: ../profile.php");
        exit();
    }
}
?>