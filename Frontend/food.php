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

<?php
    $sql = "select contents,COUNT(contents)as cnt from daum where cat='음식' GROUP by contents order by cnt DESC limit 3";
    $result = mysqli_query($conn, $sql);
    $i=1;
    $food=[];
    while($row = mysqli_fetch_array($result)){
        $food[$i] = $row["contents"];
        $i++;
	}
	$food[1] = "소고기 야채말이";
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
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		
		</noscript>

		<!-- slider -->
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

		<!-- css -->
		<link rel="stylesheet" href="eclipse.css?v3"></link>

		<!-- js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
		<script src="eclipse.js?v3"></script>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		google.charts.setOnLoadCallback(drawChart2);
		google.charts.setOnLoadCallback(drawChart3);

		function drawChart() {
			
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'time');
			data.addColumn('number','<?php echo $food[1]; ?>');
			
			data.addRows([
				<?php
					$sql = 'select DISTINCT userId ,COUNT(DISTINCT userId) as cnt, contents, time from insta WHERE contents="'.preg_replace("/\s+/", "", $food[1]).'" group by time, contents order by time';
					$result = mysqli_query($conn,$sql);
					$rowCnt=mysqli_num_rows($result);

					$cnt=1;
					while($row = mysqli_fetch_array($result)){
						if($cnt==$rowCnt){
							echo '["'.$row["time"].'",'.$row["cnt"].']';    
						}
						else{
							echo '["'.$row["time"].'",'.$row["cnt"].'],';    
						}

						$cnt++;
					}
				?>
			]);

			var options = {
				title: 'INSTAGRAM 게시글 변화 추이',
				curveType: 'function',
				legend: 'none',
				width: 500,
				height: 300,
				colors:['#f00']
			};

			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

			chart.draw(data, options);
		}
		</script>

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

		.recommend{
			background-color: white;
			border: 3px solid #d3d5f5;
			font-style: italic;
			border-radius: 10px;
			margin-right: 6px;
			cursor: pointer;
		}
		.recommend:hover{
			background-color: #d3d5f5;
			color: white;
			font-weight: bold;
		}
		.bestfood{
			border-radius: 9px;
			padding: 7%;
			text-align: center;
			font-size: 130%;
			font-weight: bold;
			border: 2px solid #d3d5f5;
		}
		.btnSelect{
			cursor: pointer;
			background-image:url('images/search.png'); 
			background-repeat:no-repeat; 
			background-position: center; 
			background-size: contain; 
			width: 70px; height: 33px; 
			background-color: #d3d5f5;
			border: 3px solid #d3d5f5;
			border-radius: 16px;
			margin-right: 20px;
		}
		.btnSelect:hover{
			box-shadow: 2px 3px 2px 0px #4c40402e;
		}
		.selectbar{
			height: 30px;
		}
		.tags{
			padding-right: 2%;
		}
		.hashblock{
			float:left;
			width: 45%;
		}
		.food{
			border-bottom: 3px solid #ffd968;
		}

		#outer {overflow: hidden; position: relative; width: 100%; padding: 150px; padding-bottom: 0px;    padding-top: 0px; padding-left: 0px; padding-right: 0px;}
		#inner {max-width: 1100px; padding: 100px 100px; margin: 0 auto; background: #ffffff; padding-bottom: 0px; padding-top: 0px; margin-left: 0px; margin-right: 0px;}

		.starblock:hover .star{ display:none; }
		.starblock:hover .grade{ display:block; }
		.grade{display : none; height: 48px;}
		.star{
			background-image:url('images/star.png'); background-repeat:no-repeat; background-position: center; background-size: contain; width: 40px; height: 33px; display: inline-block;
		}

		.smile, .soso, .bad{
			background-repeat:no-repeat; background-position: center; background-size: contain; width: 40px; height: 33px; display: inline-block;
		}
		.smilegrade, .sosograde{
			display: inline-block; visibility: hidden; transform: translateY(-20%);
		}
		.badgrade{display:none; transform: translateY(-20%);}
		.smileBlock, .sosoBlock, .badBlock{
			display: inline-block;
		}
		.smileBlock:hover .smilegrade{
			visibility: visible;
		}
		.badBlock:hover .badgrade{display:inline-block;}

		.info{font-weight: bold; margin-top: 2%;font-size: 140%;}
		.pw, .nw{
            display:inline-block; height: 20px; font-size:80%; margin-right: 1%;
        }
        .pw{color : blue;}
		.nw{color : red;}
		
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
						<h2>Food</h2>
						<span class="byline">You can get information about food.</span>
					</header>
					
					<hr style="padding: 2em 0 0 0; margin:0;">

					<div>
						<form action="food2.php" method='post'>
							<span style="font-weight: bold;">CONTENTS : </span>
							<select name='foodlist' class="selectbar" >
								<?php
									$sql = "select distinct contents from daum where cat='음식' ORDER BY contents";
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($result)){
										echo '<option value="'.$row["contents"].'">'.$row["contents"].'</option>';
									}
								?>
							</select>    
							<input class="btnSelect" type="submit" name="btnContents" value = " "/>
							
							<?php
								$sql = "select distinct contents from daum where cat='음식' order by time DESC limit 5";
								$result = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_array($result)){
									echo '<input class="recommend" type="submit" name="foodlist" value="#'.$row["contents"].'"/>';
								}
							?>

						</form>
					</div>
					<hr style="padding: 2em 0 0 0; margin: 2em 0 0 0;">
					<div style="height:30px;"> </div>

					<div>
						<div style="display: block; float: left; width: 13%;">
							<div class="bestfood">
								<?php echo '#'.$food[1]; ?>
							</div>
							<div style="margin-top: 30%;">
								<?php
									$sql = 'select url from image where contents="'.$food[1].'"limit 1';
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($result)){
										echo '<img src="'.$row["url"].'" style="width: 100%;">';
									}
								?>
							</div>
						</div>
						
						<div id="curve_chart" style="float:left;"></div> 
						<div class="hashblock">
							<?php
								$sql = 'select contents,time from daum where cat="음식" and contents="'.$food[1].'" group by contents';
								$result = mysqli_query($conn, $sql);
								
								while($row = mysqli_fetch_array($result)){
									if($row["time"]!=NULL){
										echo '<div style="margin-bottom: 1%;">"실시간 검색어" 오른 날 : ';
										echo '<span style="font-weight: bold;">'. substr($row["time"], 0, 10).'</span></div>';
									}
									
								}
							?>
							

							<div style="margin-bottom: 1%;"> 총 게시물수 : 
								<?php
									$sql = 'SELECT * FROM instaT WHERE contents = "'.preg_replace("/\s+/", "", $food[1]).'" ORDER by time DESC LIMIT 1';
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($result)){
										echo '<span style="font-weight: bold;">'. $row["total"].'</span>';
									}
								?>
							</div>
							<div style="margin-bottom: 1%;"> 
								<?php 
									$sql = 'SELECT hashtag , COUNT(hashtag) as cnt, contents FROM insta WHERE contents ="'.preg_replace("/\s+/", "", $food[1]).'"  GROUP BY hashtag ORDER BY cnt DESC limit 5';
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($result)){
										echo '<span class="tags"><a style="color: #8700ff94; font-weight: bold;" href="https://www.instagram.com/explore/tags/'.str_replace("#","",$row["hashtag"]).'" target="_blank">'.$row["hashtag"].'</a></span>';
									}
								?>
							</div>
							<div style="background-image:url('images/<?php echo $food[1]; ?>.PNG'); background-repeat:no-repeat; background-position: center; background-size: contain; height: 175px; margin-top: 2%; width: 315px;"></div>
						</div>
						<div style="clear:both;"></div>
					</div>

					<div style="height:30px;"> </div>	

					<!-- slider -->
					<div id="outer">
						<div id="inner">

							<section class="demowrap">
								<section class="demo">
									<div id="eclipse1">
										<div class="eclipse-slider">
											
											<?php 
												$sql = 'select distinct name, address, total from blogstore where contents = "'.$food[1].'" limit 5';
												$result = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($result)){
													echo '<div>';//start
													$name = $row["name"];
													$total = $row["total"];
													
													$sql2 = 'select naverlink from map where name="'.$name.'" limit 1';
													$result2 = mysqli_query($conn, $sql2);
													while($row2 = mysqli_fetch_array($result2)){
														echo '<div class="info"><a href="'.$row2["naverlink"].'" target="_blank">[ '.$name.' ]</a></div>';
													}
													echo '<div>'.$row["address"].'</div>';
															
													$positive=0; $negative=0;
													
													$sql3 = 'select name, count(feeling) as p from blogstorePN where feeling > 0 and name="'.$name.'" group by name';
													$result3 = mysqli_query($conn, $sql3);
													while($row3 = mysqli_fetch_array($result3)){
														$positive = $row3["p"];
													}

													$sql4 = 'select name, count(feeling) as n from blogstorePN where feeling < 0 and name="'.$name.'" group by name';
													$result4 = mysqli_query($conn, $sql4);
													while($row4 = mysqli_fetch_array($result4)){
														$negative = $row4["n"];
													}

													$pp=0; $np=0; $sum=0;
													$sum = $positive + $negative;
													$pp = $positive / $sum * 100;
													$pp = ceil($pp);
													$np = $negative / $sum * 100;
													$np = floor($np);


													$grade = 1;
													if($pp >= 85){
														$grade = $grade + 2;
													}
													else if($pp >= 65){
														$grade = $grade + 1;
													}

													if($total >= 1000){
														$grade = $grade + 2;
													}
													else{
														$tmp = $total/1500;
														$tmp = $tmp * 1.533;
														$tmp = $tmp +1;
														$grade = $grade + $tmp;
													}
													
													$grade = round($grade,1);
													$i=1;

													echo '<div class="starblock">';
													while($i <= $grade){
														echo '<div class="star"></div>';
														$i++;
													}
													echo '<div style="clear:both;"></div>
														<div class="grade"> '.$grade.' </div>
														</div>';


													echo '<div class="expressionBlock">
														<div class="smileBlock">
															<div class="smile" style="background-image:url(\'images/smile.png\');"></div>
															<div class="smilegrade"> '.$pp.'%</div>
														</div>
														<div class="sosoBlock">
															<div class="soso" style="background-image:url(\'images/soso.png\');"></div>
															<div class="sosograde">80%</div>
														</div>
														<div class="badBlock">
															<div class="bad" style="background-image:url(\'images/bad.png\');"></div>
															<div class="badgrade"> '.$np.'%</div>
														</div>
													</div>';

													$sql5='select word, count(feeling) as cnt from blogstorePN where feeling>0 and name = "'.$name.'" group by word order by cnt desc limit 5';
													$result5 = mysqli_query($conn, $sql5);
													echo '<div style="height: 20px;     line-height: 100%;">';
													while($row5 = mysqli_fetch_array($result5)){
														echo '<div class="pw">'.$row5["word"].'</div>';
													}
													echo '<div style="clear:both;"></div>';
													echo '</div>';

													$sql6='select word, count(feeling) as cnt2 from blogstorePN where feeling < 0 and name = "'.$name.'" group by word order by cnt2 desc limit 5';
													$result6 = mysqli_query($conn, $sql6);
													echo '<div style="height: 20px;    line-height: 100%;">';
													while($row6 = mysqli_fetch_array($result6)){
														echo '<div class="nw">'.$row6["word"].'</div>';
													}
													echo '<div style="clear:both;"></div>';
													echo '</div>';

													echo '</div>';//end
												}
												
											?>
										</div>
										<script>
											$('#eclipse1').eclipse();
										</script>
									</div>
								</section>
							</section>
						</div>
					</div>

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
				Design: <a href="#">RUBYS
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