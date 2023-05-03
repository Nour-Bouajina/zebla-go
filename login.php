<?php
session_start();
include("backend/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_login.css">
    <title>Login</title>
</head>


<body>
    
    <div class="form">
        <ul class="tab-group">
            <li class="tab"><a href="signup.php">Sign Up</a></li>
            <li class="tab active"><a href="login.php">Login</a></li>
        </ul>

        <div id="login">   
            <h1>Welcome Back!</h1>
            <?php handel_messges() ?>
            
            <form action="backend/login.php" method="post">
                <div class="field-wrap">
                    <input type="email" name="email" required autocomplete="off" placeholder="E-mail"/>
                </div>
                <div class="field-wrap">
                    <input type="password" name="password" required autocomplete="off" placeholder="Password"/>
                </div>
        
                <p class="forgot"><a href="#">Forgot Password?</a></p>
        
                <button class="button button-block">Log In</button>
        
            </form>
        
        </div>
    
    </div> 

    <footer>
        <a href="index.php">Back home</a>
    </footer>
    
</body>
</html>
