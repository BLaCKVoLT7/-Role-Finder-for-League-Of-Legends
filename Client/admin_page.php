<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&family=Montserrat:ital,wght@0,100;0,500;0,700;1,700&family=Poppins:wght@400;500;600;700&family=Raleway:wght@300;900&display=swap" rel="stylesheet">
</head>
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
           

            <div class="bx bx-menu" id="menu-icon"></div>

        </div>  
</header>       
        
<div class="container">

   <div class="content">
      <h3>Hello, <span>Pro-Player</span></h3>
      <h1>welcome <span><?php echo $_SESSION['name'] ?></span></h1>
      <p style='color:#fff; font-style:italic; font-size:1.2em;'>Go to Dashboard to check your stats or Premium section to guide others</p>
      <a href="RoleFinderDashboard.php" class="btn">Dashboard</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

<footer>
            
            <div class="navigation">
                <div class="footerBar"><ul>
                    <li class="list">
                        <a href="https://github.com/BLaCKVoLT7">
                            <span class="icon"><i class="ri-github-fill"></i></ion-icon></span>
                            <span class="text">GitHub</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="https://www.linkedin.com/in/anushka-girakaduwa-314bb714a/">
                            <span class="icon"><i class="ri-linkedin-box-fill"></i></span>
                            <span class="text">Linked In</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="https://www.facebook.com/anushka.girakaduwa/">
                            <span class="icon"><i class="ri-facebook-box-fill"></i></ion-icon></span>
                            <span class="text">FaceBook</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="https://www.instagram.com/b_l_a_c_k_v_o_l_t/">
                            <span class="icon"><i class="ri-instagram-fill"></i></ion-icon></ion-icon></span>
                            <span class="text">Instagram</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="https://www.youtube.com/channel/UCj0ClEyC17HHRolOmt8w9EQ">
                            <span class="icon"><i class="ri-youtube-fill"></i></span>
                            <span class="text">Youtube</span>
                        </a>
                    </li>
                </ul>
                
                </div>
                
            </div>
    
        
    
        </footer>
    

<script type="text/javascript" src="Script/script.js"></script>

</body>
</html>