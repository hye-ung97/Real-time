<?php
    session_start();
        
    $conn=mysqli_connect("host","user","password","database");

    mysqli_set_charset($conn,'utf8');

    if(!isset($_SESSION['id']))
	{
		header('Location:real-login.php');
	}
	$Id =$_SESSION['id'];
?>

<!DOCTYPE HTML>
<!--
	Linear by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
        <title>SOOB by Rubys</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
        </noscript>
        
        <style>
        div, ul, li { margin:0; padding:0; }
        #nav-wrapper
        {
            background: rgba(0,0,0,.1);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        
        #nav > ul
        {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #nav > ul > li
        {
            display: inline-block;
            border-right: 1px solid;
            border-color: rgba(255,255,255,.1);
        }
        
            #nav > ul > li:last-child
            {
                padding-right: 0;
                border-right: none;
            }

            #nav > ul > li > a,
            #nav > ul > li > span
            {
                display: inline-block;
                padding: 1.5em 1.5em;
                letter-spacing: 0.06em;
                text-decoration: none;
                text-transform: uppercase;
                font-size: 1.1em;
                outline: 0;
                color: #FFF;
            }

            #nav li.active a
            {
                color: #FFF;
            }

            #nav > ul > li > ul
            {
                display: none;
            }
            #nav ul ul {
                display:none;
                position:absolute;
                background-color:rgba(0,0,0,.3);
                padding: 1.5em 1.5em;
                letter-spacing: 0.06em;
                color: #FFF !important;
                text-decoration: none;
                text-transform: uppercase;
                font-size: 1.1em;
                outline: 0;
            }
            #nav ul li:hover ul {
                display: block;
            }
            #nav ul ul li {
                float:none;
            }
            #nav a {
                color: #FFF !important;
            }

            .img_cal1{
                background-image:url('images/calendar.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 12%; height: 200px; display: inline-block;
            }
            .img_cal2{
                background-image:url('images/calendar2.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 12%; height: 110px; display: inline-block;
            }
            .img_keyword{
                display:inline-block; font-size: 220%; position: absolute; top: 20%; left: 14%; color: #777;
            }
            .img_keyword:hover{
                border-bottom: 2px solid;padding-bottom: 1%;
            }
            .img_cat{
                display:inline-block; font-size: 150%; position: absolute; left: 50%; top: 20%;
            }
            .img_site{
                display:inline-block; font-size: 150%; position: absolute; left: 65%; top: 20%;
            }
            .img_time{
                display:inline-block; font-size: 150%; position: absolute; left: 80%; top: 20%;
            }
        </style>
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
				<!-- Nav -->
				<nav id="nav">
					<ul>
                        <li class="active"><a href="home.php">Homepage</a></li>
						<li><a href="real-time.php">Real-Time</a></li>
						<li><a href="food.php">Food</a></li>
                        <li><a href="alert.php">Alert <span style="color: red; font-weight: bold;"> -
                        <?php
                        $sql = 'select * from alarm where checked=0 and id="'.$Id.'" order by time desc';
                        $result = mysqli_query($conn, $sql);
                        $cnt = mysqli_num_rows($result);
                        if($cnt!=0){
                            echo $cnt;
                        }
                        ?>
                        </span></a></li>
						<li><a href="#">MY PAGE</a>
							<ul>
								<li><a href="mypage.php">EDIT PROFILE</a></li>
								<li><a href="keyword.php">EDIT KEYWORD</a></li>
							</ul>
						</li>
                        <li><a href="logout.php">LOGOUT</a></li>
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
                    <h1><a href="#">SOOB</a></h1>
					<span class="tag">By Rubys</span>
				</div>
			</div>
		</div>
	<!-- Header --> 

	<!-- Main -->
		<div id="main">
			<div id="content" class="container">
				<section>
					<header>
						<h2>Alert</h2>
						<span class="byline">You can receive keyword notifications.</span>
                    </header>

                    <hr style="padding: 2em 0 0 0; margin:0;">

                    <!-- contents -->                  
                    <?php
                        $sql = 'select * from alarm where id="'.$Id.'" order by time desc';
                        $result = mysqli_query($conn, $sql);
                        $cnt = mysqli_num_rows($result);

                        while($row = mysqli_fetch_array($result)){
                            if($cnt==1){
                                echo '<div style="position: relative;"><div class="img_cal2"></div>';
                            }
                            else{
                                echo '<div style="position: relative;"><div class="img_cal1"></div>';
                            }
                            if(!$row["checked"]){
                                $bold="bold";
                            }
                            else{
                                $bold="300";
                            }
                            if(strcasecmp($row["site"],"naver") == 0){
                                $site = "https://search.naver.com/search.naver?where=nexearch&query=";
                            }
                            else if(strcasecmp($row["site"],"daum") == 0){
                                $site = "https://search.daum.net/search?w=tot&q=";
                            }
                            else{
                                $site = "https://search.daum.net/nate?w=tot&q=";
                            }
                            echo '<a href="'.$site.$row["keyword"].'" target="_blank"><div class="img_keyword" style="font-weight:'.$bold.'"> '.$row["keyword"].'</div> </a>
                            <div class="img_cat"> '.$row["cat"].'</div>
                            <div class="img_site"> '.strtoupper($row["site"]).'</div>
                            <div class="img_time"> '.$row["time"].'</div></div>';
                            $cnt--;
                        }
                        $sql = 'update alarm set checked="1" where checked="0" and id="'.$Id.'"';
                        mysqli_query($conn, $sql);
                    ?>
                    
				</section>
			</div>
		</div>
	<!-- /Main -->

	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;SOOB : Something special Out Of Bigdata&rdquo;</blockquote>
				</section>
			</div>
		</div>
	<!-- /Tweet -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
					<header>
						<h2>Get in touch</h2>
						<div style="background-image:url('images/scan.png'); background-repeat:no-repeat; background-size: contain; width:auto; height:150px; background-position: center; margin-top: 2%;"></div>
					</header>
					<ul class="contact">
                        <li><a href="https://www.instagram.com/j.__min/" target="_blank" class="fa fa-twitter"><span>Twitter</span></a></li>
						<li class="active"><a href="https://www.instagram.com/hye._.ung/" target="_blank" class="fa fa-twitter"><span>Facebook</span></a></li>
						<li><a href="https://www.instagram.com/yeon_n21/" target="_blank" class="fa fa-twitter"><span>Pinterest</span></a></li>
					</ul>
				</section>
			</div>
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
                Design: <a href="#">RUBYS</a> 
			</div>
		</div>


	</body>
    <script>
        function initNotifications(){
            if(window.Notification) {
                Notification.requestPermission(function(permission){
                    if(permission=='granted') {
                        NotificationEnabled = true;
                        showNotification();
                    }
                });
            }
        }
        window.onload=initNotifications;

        function showNotification(){
            if(NotificationEnabled){
                <?php
                    $conn2=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
                    mysqli_set_charset($conn2,'utf8');

                    $sql = 'select * from alarm where id="'.$Id.'" and alarmcheck=0';
                    $result = mysqli_query($conn2,$sql);
                    $count=mysqli_num_rows($result);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $ArrKeyword[$i] = $row["keyword"];
                        $ArrTime[$i] = $row["time"];
                        $i=$i+1;
                    }
                ?>
                var Count = <?=$count?>;
                var kkksd = <?php echo json_encode($ArrKeyword)?>;
                var kkksd2 = <?php echo json_encode($ArrTime)?>;
                var i=0;

                while(i<Count){
                    var notification = new Notification( kkksd[i], {
                    body : kkksd2[i],
                    icon : 'http://capruby07.cafe24.com/capstone2/images/alarm.png'
                })
                    setTimeout(function(){ notification.close();}, 5000);
                    i++;
                }
                <?php 
                    $sql = 'update alarm set alarmcheck="1" where alarmcheck="0" and id="'.$Id.'"';
                    mysqli_query($conn2, $sql);
                ?>

            }
        }
    </script>
</html>