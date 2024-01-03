<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['name'] = $row['name'];
         $_SESSION['summoner_name'] = $row['summoner_name'];
         $_SESSION['region_type'] = $row['region_type'];
         $_SESSION['main_lane'] = $row['main_lane'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['name'] = $row['name'];
         $_SESSION['summoner_name'] = $row['summoner_name'];
         $_SESSION['region_type'] = $row['region_type'];
         $_SESSION['main_lane'] = $row['main_lane'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&family=Montserrat:ital,wght@0,100;0,500;0,700;1,700&family=Poppins:wght@400;500;600;700&family=Raleway:wght@300;900&display=swap" rel="stylesheet">
</head>
<body>
   
<header>
        <a href="#" class="logo"><i class="ri-sword-fill"></i><span>Role Finder</span></i></a>

        <ul class = "navbar">
            <li><a href="Index.html">Home</a></li>
            <li><a href="Champions.html">Champions</a></li>
            <li><a href="GameModes.html">Game Modes</a></li>
            <li><a href="Stats.html">Stats</a></li>
            <li><a href="ProMatches.html">Pro Matches</a></li>
            <li><a href="AboutUs.html">About Us</a></li>
        </ul>

        <div class="main">
        
            <button type = "button"><a href="register_form.php" class="user"><i class="ri-user-add-fill"></i>Sign Up</a></button>
           
           

            <div class="bx bx-menu" id="menu-icon"></div>

        </div>

    </header>

<div class="form-container">

   <form action="" method="post">
   <i class=></i>
   <i class="ri-user-shared-2-line" style="font-size: 2em; color:#29fd53">
      <h3   style="color:#11099A;">  Login </h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>

</div>

</body>
</html>