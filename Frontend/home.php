<?php     
	session_start();
    $conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
	mysqli_set_charset($conn,'utf8');
	
	if(!isset($_SESSION['id']))
	{
		header('Location:real-login.php');
	}
	$Id =$_SESSION['id'];
?>

<!DOCTYPE HTML>

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
        <style type="text/css">
            #scroll {height:30px;}
            #scroll2 {height:30px;}
            #scroll3 {height:30px;}
            </style>
            <script type="text/javascript">
            function textScroll(scroll_el_id) {
                this.objElement = document.getElementById(scroll_el_id);
                this.objElement.style.position = 'relative';
                this.objElement.style.overflow = 'hidden';

                this.objLi = this.objElement.getElementsByTagName('li');
                this.height = this.objElement.offsetHeight; 
                this.num = this.objLi.length; 
                this.totalHeight = this.height*this.num; 
                this.scrollspeed = 2; 
                this.objTop = new Array(); 
                
                for(var i=0; i<this.num; i++){
                    this.objLi[i].style.position = 'absolute';
                    this.objTop[i] = this.height*i;
                    this.objLi[i].style.top = this.objTop[i]+"px";
                }
            }

            textScroll.prototype.move = function(){
                for(var i=0; i<this.num; i++) {
                    this.objTop[i] = this.objTop[i] - this.scrollspeed;
                    this.objLi[i].style.top = this.objTop[i]+"px";
                }
                if(this.objTop[0]%this.height == 0){
                    this.jump();
                }else{
                    clearTimeout(this.timer);
                    this.timer = setTimeout(this.name+".move()",50);
                }
            }

            textScroll.prototype.jump = function(){
                for(var i=0; i<this.num; i++){
                    if(this.objTop[i] == this.height*(-2)){
                        this.objTop[i] = this.objTop[i] + this.totalHeight;
                        this.objLi[i].style.top = this.objTop[i]+"px";
                    }
                }
                clearTimeout(this.timer);
                this.timer = setTimeout(this.name+".move()",3000);
            }

            textScroll.prototype.start = function() {
                this.timer = setTimeout(this.name+".move()",3000);
            }
        </script>
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
					
			.b{
			background:#1AAB8A;
			color:#fff;
			border:none;
			position:relative;
			height:60px;
			font-size:1.2em;
			padding:0.8em 2em;
			cursor:pointer;
			transition:800ms ease all;
			outline:none;
			text-decoration: none !important;
   			font-weight: 300;
			}
			.b:hover{
			background:#fff;
			color:#1AAB8A;
			}
			.b:before,.b:after{
			content:'';
			position:absolute;
			top:0;
			right:0;
			height:2px;
			width:0;
			background: #1AAB8A;
			transition:400ms ease all;
			}
			.b:after{
			right:inherit;
			top:inherit;
			left:0;
			bottom:0;
			}
			.b:hover:before,.b:hover:after{
			width:100%;
			transition:800ms ease all;
            }
            
            .btnContents{
                background:white;
                border:2px solid white;
                font-size: 110%;
            }
            .btnContents , .rank{
                font-weight: bold;
            }

            .btnContents:hover{
                background-color: #f3eeee;
            }
			.siteName{
				float: left;
				/* padding-right: 5%; */
				font-weight: bold;
				font-size: 150%;
				text-align: left;
    			width: 14.5%;
			}

			.img_cal1{
                background-image:url('images/check.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 5%; height: 36px; display: inline-block;
            }
            .img_keyword{
                display:inline-block; font-size: 120%; position: absolute; top: 8%; left: 10%;
            }
            .img_cat{
                display:inline-block; font-size: 120%; position: absolute; left: 50%; top: 8%;
            }
            .img_site{
                display:inline-block; font-size: 120%; position: absolute; left: 65%; top: 8%;
            }
            .img_time{
                display:inline-block; font-size: 120%; position: absolute; left: 80%; top: 8%;
			}
			
			.img_cal2{
                background-image:url('images/edit.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 5%; height: 36px; display: inline-block;
			}
			.img_cal3{
                background-image:url('images/clipboard.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 5%; height: 36px; display: inline-block;
            }
		</style>
	</head>
	<body class="homepage">

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

	<!-- Featured -->
		<div id="featured">
			<div class="container">
				<header>
					<h2>Welcome to SOOB</h2>
				</header>
				<p><strong>SOOB</strong>은 1차원적인 정보를 넘어 정확하고 신속, 편리한 정보를 얻을 수 있도록 제작한 웹페이지입니다.<br>현재의 이슈를 가장 민감하게 반응하는 실시간 검색어와 최근 인기 트렌드인 음식 데이터를 바탕으로 분석한 결과를 제공합니다.<br>트렌드에 뒤쳐지지 않고 싶다면, <strong>SOOB</strong>을 이용해주세요!</p>
				<hr />
				<div class="row">
					<section class="4u">
						<span class="pennant"><span class="fa fa-briefcase"></span></span>
						<h3>Real - Time</h3>
						<p>3대 포털 사이트 실시간 검색어를 카테고리별로 한눈에 볼 수 있으며 연관 검색어를 통해 급상승 이유 예측이 가능하다.</p>
						<a href="real-time.php" class="button b">Read More</a>
					</section>
					<section class="4u">
						<span class="pennant"><span class="fa fa-lock"></span></span>
						<h3>Food</h3>
						<p>SNS와 블로그 게시물 분석을 통해 특정 음식에 대한 최근 트렌드를 알 수 있으며 신뢰성 있는 맛집 정보를 얻을 수 있다.</p>
						<a href="food.php" class="button b">Read More</a>
					</section>
					<section class="4u">
						<span class="pennant"><span class="fa fa-globe"></span></span>
						<h3>Alert</h3>
						<p>사용자의 관심 키워드가 실시간 검색어에 급상승할 때 실시간으로 알림 서비스를 제공받을 수 있다.</p>
						<a href="alert.php" class="button b">Read More</a>
					</section>
					
				</div>
			</div>
		</div>

	<!-- Main -->
		<div id="main">
			<div id="content" class="container">

				<div class="row">
					<section class="6u">
						<a href="real-time.php" class="image full"><img src="images/pic01.jpg" alt=""></a>
						<header>
							<h2><a href="real-time.php" style="color:#777;"> Real - Time </a></h2>
						</header>
                        <div>
                            <div class="siteName">NAVER</div>
                                <ul id="scroll"> 
                                <?php
                                    $sql = "select * from naver  order by time desc, rank limit 10";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)){
                                        echo '<li><span class="rank">'.$row["rank"].'위 </span><span><a style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" href="https://search.naver.com/search.naver?where=nexearch&query='.$row["contents"].'" target="_blank">'.$row["contents"].'</a>       </span>';
										$sql2 = "select yeon from relation where contents = '".$row["contents"]."' order by date limit 2";
										$result2 = mysqli_query($conn, $sql2);
										$site="https://search.naver.com/search.naver?where=nexearch&query=";
										while($row2 = mysqli_fetch_array($result2)){
											echo '<span><a href="'.$site.$row2["yeon"].'" target="_blank"># '.$row2["yeon"].'</a>       </span>';
										}
										echo '</li>';
									}
                                ?>
                                </ul>
                            <div style="clear:both"></div>
                        </div>
                        <div>
                            <div class="siteName">DAUM</div>
                                <ul id="scroll2"> 
                                <?php
                                    $sql = "select * from daum  order by time desc, rank limit 10";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)){
										$site="https://search.daum.net/search?w=tot&q=";
                                        echo '<li><span class="rank">'.$row["rank"].'위 </span><span><a style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" href="'.$site.$row["contents"].'" target="_blank">'.$row["contents"].'</a>       </span>';
										$sql2 = "select yeon from relation where contents = '".$row["contents"]."' order by date limit 2";
										$result2 = mysqli_query($conn, $sql2);
	
										while($row2 = mysqli_fetch_array($result2)){
											echo '<span><a href="'.$site.$row2["yeon"].'" target="_blank"># '.$row2["yeon"].'</a>       </span>';
										}
										echo '</li>';
									}
                                ?>
                                </ul>
                            <div style="clear:both"></div>
                        </div>
                        <div>
                            <div class="siteName">NATE</div>
                                <ul id="scroll3"> 
                                <?php
                                    $sql = "select * from nate  order by time desc, rank limit 10";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)){
										$site="https://search.daum.net/nate?w=tot&q=";
                                        echo '<li><span class="rank">'.$row["rank"].'위 </span><span><a style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" href="'.$site.$row["contents"].'" target="_blank">'.$row["contents"].'</a>       </span>';
										$sql2 = "select yeon from relation where contents = '".$row["contents"]."' order by date limit 2";
										$result2 = mysqli_query($conn, $sql2);
	
										while($row2 = mysqli_fetch_array($result2)){
											echo '<span><a href="'.$site.$row2["yeon"].'" target="_blank"># '.$row2["yeon"].'</a>       </span>';
										}
										echo '</li>';
									}
                                ?>
                                </ul>
                            <div style="clear:both"></div>
                        </div>

                        <script type="text/javascript">
                        var real_search_keyword = new textScroll('scroll'); 
                        real_search_keyword.name = "real_search_keyword"; 
                        real_search_keyword.start(); 

                        var real_search_keyword2 = new textScroll('scroll2'); 
                        real_search_keyword2.name = "real_search_keyword2"; 
                        real_search_keyword2.start(); 

                        var real_search_keyword3 = new textScroll('scroll3'); 
                        real_search_keyword3.name = "real_search_keyword3"; 
                        real_search_keyword3.start();

                        </script>

					</section>				
					<section class="6u">
						<a href="food.php" class="image full"><img src="images/pic02.jpg" alt=""></a>
						<header>
							<h2><a href="food.php" style="color:#777;"> Food </a></h2>
						</header>
						<div style="text-align: left;">
							<div style="position: relative;"><div class="img_cal3"></div>
							<div class="img_keyword"> 애호박찌개 </div>	
							<div style="position: relative;"><div class="img_cal3"></div>
							<div class="img_keyword"> 초계국수 </div>	
							<div style="position: relative;"><div class="img_cal3"></div>
							<div class="img_keyword"> 로제 파스타 </div>										
						</div>
					</section>				
				</div>

				<div class="row">
					<section class="6u">
						<a href="keyword.php" class="image full"><img src="images/pic03.jpg" alt=""></a>
						<header>
							<h2><a href="keyword.php" style="color:#777;">Keyword</a></h2>
						</header>
						<!-- keyword contents -->
						<div style="text-align: left;">
						<?php
							$sql = 'select * from insertword where id="'.$Id.'" order by time desc limit 3';
							$result = mysqli_query($conn, $sql);
							$cnt = mysqli_num_rows($result);
							if($cnt==0){
								echo '<div style="text-align:center;">키워드가 설정이 안되어 있습니다. 키워드를 설정해보세요.</div>';
							}
							else{
								while($row = mysqli_fetch_array($result)){
									echo '<div style="position: relative;"><div class="img_cal2"></div>';
									echo '<div class="img_keyword"> '.$row["keyword"].'</div>
										</div>';
								}
							}
							
						?>
						</div>
					</section>				
					<section class="6u">
						<a href="alert.php" class="image full"><img src="images/pic04.jpg" alt=""></a>
						<header>
							<h2><a href="alert.php" style="color:#777;">Alert</a></h2>
						</header>
						<!-- alert contents -->
						<div style="text-align: left;">
						<?php
							$sql = 'select * from alarm where id="'.$Id.'" order by time desc';
							$result = mysqli_query($conn, $sql);
							$i=0;
							$c=1;
							$cnt = mysqli_num_rows($result);
							if($cnt==0){
								echo '<div style="text-align:center;"> 키워드를 설정하여 ALERT 서비스를 받아볼 수 있습니다. 키워드를 먼저 설정해 주세요.</div>';
							}
							else{
								while($row = mysqli_fetch_array($result)){
									if(!$row["checked"]){
										$bold="bold";
									}
									else{
										$bold="300";
									}
	
									$date = date_create($row["time"]);
	
									if(in_array($row["keyword"],$contents)==false){
										echo '<div style="position: relative;"><div class="img_cal1"></div>';
										echo '<div class="img_keyword" style="font-weight:'.$bold.'"> '.$row["keyword"].'</div>
										<div class="img_cat"> '.$row["cat"].'</div>
										<div class="img_time"> '.date_format($date,"Y-m-d").'</div></div>';
										$c++;
									}
									$i++;
									$contents[$i] = $row["keyword"];
									if($c ==4) break;
								}
							}
							
						?>
						</div>
					</section>				
				</div>
			
			</div>
		</div>

	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;SOOB : Something special Out Of Bigdata&rdquo;</blockquote>
				</section>
			</div>
		</div>

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

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="#">RUBYS</a> 
			</div>
		</div>

	</body>
	<script>
        var NotificationEnabled = false;
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