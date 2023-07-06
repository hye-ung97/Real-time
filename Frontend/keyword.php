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
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/set2.css" />
		<!-- <link rel="stylesheet" type="text/css" href="css/default.css" /> -->
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<style>

		div, ul, li { margin:0; padding:0; }

		#nav
		{
			}
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
				/* #nav a {
				height:16px;
				color: #FFF !important;
				font-family:arial;
				font-size:12px;
				padding:0 10px 0 10px;
				text-decoration:none;
			} */
			}
			.table_st{
				width: 100% !important;
							border-top: 1px solid #444444;
							border-collapse: collapse;
			}
			.table_st th,.table_st td {
							border-bottom: 1px solid #8b8c8b61;
							padding: 10px;
			}
			.ta table{
				width: 80%;     text-align: center; transform: translateX(12%);
			}
			td{
				width: 50%;
			}

			.img1{
				cursor: pointer;
				background-image:url('images/magnifier-tool.png'); 
				background-repeat:no-repeat; 
				background-position: center; 
				background-size: 35px; 
				height: 33px; 
				/* margin-right: 20px; */
				margin:0px;
				margin-left:15px;
			}
			.img2{
				cursor: pointer;
				background-image:url('images/add.png'); 
				background-repeat:no-repeat; 
				background-position: center; 
				background-size: 35px; 
				height: 33px; 
				/* margin-right: 20px; */
				margin:0px;
				margin-left:15px;
			}
			.img3{
				cursor: pointer;
				background-image:url('images/delete-photo.png'); 
				background-repeat:no-repeat; 
				background-position: center; 
				background-size: 35px; 
				height: 33px; 
				/* margin-right: 20px; */
				margin:0px;
				margin-left:15px;
			}
	</style>
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
			<!-- <div id="blogMenu"> -->
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
						<h2>Edit Keyword</h2>
						<span class="byline">You can edit or search for your keywords.</span>
						</header>

						<hr style="padding: 2em 0 0 0; margin:0;">

						<section class="content" style="padding-bottom: 0px; margin-bottom: 0px;">
						
						<span class="input input--yoshiko">
							<form action="search.php" method="post">
								<div style="float: left;     width: 77%;">
									<input class="input__field input__field--yoshiko" type="text" id="search" name="search" required="required"/>
									<label class="input__label input__label--yoshiko" for="text">
										<span class="input__label-content input__label-content--yoshiko" data-content="keyword search">keyword search</span>
									</label>
								</div>
								<div style="float: left;" >
									<input class="btn btn-7 btn-7c btn-icon-only icon-arrow-right img1" type ="submit" value ="검색"/>
								</div>
								<div style="clear:both;"></div>
							</form>
						</span>
						<span class="input input--yoshiko">
							<form action="add.php" method="post">
								<div style="float: left;     width: 77%;">
									<input class="input__field input__field--yoshiko" type="text" id="keyword" name="keyword" required="required"/>
									<label class="input__label input__label--yoshiko" for="text">
										<span class="input__label-content input__label-content--yoshiko" data-content="keyword add">keyword add</span>
									</label>
								</div>
								<div style="float: left;">
									<input class="btn btn-7 btn-7g btn-icon-only icon-plus img2" type ="submit" value ="추가"/>
								</div>
								<div style="clear:both;"></div>
							</form>
						</span>
						</section>
						<!-- <form action="search.php" method="post">
						<input type="text" id="search" name="search" required="required" placeholder="keyword를 검색하세요 ">
						<input type="submit" value="검색">
						</form>
						<form action="add.php" method="post">
						<input type="text" id="keyword" name="keyword" required="required" placeholder="keyword를 입력하세요">
						<input type="submit" value="추가">
						<br>
						<br>
						</form> -->

						<hr style="padding: 2em 0 0 0; margin: 2em 0 0 0;">

					<?php
					    session_start();
    
						$conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
						mysqli_set_charset($conn,'utf8');

						$Id=$_SESSION['id'];
			
						$sql = "SELECT keyword FROM insertword where id='$Id'";
						$result = mysqli_query($conn,$sql);

						$count=mysqli_num_rows($result);

						echo "<form action=\"delete.php\" method=\"post\">";  
						echo "<div class='row' style='text-align: center;font-size: 200%;height: 53px;'>Keyword List</div>";
						// echo "<style>";
						// echo " table {
						// 	width: 80%;
						// 	border-top: 1px solid #444444;
						// 	border-collapse: collapse;
						//   }
						//   th, td {
						// 	border-bottom: 1px solid #444444;
						// 	padding: 10px;
						//   }";
						// echo "</style>";
						// echo "<center>";
						echo "<div class='ta' style='width:100%'><table class='table_st'>";
						echo "<tr><td style='font-weight: bold;'>KEYWORD</td><td style='font-weight: bold;'>CHECK</td></tr>";

						while($row = mysqli_fetch_assoc($result)){
							echo '<tr><td><H3>'.$row["keyword"]."</H3></td><td><H3><label><input type=\"checkbox\" id=\"select[]\" value='".$row["keyword"]."' name=\"select[]\" style=\"width:20px; height:20px\"></label></H3></td></tr>";
						}
						echo "</table></div>";
						echo"<div style='text-align: right;'>";
						echo"<input style=' border-radius: 6px; box-shadow: 0 5px #119e4d !important;' class=\"btn btn-7 btn-7i btn-icon-only icon-remove-2 img3 \" type=\"submit\" value =\"삭제\">";
						echo"</div>";
						// echo "<input type=\"submit\" value=\"삭제\">";
						echo"</form>";
						// echo "</center>";
						mysqli_free_result($result);
						mysqli_close($conn);
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

		<script src="js/classie.js"></script>
		<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script>
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
