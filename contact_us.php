<?php
session_start();

if (isset($_COOKIE[session_name()]) && isset($_SESSION['user_id'])) {
    $profile_link = 'profile.php'; 
    $profile_text = 'Profile';
} 
else {

    $profile_link = 'login.php'; 
    $profile_text = 'Login';
}
?>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/Style_contact_us.css">
  
  <title>Contact Us</title>
</head>

<body>

<header class="header">
        
<nav class="navbar">
       
       <div class="logo">ZEBLA <span>GO</span> </div>  <!-- LOGO -->
 
         <!-- NAVIGATION MENU -->
         <ul class="nav-links">
 
         <!-- NAVIGATION MENUS -->
         <div class="menu">
 
                 <li><a href="index.php">Home</a></li>
                 <li><a href="about.php">About</a></li>
                 
                 <li class="services">
 
                   <a href="events.php">Events</a>
 
                   <!-- DROPDOWN MENU -->
                   <ul class="dropdown">
                      <li><a href="events.php#your-events">Your events</a></li>
                      <li><a href="events.php#all-events">All events</a></li>
                      <li><a href="events.php#map">Map</a></li>
                   </ul>
                   
                 </li> 
 
                 <li><a href="leaderboard.php">Leaderboard</a></li>
                 <li><a href="contact_us.php">Contact</a></li>
                 <li class="login_btn"><a href="<?php echo $profile_link; ?>" class="btn"><?php echo $profile_text; ?></a></li>
               
             </div>
           </ul>
       </nav>


  <div class="contact-section">
      <h1>Contact Us</h1>
    </div>

    <div class="contact-container">

      <br><br><br>

      <h2 style="text-align:center">Have any queries?</h2>
      <h1 style="text-align:center">We're here to help!</h1>

      <br>

      <div class="container">
        <div class="box">Project ideas<br><br><span>+216 71 444 123</span></div>
        <div class="box">Complaints<br><br><span>+216 71 555 123</span></div>
        <div class="box">Technical team<br><br><span>+216 71 666 123</span></div>
        <div class="box">Recruitment<br><br><span>+216 71 777 123</span></div>
      </div>

      <br><br><br>

    
      <h2 style="text-align:center">Don't be a stranger!</h2>
      <h1 style="text-align:center">You tell us. We listen.</h1>

      <br>

      <div class="contact-form-container">

        <div class="form-container">

          <form action="action_page.php">
        
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">
        
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">
        
            <label for="country">Country</label>
            <select id="country" name="country">
              <option value="australia">Tunisia</option>
              <option value="canada">Canada</option>
              <option value="usa">USA</option>
              <option value="australia">France</option>
              <option value="canada">Spain</option>
              <option value="usa">Moroco</option>
              <option value="australia">Australia</option>

            </select>
        
            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
        
            <input type="submit" value="Submit">
        
          </form>

        </div>

      </div>

      <br><br><br>


    </div>

    <div class="footer-container">

      <div class="footer">
          <div class="footer-heading footer-1">

            <h2>About Us</h2>
             <a href="#">Blog</a>
             <a href="#">Demo</a>
             <a href="#">Blog</a>
             <a href="#">Blog</a>

          </div>

          <div class="footer-heading footer-2">

            <h2>Contact Us</h2>
             <a href="#">Jobs</a>
             <a href="#">Support</a>
             <a href="#">Sponsorships</a>

          </div>

          <div class="footer-heading footer-3">

            <h2>Social Media</h2>
             <a href="#">Facebook</a>
             <a href="#">instagram</a>
             <a href="#">Twitter</a>
             <a href="#">Youtube</a>

          </div>

          <div class="footer-email-form">

            <h2>Join our newsletter now !</h2>
            <input type="email" placeholder="Enter your email adress">
            <input type="submit" value="sign up" id="footer-email-btn">

          </div>

      </div>



  </body>
</html>