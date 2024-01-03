 <?php

@include 'config.php';

	session_start();

	if(!isset($_SESSION['name'])){
   	header('location:login_form.php');
	}

	$select = "SELECT AVG(Early_game_gold_earned) AS ealry , AVG(Middle_game_gold_earned) AS middle , AVG(late_game_gold_earned) AS late FROM `user_game_data` WHERE summoner_name = '".$_SESSION['summoner_name']."'";
	$gold = mysqli_query($conn, $select);
	$playergold = mysqli_fetch_row($gold);

	$lane_to_table = [1=>'bottom',2=>'top_lane',3=>'middle',4=>'jungle',5=>'support'];

	$select = "SELECT AVG(Early_game_gold_earned) AS ealry , AVG(Middle_game_gold_earned) AS middle , AVG(late_game_gold_earned) AS late FROM `".$lane_to_table[$_SESSION['main_lane']]."`";
	$gold = mysqli_query($conn, $select);
	$progold = mysqli_fetch_row($gold);

?> 

<!Doctype HTML>
<html>
<head>
	<title>RoleFinder Dashbaord</title>
	<link rel="stylesheet" href="css/DashboardStyle.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 
  <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&family=Montserrat:ital,wght@0,100;0,500;0,700;1,700&family=Poppins:wght@400;500;600;700&family=Raleway:wght@300;900&display=swap" rel="stylesheet">
</head>

<body>



	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span><i class="ri-sword-fill"></i></span>Role Finder</p>
  <a href="Index.html" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Home</a>
  <a href="Champions.html"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Champions</a>
  <a href="Stats.html"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Stats</a>
  <a href="GameModes.html"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Game Modes</a>
  <a href="ProMatches.html"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Pro Macthes</a>
  <a href="AboutUs.html"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;About Us</a>
  <a href="PremiumPackage.html"class="icon-a" style="font-size:18px;font-weight: 600; font-style: italic;cursor:pointer; color: black; background :#f0f0f0;box-shadow: 0 0 5px #29fd53, 0 0 10px #29fd53, 0 0 20px #00f, 0 0 30px #00f; margin-top: 100px; "><i class="ri-sword-fill"></i> &nbsp;&nbsp;Role Changer</a>
  <a href="PremiumPackage.html"class="icon-a" style="font-size:18px;font-weight: 600;cursor:pointer;font-style: italic; color: black ; background :rgb(255, 255, 255);box-shadow: 0 0 5px #00f, 0 0 10px #00f, 0 0 20px #29fd53, 0 0 30px #29fd53;margin-top: 20px;"><i class="ri-sword-fill"></i> &nbsp;&nbsp;Role Improver</a>
  

