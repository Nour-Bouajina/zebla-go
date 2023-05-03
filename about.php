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
  <link rel="stylesheet" href="style/style_about.css">
  
  <title>About Us</title>
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
 
          <li><a href="events.php">Leaderboard</a></li>
          <li><a href="contact_us.php">Contact</a></li>
          <li class="login_btn"><a href="<?php echo $profile_link; ?>" class="btn"><?php echo $profile_text; ?></a></li>
               
        </div>
      </ul>
    </nav>

    
    <div class="about-section">
      <h1>About Us</h1>
    </div>

</header>




    <br><br><br>

    <h2 style="text-align:center">What is Zebla GO ?</h2>

    <div class="paragraph_container">

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Sed in mi vitae dolor euismod suscipit. Suspendisse sit amet ex ligula. 
        Nulla facilisi. Fusce vel tincidunt odio. Aliquam blandit, libero ut porttitor tristique,
         ex sapien tincidunt orci, ut convallis purus eros at metus.
      </p>

    </div>

    <br><br><br>

    <h2 style="text-align:center">Our Team</h2>

    <div class="row">

      <div class="column">

        <div class="card">

          <img src="/img/shrek.jpg" alt="Omar">

          <div class="container">

            <h2>Omar Mbarki</h2>
            <p class="title">CEO & Founder</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>jane@example.com</p>

            <br>
            
          </div>

        </div>

      </div>
    
      <div class="column">

        <div class="card">

          <img src="/img/Andrew ng.jpg" alt="Louay">

          <div class="container">

            <h2>Louay Ben Nessir</h2>
            <p class="title">Machine learning Director</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>mike@example.com</p>  
            
            <br>

          </div>

        </div>

      </div>
    
      <div class="column">
        
        <div class="card">
          
          <img src="/img/palmier.jpg" alt="Nour" >
          
          <div class="container">

            <h2>Nour Bouajina</h2>
            <p class="title">Designer</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>john@example.com</p>

            <br>
          
          </div>
        
        </div>
     
      </div>

    </div>



    <!-- <section class="why_join">

      <div id="clean_env">
        <img src="img\earth.png">
        <h3>clean environment</h3>
        
      </div>

      <div id="community">
          <img src="img\Community.png">
          <h3>boost sense of community</h3>
          
      </div>

      <div id="awareness">
        
          <img src="img\think-green.png">
          <h3>Spread awareness</h3>
          
      </div>

      <div id="have_fun">

          <img src="img\have_fun.png">
          <h3>Have fun</h3>
          
      </div>

    </section>  -->



    <br><br><br>

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
    </div>



</body>

</html>