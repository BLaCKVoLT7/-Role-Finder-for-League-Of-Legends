<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $summoner_name = $_POST['summoner_name'];
   $main_lane = $_POST['main_lane'];
   $region_type = $_POST['region_type'];
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         // download matches
         $ch = curl_init();
         $curlConfig = array(
            CURLOPT_URL            => "localhost:5000/downloadmatches",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
               'summoner_name' => $_POST['summoner_name'],
               'server_name' => $_POST['region_type'],
            )
         );
         curl_setopt_array($ch, $curlConfig);
         $result = curl_exec($ch);
         curl_close($ch);
         // ==========
         $insert = "INSERT INTO user_form(name, email, password,summoner_name,main_lane,region_type,user_type,rf_role) VALUES('$name','$email','$pass','$summoner_name','$main_lane','$region_type','$user_type','$main_lane')";
         mysqli_query($conn, $insert);
         // to enter the dummy data
         $early = rand(0,300);
         $mid = rand(0,500);
         $late = rand(0,2000);
         $insert = "INSERT INTO `user_game_data` (`user_email`, `game_number`, `Early_game_gold_earned`, `Middle_game_gold_earned`, `late_game_gold_earned`) VALUES ('$email', '1','$early', '$mid', '$late')";
         mysqli_query($conn, $insert);
         
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
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
        <button type = "button"><a href="login_form.php" class="user"><i class="ri-user-shared-2-line"></i></i>Login</a></button>
            
           
           

            <div class="bx bx-menu" id="menu-icon"></div>

        </div>

</header>

<div class="form-container">

   <form action="" method="post">
      <i class="ri-user-add-fill" style="font-size: 2em; color:#29fd53">
      <h3   style="color:#11099A;">  Sign Up </h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      if(isset($insert)){
         echo '<span class="error-msg">'.$insert.'</span>';
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <input type="text" name="summoner_name" required placeholder="Enter your Summoner name">
      <select name="main_lane" >
         <option value="2">Top</option>
         <option value="3">Mid</option>
         <option value="1">ADC</option>
         <option value="4">Jungle</option>
         <option value="5">Support</option>
      </select>
      <select name="region_type">
         <option value="br1">BR (BR1)</option>
         <option value="eub1">EUNE (EUN1)</option>
         <option value="euw1">EUW (EUW1)</option>
         <option value="la1">LAN (LA1)</option>
         <option value="la2">LAS (LA2)</option>
         <option value="na1">NA (NA1)</option>
         <option value="oce">OCE (OCE)</option>
         <option value="ru1">RU (RU1)</option>
         <option value="tr">TR (TR1)</option>
         <option value="jp1">JP (JP1)</option>
         <option value="kr">KR (KR)</option>
         <option value="ph2">PH (PH2)</option>
         <option value="sg2">SG (SG2)</option>
         <option value="tw2">TW (TW2)</option>
         <option value="vn2">VN (VN2)</option>
      </select>
      <select name="user_type">
         <option value="user">Normal User</option>
         <option value="admin">Pro-player</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>



</body>
</html>