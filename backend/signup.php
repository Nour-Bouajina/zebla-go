<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $lastname = $_POST['lastname'];
    if(!empty($user_name) && !empty($email) && !empty($password))
    {

        $stmt = mysqli_prepare($con, "SELECT user_id, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 0)
        {
                //hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $default_img = "img/default_pfp.png";
                //insert new user into database
                $stmt = mysqli_prepare($con, "INSERT INTO users (user_name, email, password, lastname, pic_link) VALUES (?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sssss", $user_name, $email, $hashed_password, $lastname, $default_img) ;
                mysqli_stmt_execute($stmt);
                if (mysqli_affected_rows($con) != -1) {
                
                //get the newly created user's ID
                $user_id = mysqli_insert_id($con);

                //store user ID in session
                $_SESSION['user_id'] = $user_id;

                //set some cookies to use later
                $session_cookie_options = array(
                    'expires' => time() + 86400,
                    'path' => '/',
                    'domain' => '',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict'
                );
                setcookie(session_name(), session_id(), $session_cookie_options);
            
                
                header("Location: ../index.php");
                exit();
            }else{
                $_SESSION['error_message'] = "Filed to create a user sql error :" . mysqli_error($con);
                header("Location: ../signup.php");
                exit();
            }
    }
        else
        {
            $_SESSION['error_message'] = "User already exists";
            header("Location: ../signup.php");
            exit();
        }
    }
    else
    {
        $_SESSION['error_message'] = "Please enter username, email and password";
        header("Location: ../signup.php");
        exit();
    }
}
?>