</div>
<div id="main">

	<div class="head">

	<?php
			$sql = "SELECT * FROM user_form WHERE name='" . $_SESSION['name'] . "'";
			// $sql = "SELECT * FROM user_form";
			$results = mysqli_query($conn, $sql);
			if (mysqli_num_rows($results) > 0) {
				while ($row = mysqli_fetch_assoc($results)) {
					?> 

		<div class="hello-section">
			<h1 class="glow-heading">Hello <span><?php echo $_SESSION['name']?> </span></h1>
			<h2 class="logo2"><i class="ri-sword-fill"></i></h2>
			<p>Your Statistics against pro players are shown Below</p>
		</div>

		<div class="user-details">
			<div class="profile">

				<img src="Images/user.avg" class="pro-img" />
						<p> <?php echo $row['summoner_name']?>  </p>  
						<p> <?php echo $row['region_type']?>  </p>  
			</div>
		</div>
		
</div>

	<div class="clearfix"></div>
	<br/>
	
	<div class="flexbox-container">
			<div class="item item-1">
				<div class="graph" id="graph1"></div>
				Early Game Gold
			</div>
            <div class="item item-2">
				<div class="graph" id="graph2"></div>
				MidGame Gold
			</div>
            <div class="item item-3">
				<div class="graph" id="graph3"></div>
				Late Game Gold
			</div>
	</div>



  
	<div class="clearfix"></div>
	<br/><br/>
	
	<div class="col-div-8">
		
		<div class="content-box-1">
			
				<div class="item item-15">
					
					<img src="Images/Fight.gif" alt="" class="fight"> 
					
				
				</div>
				<div class="item item-16">
						
	
			<p></p>	<p class='udsn'> Summoner Name: <?php echo $row['summoner_name']?>  </p>  
				<p class='udsn'> Current Role: <?php echo $lane_to_table[$_SESSION['main_lane']]; ?>   </p> 

			<h3 class="ot1" >Best Role for you based on the statistics are: </h3>
					<p class="answer" style="font-size: 2em; color: #red;"><span class="rolebutton"> <?php
											$ch = curl_init();
											$curlConfig = array(
												CURLOPT_URL            => "localhost:5000/test",
												CURLOPT_POST           => true,
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_POSTFIELDS     => array(
													'early' => $playergold[0],
													'mid' => $playergold[1],
													'late' => $playergold[2],
													'summoner_name' => $_SESSION['summoner_name']
												)
											);
											curl_setopt_array($ch, $curlConfig);
											$result = curl_exec($ch);
											curl_close($ch);
											
											echo $result ; 
											 ?> </span></p> 
		

				</div>
				<div class="item item-17"> 
					<p>$30 per Month subscription</p>
					<a href="PremiumPackage.html"><button class="premiumButton">Check out Premium Package</button></a>
				</div>
				

			
			
	</div>


		
	
</div>



<?php  }}?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Script/dashboardCss.js"></script>
<script src="Script/plotly-2.20.0.min.js"></script> 
<script>
	var graph1div = document.getElementById('graph1');
	Plotly.newPlot(
		graph1div,
		
		[{ 
			values: [<?php echo $playergold[0]; ?>, <?php echo $progold[0]; ?>],
			type:'pie',
			hole: .9,  

		}],
		{ 	
			paper_bgcolor: "rgba(0,0,0,0)" ,
			margin: { t: 0 ,r: 0 , l: 0 , b: 0 },
			width: graph1div.clientWidth,
			height: graph1div.clientHeight,
			showlegend:false,
			autosize:false,
			
			
		}
		,
		{displayModeBar: false}

		);
		
	var graph1div = document.getElementById('graph2');
		Plotly.newPlot(
		graph1div,
		
		[{ 
			values: [<?php echo $playergold[1]; ?>, <?php echo $progold[1]; ?>],
			type:'pie',
			hole: .9,  
		
			
		}],

		
		{ 	
		
			paper_bgcolor: "rgba(0,0,0,0)" ,
			margin: { t: 0 ,r: 0 , l: 0 , b: 0 },
			width: graph1div.clientWidth,
			height: graph1div.clientHeight,
			showlegend:false,
			autosize:false
			
		}
		,
		{displayModeBar: false}
		);

		var graph1div = document.getElementById('graph3');
	Plotly.newPlot(
		graph1div,
		[{ 
			values: [<?php echo $playergold[2]; ?>, <?php echo $progold[2]; ?>],
			type:'pie',
			hole: .9,  
		}],
		{ 	
			paper_bgcolor: "rgba(0,0,0,0)" ,
			margin: { t: 0 ,r: 0 , l: 0 , b: 0 },
			width: graph1div.clientWidth,
			height: graph1div.clientHeight,
			showlegend:false,
			autosize:false
		}
		,
		{displayModeBar: false}
		);

		var graph1div = document.getElementById('graph16');
	Plotly.newPlot(
		graph16div,
		[{ 
			values: [70, 30],
			type:'scatter',
			hole: .9,  
		}],
		{ 	
			paper_bgcolor: "rgba(0,0,0,0)" ,
			margin: { t: 0 ,r: 0 , l: 0 , b: 0 },
			width: graph16div.clientWidth,
			height: graph16div.clientHeight,
			showlegend:false,
			autosize:false,modeBarButtonsToRemove: ['pan2d']
		},
		{displayModeBar: false}
		);


</script>

</body>


</html>
