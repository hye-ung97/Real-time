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
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/set1.css" />
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
			
			/* body{
            background-image: url(http://p1.pichost.me/i/11/1344899.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 10px;
			} */

			.wrap {
				position: absolute;
				top: 60%;
				left: 46%;
				margin-top: 86px;
				margin-left: -89px;
				text-align: center;
				transform: translate(10%,-12%);
			}
 			 
			.but{
				display: block;
				max-width: 180px;
				text-decoration: none;
				border-radius: 4px;
				margin-left: 1.5em;
				padding: 0.5em 1em;
				color: rgb(106, 121, 137);
				background-color: white;
				border-color:#738190;
				width: 100px;
    			height: 50px;
			}

			.but:hover {
				background-color:rgb(106, 121, 137);
				padding: 0.5em 1em;
				color: rgba(255, 255, 255, 0.85);
				text-decoration: none;
				box-shadow: rgba(30, 22, 54, 0.7) 0 0px 0px 40px inset;
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
						<li><a href="home.php">Homepage</a></li>
						<li class="active"><a href="real-time.php">Real-time</a></li>
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
			<form action="modify.php" method="post" enctype="multipart/form-data">
				<section class="content bgcolor-1">
				<h2 class="nomargin-bottom" style="font-weight:bold; font-size:30px">Edit profile</h2>
				<div><?php echo $Id; ?> 님</div>
				<span class="input input--haruki">
					<input class="input__field input__field--haruki" type="password" name="password" id="password" required="required"/>
					<label class="input__label input__label--haruki" for="password-1">
						<span class="input__label-content input__label-content--haruki">Password</span>
					</label>
				</span>
				<span class="input input--haruki">
					<input class="input__field input__field--haruki" type="email" name="email" id="email" required="required"/>
					<label class="input__label input__label--haruki" for="email">
						<span class="input__label-content input__label-content--haruki">Email</span>
					</label>
				</span>

				<section class="row">
				
					<div class="wrap">
						<br><br>
						<input class= "but" type="submit" value="Update!" onclick="javascript:btn()">
						
						<!-- <a href="#" class="but">Update!</a> -->
					</div>

					<div style="clear:both;"></div>
				</section>

				<div style="height:30px;"></div>
		</form>
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
		<script> 
		function btn(){
			var pass = document.getElementById( 'password' ).value;
			var e = document.getElementById( 'email' ).value;
			if(pass.length!=0 && e.legth!=0 && e.search("@")>-1){
				alert("회원 정보가 수정되었습니다.");
			}
			
		} 
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
<?php


?>