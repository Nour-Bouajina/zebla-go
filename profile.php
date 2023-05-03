<?php 
        session_start();
        include("backend/connection.php");
        include("backend/functions.php");

        $user = curr_user_info()

?>

<script>
function openTab(evt, TabName) {
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(TabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/profile.css">
    <title>Zebla GO</title>
</head>
<body>
<header></header>

<div class="parent">

<div class="sidenav">
<img src = <?= ($user['pic_link'] == '') ? 'img\default_pfp.png':$user['pic_link'] ?> ></br>
  <button class="edit-profile-btn" onclick="openTab(event, 'editprofile')">Edit Profile</button>
  <div class="achievements">
  <hr>
    <h2>Achievements</h2>
    <ul>
      <li>Finish up some event!</li>
    </ul>
  </div>
</div>

<div class = "tabdiv">
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Profile')" id="default">Profile</button>
  <button class="tablinks" onclick="openTab(event, 'currrent')">Active Events</button>
  <button class="tablinks" onclick="openTab(event, 'old')">History</button>
</div>




<div id="Profile" class="tabcontent">
<h1>Welcome back , <?=$user['user_name']?> ! </h1>
            <?php handel_messges() ?>
            <h2>Personal Information:</h2>
            <p><strong>Username: </strong><?= $user['user_name']; ?></p>
            <p><strong>Last name: </strong><?= $user['lastname']; ?></p>
            <p><strong>Points: </strong><?= $user['points']; ?></p>
            <p><strong>Email: </strong><?= $user['email']; ?></p>
            <p><strong>bio: </strong><?= $user['bio']; ?></p>
            <form action="backend\logout.php" method="post">
                <button type="submit" name="logout" value="logout">logout</button>
            </form>
</div>



<div id="editprofile" class = "tabcontent">
<form action="backend\update_profile.php" method="post" enctype="multipart/form-data">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" >

  <label for="lastname">Last name :</label>
  <input type="text" id="lastname" name="lastname" >

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" >

  <label for="bio">Bio:</label>
  <textarea id="bio" name="bio"></textarea>

  <label class="upload-btn">Uplaod profile image</label>
  <input type="file" id="pfp_image" name="pfp_image" ></br>

  <button type="submit">Submit</button>
  <button class="reset" onclick = "openTab(event, 'Profile')">Cancel</button>
</form>

<h2>Change Password:</h2>
            <form action="backend\change_password.php" method="post">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required><br>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required><br>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>

                <button type="submit" value="Change Password">Change Password</button>
                <?php handel_messges() ?>

</form>

</div>

<div id="currrent" class="tabcontent">
  <?php get_user_articals("new") ?>


</div>

<div id="old" class="tabcontent">
  <?php get_user_articals("old") ?>
</div>

</div>

</div>
</div>

</body>

<script>document.getElementById("default").click();</script>
</html>