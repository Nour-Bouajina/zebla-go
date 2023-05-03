<?php
session_start();
include("backend/functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_login.css">
    <script src="script.js"></script> 
    <title>Signup!</title>
</head>

<body>
    
  <div class="form">
    <ul class="tab-group">
      <li class="tab active"><a href="#signup">Sign Up</a></li>
      <li class="tab"><a href="login.php">login</a></li>
    </ul>
  
    <div id="signup">
      <h1>Sign Up for Free</h1>
      <form method="POST" action="backend/signup.php">
      <?php handel_messges() ?>

        <div class="top-row">
          <div class="field-wrap">
            <input type="text" name="user_name" required autocomplete="off" placeholder="Name" />
          </div>
          <div class="field-wrap">
            <input type="text" name="lastname" required autocomplete="off" placeholder="Last Name"/>
          </div>
        </div>
        <div class="field-wrap">
          <input type="email" name="email" required autocomplete="off" placeholder="E-mail"/>
        </div>
        <div class="field-wrap">
          <input type="password" name="password" required autocomplete="off" placeholder="Password"/>
        </div>
        <button type="submit" class="button button-block">Get Started</button>
      </form>


  </div>
  <footer>
        <a href="index.php">Back home</a>
  </footer>

</body>
</html>

