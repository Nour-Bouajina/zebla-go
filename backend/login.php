<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password))
    {
        $stmt = mysqli_prepare($con, "SELECT user_id, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            if(password_verify($password, $stored_password))
            {
                $_SESSION['user_id'] = $row['user_id'];
                
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
            }
            else
            {
                $_SESSION['error_message'] = "Incorrect password";
                header("Location: ../login.php");
                exit();
            }
        }
        else
        {
            $_SESSION['error_message'] = "User does not exist";
            header("Location: ../login.php");
            exit();
        }
    }
    else
    {
        $_SESSION['error_message'] = "Please enter email and password";
        header("Location: ../login.php");
        exit();
    }
}
?>