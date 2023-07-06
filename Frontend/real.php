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

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" ){     
        
        if($_POST["nkeyword"]!=NULL)   {
            $reWord = $_POST["nkeyword"];
            $sn="https://search.naver.com/search.naver?where=nexearch&query=";
            $_SESSION["reWord"] = $reWord;
            $reWord2 = $_SESSION["reWord2"];
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            $site = "naver";
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real.php#catBlock';</script>";
        }
        else if($_POST["dkeyword"]!=NULL)   {
            $reWord = $_POST["dkeyword"];
            $sn="https://search.daum.net/search?w=tot&q=";
            $_SESSION["reWord"] = $reWord;
            $reWord2 = $_SESSION["reWord2"];
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock';</script>";
        }
        else if($_POST["nnkeyword"]!=NULL)   {
            $reWord = $_POST["nnkeyword"];
            $sn="https://search.daum.net/nate?w=tot&q=";
            $_SESSION["reWord"] = $reWord;
            $reWord2 = $_SESSION["reWord2"];
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock';</script>";
        }
        
        if($_POST["keyword2"]!=NULL)   {
            $reWord2 = $_POST["keyword2"];
            $_SESSION["reWord2"] = $reWord2;
            $reWord = $_SESSION["reWord"];
            $sn2="https://search.naver.com/search.naver?where=nexearch&query=";
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock2';</script>";
        }
        else if($_POST["dkeyword2"]!=NULL)   {
            $reWord2 = $_POST["dkeyword2"];
            $_SESSION["reWord2"] = $reWord2;
            $reWord = $_SESSION["reWord"];
            $sn2="https://search.daum.net/search?w=tot&q=";
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock2';</script>";
        }
        else if($_POST["nkeyword2"]!=NULL)   {
            $reWord2 = $_POST["nkeyword2"];
            $_SESSION["reWord2"] = $reWord2;
            $reWord = $_SESSION["reWord"];
            $sn2="https://search.daum.net/nate?w=tot&q=";
            $sDate = $_SESSION["sDate"];
            $eDate = $_SESSION["eDate"];
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock2';</script>";
        }

        if($_POST["period"]!=NULL){
            $sDate = $_POST["sdate"];
            $eDate = $_POST["edate"];
            $_SESSION["sDate"] = $sDate;
            $_SESSION["eDate"] = $eDate;
            echo "<script>location.href='http://capruby07.cafe24.com/capstone2/real-time.php#catBlock2';</script>";
        }
    }

    else{
        unset( $_SESSION['reWord'] );
        unset( $_SESSION['reWord2'] );
        if($_POST["period"]==NULL){
            $b = strtotime("-3days") ; 
            $c = date("Y-m-d" , $b) ;
        
            $sDate = $c;
            $eDate = date("Y-m-d");
            $_SESSION["sDate"] = $sDate;
            $_SESSION["eDate"] = $eDate;
        }
    }
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
        <script type="text/javascript" language="javascript">
        $(function() {
            var vPrev = "Prev";
            var vNext = "Next";
            var maxcnt = 10;
            RollingText(vPrev, vNext, 1);
            function RollingText(P, N, idx)
            {
                var Prev = "#"+P+idx
                var Next = "#"+N+idx
                
                var pos1 = $(Prev).css("top").replace("px", "")
                var pos2 = $(Next).css("top").replace("px", "")

                var contents1 = $(Prev).html();

                //alert('111');
                if (pos1 <= -33)
                {
                $(Prev).css("top", "33px");
                }

                if (pos2 <= -66)
                {
                    $(Next).css("top", "0px");
                }
                fn_Next(idx,contents1);
                $(Prev).delay(900).animate({top: "-=33px"}, 1000, function(){
                });
                $(Next).delay(900).animate({top: "-=33px"}, 1000, function(){
                    fn_Prev(idx,contents1);
                    idx++;
                    if(idx > maxcnt){
                        RollingText(P, N, 1);
                    }else{
                        RollingText(P, N, idx);
                    }
                });
            }
            //다음 순위 불러오는 함수 처리 Ajax
            function fn_Next(val,contents1){
                // var text = val+"순위";
                var text = contents1;
                var NextVal = "#"+vNext+val
                $(NextVal).empty().append(text);
            }
            //다음이 지나가고 이전꺼에 다음 순위 불러오는 처리 Ajax
            function fn_Prev(val,contents1){
                // var text = (val)+"순위";
                var text = contents1;
                var PrevVal = "#"+vPrev+val
                $(PrevVal).empty().append(text);
            }
        }); 

        $(function() {
            var vPrev2 = "Prev2";
            var vNext2 = "Next2";
            var maxcnt = 10;
            RollingText2(vPrev2, vNext2, 1);
            function RollingText2(P, N, idx)
            {
                var Prev2 = "#"+P+idx
                var Next2 = "#"+N+idx
                
                var pos12 = $(Prev2).css("top").replace("px", "")
                var pos22 = $(Next2).css("top").replace("px", "")

                var contents2 = $(Prev2).html();

                //alert('111');
                if (pos12 <= -33)
                {
                $(Prev2).css("top", "33px");
                }

                if (pos22 <= -66)
                {
                    $(Next2).css("top", "0px");
                }
                fn_Next(idx,contents2);
                $(Prev2).delay(900).animate({top: "-=33px"}, 1000, function(){
                });
                $(Next2).delay(900).animate({top: "-=33px"}, 1000, function(){
                    fn_Prev(idx,contents2);
                    idx++;
                    if(idx > maxcnt){
                        RollingText2(P, N, 1);
                    }else{
                        RollingText2(P, N, idx);
                    }
                });
            }
            //다음 순위 불러오는 함수 처리 Ajax
            function fn_Next(val,contents2){
                // var text = val+"순위";
                var text2 = contents2;
                var NextVal2 = "#"+vNext2+val
                $(NextVal2).empty().append(text2);
            }
            //다음이 지나가고 이전꺼에 다음 순위 불러오는 처리 Ajax
            function fn_Prev(val,contents2){
                // var text = (val)+"순위";
                var text2 = contents2;
                var PrevVal2 = "#"+vPrev2+val
                $(PrevVal2).empty().append(text2);
            }
        }); 

        $(function() {
            var vPrev3 = "Prev3";
            var vNext3 = "Next3";
            var maxcnt = 10;
            RollingText3(vPrev3, vNext3, 1);
            function RollingText3(P, N, idx)
            {
                var Prev3 = "#"+P+idx
                var Next3 = "#"+N+idx
                
                var pos13 = $(Prev3).css("top").replace("px", "")
                var pos23 = $(Next3).css("top").replace("px", "")

                var contents3 = $(Prev3).html();

                //alert('111');
                if (pos13 <= -33)
                {
                $(Prev3).css("top", "33px");
                }

                if (pos23 <= -66)
                {
                    $(Next3).css("top", "0px");
                }
                fn_Next(idx,contents3);
                $(Prev3).delay(900).animate({top: "-=33px"}, 1000, function(){
                });
                $(Next3).delay(900).animate({top: "-=33px"}, 1000, function(){
                    fn_Prev(idx,contents3);
                    idx++;
                    if(idx > maxcnt){
                        RollingText3(P, N, 1);
                    }else{
                        RollingText3(P, N, idx);
                    }
                });
            }
            //다음 순위 불러오는 함수 처리 Ajax
            function fn_Next(val,contents3){
                // var text = val+"순위";
                var text3 = contents3;
                var NextVal3 = "#"+vNext3+val
                $(NextVal3).empty().append(text3);
            }
            //다음이 지나가고 이전꺼에 다음 순위 불러오는 처리 Ajax
            function fn_Prev(val,contents3){
                // var text = (val)+"순위";
                var text3 = contents3;
                var PrevVal3 = "#"+vPrev3+val
                $(PrevVal3).empty().append(text3);
            }
        }); 
        </script>
    </head>
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

        .catBlock{
            border: 2px solid #d2d0d0;
            width: fit-content;
            padding: 0.5%;
            box-shadow: 4px 4px 10px #b5b5b5;
            margin-bottom: 4%;
        }
        .colorCode{
            display: block;
            float: left;
            padding: 10px;
            -webkit-border-radius: 100px;
        }
        .colorName{
            display: block; 
            float: left; 
            margin-left: 10px;
            margin-right: 10px;
        }
        .colorBlock{
            margin-bottom: 1%;
            display: block; 
            float: left;
        }
        .btnContents{
            background:white;
            border:2px solid white;
            font-size: 110%;
            height:30px;
            cursor: pointer;
            font-weight: bold;
        }
        .realtimeBlock{
            width: 33.333333%; float: left;
        }

        #SpecialRolling ,  #SpecialRolling2, #SpecialRolling3 {border:0px solid red; width: 100%; height: 40px; overflow: hidden; position: relative; font-weight: bold; z-index: 0;}
        #SpecialRolling div {width: 100%; height: 33px; padding-top: 7px; position: relative;}
        #SpecialRolling2 div {width: 100%; height: 33px; padding-top: 7px; position: relative;}
        #SpecialRolling3 div {width: 100%; height: 33px; padding-top: 7px; position: relative;}

        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
        .back {
            /* width: 33%;
            height: 200px; */
            float: left;
            width: 8%;
            /* border: 10px; */
            border-color: #ffffff;
            border-style: solid;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            counter-increment: bc;
            /* padding: 0px 5px 5px 5px; */
        }

        .back:before {
            position: absolute;
            padding: 10px;
        }

        @media screen and (max-width: 1260px) {
            .back {
                width: 50%;
            }
        }

        @media screen and (max-width: 840px) {
            .back {
                width: 100%;
            }
        }

        .button_base {
            margin: 0;
            border: 0;
            font-size: 18px;
            /* position: relative;
            top: 50%;
            left: 50%;
            margin-top: -25px;
            margin-left: -100px; */
            /* width: 200px; */
            height: 50px;
            /* text-align: center; */
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-user-select: none;
            cursor: default;
        }

        .button_base:hover {
            cursor: pointer;
        }

        /* ### ### ### 05 */
        .b05_3d_roll {
            perspective: 500px;
            -webkit-perspective: 500px;
            -moz-perspective: 500px;
        }

        .b05_3d_roll input {
            position: absolute;
            text-align: center;
            width: 100%;
            height: 30px;
            /* padding: 10px; */
            border: #000000 solid 1px;
            /* pointer-events: none; */
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .b05_3d_roll input:nth-child(1) {
            color: #000000;
            background-color: #000000;
            transform: rotateX(90deg);
            -webkit-transform: rotateX(90deg);
            -moz-transform: rotateX(90deg);
            transition: all 0.2s ease;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            transform-origin: 50% 50% -15px;
            -webkit-transform-origin: 50% 50% -15px;
            -moz-transform-origin: 50% 50% -15px;
        }

        .b05_3d_roll input:nth-child(2) {
            color: #000000;
            background-color: #ffffff;
            transform: rotateX(0deg);
            -webkit-transform: rotateX(0deg);
            -moz-transform: rotateX(0deg);
            transition: all 0.2s ease;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            transform-origin: 50% 50% -15px;
            -webkit-transform-origin: 50% 50% -15px;
            -moz-transform-origin: 50% 50% -15px;
        }

        .b05_3d_roll:hover input:nth-child(1) {
            color: #ffffff;
            transition: all 0.2s ease;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            transform: rotateX(0deg);
            -webkit-transform: rotateX(0deg);
            -moz-transform: rotateX(0deg);
        }

        .b05_3d_roll:hover input:nth-child(2) {
            background-color: #000000;
            transition: all 0.2s ease;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            transform: rotateX(-90deg);
            -webkit-transform: rotateX(-90deg);
            -moz-transform: rotateX(-90deg);
        }

        .relate{
            padding-bottom: 0.5%;
            width: fit-content;
            border-bottom: 2px solid;
            font-weight: bold;
            font-size: 150%; 
            margin-bottom: 1.5%;
        }

        .reword{
            display:block; float:left;
            margin-right: 1%;
        }

        .line{
            width: 100%;
            /* background-color: #cccaca7a; */
            /* padding-top: 1.5px !important;
            margin-top: 3%; */
            padding-left: 0px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .border{
            border-right: 2px dashed #a9a5a5;
            padding-top: 0px !important;
        }

        .ab {
            background-color: #fff0b3c7;
        }

        .btn1, .btn2, .btn3, .btn4, .btn5, .btn6, .btn7, .btn8, .btn9, .btn10{
            cursor:pointer;
        }
        .btn1:hover, .btn2:hover, .btn3:hover, .btn4:hover, .btn5:hover, .btn6:hover, .btn7:hover, .btn8:hover, .btn9:hover, .btn10:hover{
            font-weight: bold;
        }
    </style>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
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
			<div class="container">
				<div class="row">				
					<!-- Content -->
					<div id="content" class="12u skel-cell-important">
						<section>
							<header>
								<h2>Real - Time</h2>
                                <span class="byline">NAVER / DAUM / NATE&emsp;REAL-TIME</span>
                            </header>
                            
                            <hr style="padding: 2em 0 0 0; margin:0;">

							<div  class = "catBlock" id="catBlock">
                            <div style="font-size: 110%; margin-bottom: 1%; font-weight: bold;">CATEGORY COLOR CODE</div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #f80303;"></div>
                                    <div class="colorName">건강정보</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #FF9800;"></div>
                                    <div class="colorName">기업</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #FFEB3B;"></div>
                                    <div class="colorName">단체</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #8BC34A;"></div>
                                    <div class="colorName">영화</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #03A9F4;"></div>
                                    <div class="colorName">음식</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #992b23;"></div>
                                    <div class="colorName">음악</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #9C27B0;"></div>
                                    <div class="colorName">인물</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #ff00eb;"></div>
                                    <div class="colorName">장소</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #000000c7;"></div>
                                    <div class="colorName">TV프로그램</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock">
                                    <div class="colorCode" style="background-color: #3F51B5;"></div>
                                    <div class="colorName">기타</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div style="clear:both"></div>
                            </div>

                            <!-- real-time -->
                            <div class="row" style="margin-top: 2%;">
                                <section class="4u border">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                    <a href="https://www.naver.com" target="_blank"><div style="background-image:url('images/naver.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>
                                        <div style="margin-top: 1%;">
                                            <?php
                                                $sql = "select * from naver order by time desc, rank limit 10";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_array($result)){
                                                    echo '<div id="SpecialRolling">';
                                                    echo '<div id="Prev'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents " type ="submit" name = "nkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '<div id="Next'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents " type ="submit" name = "nkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>

                                <section class="4u border">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                    <a href="https://www.daum.net/" target="_blank"><div style="background-image:url('images/daum.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>

                                        <div style="margin-top: 1%;">
                                            <?php
                                                $sql = "select * from daum order by time desc, rank limit 10";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_array($result)){
                                                    echo '<div id="SpecialRolling2">';
                                                    echo '<div id="Prev2'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" type ="submit" name = "dkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '<div id="Next2'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" type ="submit" name = "dkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>

                                <section class="4u">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                        <a href="https://www.nate.com/" target="_blank"><div style="background-image:url('images/nate.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>

                                        <div style="margin-top: 1%;">
                                            <?php
                                                $sql = "select * from nate order by time desc, rank limit 10";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_array($result)){
                                                    echo '<div id="SpecialRolling3">';
                                                    echo '<div id="Prev3'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" type ="submit" name = "nnkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '<div id="Next3'.$row["rank"].'"><span class="rank">'.$row["rank"].'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.$row["color"].'" type ="submit" name = "nnkeyword" value = "'.$row["contents"].'"/></div>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>
                                <div style="clear:both"> </div>
                            </div> 

                            <!-- relate keyword -->   
                            <div style="padding-top: 3%;"> 
                                <section>       
                                    <div class="relate"> <a style="color: #777777;" href="<?php echo $sn.$reWord; ?>"  target="_blank"> <?php echo $reWord; ?> </a></div>
                                    <div style="margin-bottom: 2%;">
                                        <?php
                                            $sql = "select yeon from relation where contents = '".$reWord."' and date='".date("Y-m-d")."' limit 5";
                                            $result = mysqli_query($conn, $sql);
                                            $cnt = mysqli_num_rows($result);
                                            if($cnt==0 && $reWord !=NULL){
                                                echo '<div> 새로 추가된 연관 검색어가 없습니다. </div>';
                                            }
                                            else{
                                                while($row = mysqli_fetch_array($result)){
                                                    echo '<div class="reword"> <a href="'.$sn.$row["yeon"].'" target="_blank" > #'.$row["yeon"].' </a></div>';
                                                }
                                            }
                                            
                                        ?>
                                        <div style="clear:both;"></div>
                                    </div>
                                    
                                    <?php
                                        if($reWord !=NULL){
                                            echo '<div class="relate"> Last relate keyword</div>';
                                        }
                                    ?>
                                    <div>
                                        <?php
                                            $b = strtotime("-1 months") ; 
                                            $c = date("Y-m-d" , $b) ;

                                            $d = strtotime("-1 days") ; 
                                            $e = date("Y-m-d", $d);

                                            $sql = "select yeon from relation where (contents = '".$reWord."') and date(date) between '".$c."' and '".$e. "' limit 5";
                                            $result = mysqli_query($conn, $sql);
                                            $cnt = mysqli_num_rows($result);
                                            if($cnt == 0 && $reWord !=NULL){
                                                echo '<div style="margin-bottom: 2%;"> 최근 한달동안 실시간 검색어에 오른 날이 없습니다. </div>';
                                            }
                                            else{
                                                while($row = mysqli_fetch_array($result)){
                                                    echo '<div class="reword" style="margin-bottom: 2%;"> <a href="'.$sn.$row["yeon"].'" target="_blank" > #'.$row["yeon"].' </a></div>';
                                                }
                                            }
                                            
                                        ?>
                                        <div style="clear:both;"></div>
                                    </div>

                                    <div>
                                        <?php 
                                            $sql = 'select * from '.$site.' where contents = "'.$reWord.'"';      
                                            $result = mysqli_query($conn, $sql);
                                            $i=0;
                                            $d =[];
                                            echo '<div class="relate"> 실시간 검색어에 오른 날</div>';
                                            while($row = mysqli_fetch_array($result)){
                                                if(in_array(substr($row["time"], 0, -6), $d) == false){
                                                    echo '<div class="reword">'.substr($row["time"], 0, -6).'</div>';
                                                    $d[$i] = substr($row["time"], 0, -6);
                                                    $i++;
                                                    
                                                }
                                            }
                                            
                                        ?>
                                        <div style="clear:both;"></div>
                                    </div>
                                </section>
                            </div>

						</section>
					</div>

                </div>

                <div class="row"> 
                    <!-- <div class="line"></div> -->
                    <hr class="line">
                </div>

                <div class="row">				
					<!-- WEEKEND -->
					<div id="content" class="12u skel-cell-important">
						<section>
							<header>
								<h2>Weekend</h2>
								<span class="byline">You can search for popular searches by period.</span>
                            </header>
                            
                            <hr style="padding: 2em 0 0 0; margin:0;">

							<div  class = "catBlock" id="catBlock2">
                                <div style="font-size: 110%; margin-bottom: 1%; font-weight: bold;">CATEGORY COLOR CODE</div>
                                <div class="colorBlock btn1">
                                    <div class="colorCode" style="background-color: #f80303;"></div>
                                    <div class="colorName">건강정보</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn2">
                                    <div class="colorCode" style="background-color: #FF9800;"></div>
                                    <div class="colorName">기업</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn3">
                                    <div class="colorCode" style="background-color: #FFEB3B;"></div>
                                    <div class="colorName">단체</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn4">
                                    <div class="colorCode" style="background-color: #8BC34A;"></div>
                                    <div class="colorName">영화</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn5">
                                    <div class="colorCode" style="background-color: #03A9F4;"></div>
                                    <div class="colorName">음식</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn6">
                                    <div class="colorCode" style="background-color: #992b23;"></div>
                                    <div class="colorName">음악</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn7">
                                    <div class="colorCode" style="background-color: #9C27B0;"></div>
                                    <div class="colorName">인물</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn8">
                                    <div class="colorCode" style="background-color: #ff00eb;"></div>
                                    <div class="colorName">장소</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn9">
                                    <div class="colorCode" style="background-color: #000000c7;"></div>
                                    <div class="colorName">TV프로그램</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="colorBlock btn10">
                                    <div class="colorCode" style="background-color: #3F51B5;"></div>
                                    <div class="colorName">기타</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <!-- select date -->
                            <div class="row" style="margin-top: 2%;">
                                <form style="width: 100%;" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <div style="float:left">
                                        <span style="font-size: 110%;"> SET PERIOD </span>
                                        <input type="date" name="sdate" value="<?php echo $sDate ?>"/>
                                        <span> ~ </span>
                                        <input type="date" name="edate" value="<?php echo $eDate ?>"/>
                                    </div>
                                    <div class="back">
                                        <div class="button_base b05_3d_roll">
                                            <input style="cursor: pointer;" type="submit" name="period" value = "SELECT"/>
                                            <input style="cursor: pointer;" type="submit" name="period" value = "SELECT"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- weekend keyword-->
                            <div class="row">
                                <section class="4u border">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                    <a href="https://www.naver.com" target="_blank"><div style="background-image:url('images/naver.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>
                                        <div style="margin-top: 1%; font-weight: bold;">
                                            <?php
                                                $sql = "select color, contents, count(contents) as cnt from naver where date(time) between '".$sDate."' and '".$eDate. "' group by contents order by cnt desc limit 10;";
                                                $result = mysqli_query($conn, $sql);
                                                $rank=0;
                                                while($row = mysqli_fetch_array($result)){
                                                    $rank++;
                                                    echo '<div style="margin-bottom: 2%;"><span class="rank">'.$rank.'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.str_replace("#","",$row["color"]).'" type ="submit" name = "keyword2" value = "'.$row["contents"].'"/></div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>

                                <section class="4u border">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                    <a href="https://www.daum.net/" target="_blank"><div style="background-image:url('images/daum.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>
                                        <div style="margin-top: 1%; font-weight: bold;">
                                            <?php
                                                $sql = "select color, contents, count(contents) as cnt from daum where date(time) between '".$sDate."' and '".$eDate. "' group by contents order by cnt desc limit 10;";
                                                $result = mysqli_query($conn, $sql);
                                                $rank=0;
                                                while($row = mysqli_fetch_array($result)){
                                                    $rank++;
                                                    echo '<div style="margin-bottom: 2%;"><span class="rank">'.$rank.'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.str_replace("#","",$row["color"]).'" type ="submit" name = "dkeyword2" value = "'.$row["contents"].'"/></div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>

                                <section class="4u" style="padding-top:0px;">
                                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        
                                    <a href="https://www.nate.com/" target="_blank"><div style="background-image:url('images/nate.png'); background-repeat:no-repeat; background-size: contain; width:auto; padding-top:20%; margin-top: 2%;"></div></a>
                                        <div style="margin-top: 1%; font-weight: bold;">
                                            <?php
                                                $sql = "select color, contents, count(contents) as cnt from nate where date(time) between '".$sDate."' and '".$eDate. "' group by contents order by cnt desc limit 10;";
                                                $result = mysqli_query($conn, $sql);
                                                $rank=0;
                                                while($row = mysqli_fetch_array($result)){
                                                    $rank++;
                                                    echo '<div style="margin-bottom: 2%;"><span class="rank">'.$rank.'위 </span><input style="color:'.$row["color"].'" class= "btnContents '.str_replace("#","",$row["color"]).'" type ="submit" name = "nkeyword2" value = "'.$row["contents"].'"/></div>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </section>
                                
                            </div>

                            <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
                            <script>
                            $( document ).ready( function() {
                                $( '.btn1' ).click( function() {
                                    $('.f80303').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.f80303' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.f80303' ).removeClass('ab');
                                } );
                            } );

                            $( document ).ready( function() {
                                $( '.btn2' ).click( function() {
                                    $('.FF9800').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.FF9800' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.FF9800' ).removeClass('ab');
                                } );
                            } );
                            $( document ).ready( function() {
                                $( '.btn3' ).click( function() {
                                    $('.FFEB3B').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.FFEB3B' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.FFEB3B' ).removeClass('ab');
                                } );
                            } );

                            $( document ).ready( function() {
                                $( '.btn4' ).click( function() {
                                    $('.8BC34A').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.8BC34A' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.8BC34A' ).removeClass('ab');
                                } );
                            } );
                            $( document ).ready( function() {
                                $( '.btn5' ).click( function() {
                                    $('.03A9F4').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.03A9F4' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.03A9F4' ).removeClass('ab');
                                } );
                            } );

                            $( document ).ready( function() {
                                $( '.btn6' ).click( function() {
                                    $('.992b23').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.992b23' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.992b23' ).removeClass('ab');
                                } );
                            } );
                            $( document ).ready( function() {
                                $( '.btn7' ).click( function() {
                                    $('.9C27B0').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.9C27B0' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.9C27B0' ).removeClass('ab');
                                } );
                            } );

                            $( document ).ready( function() {
                                $( '.btn8' ).click( function() {
                                    $('.ff00eb').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.ff00eb' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.ff00eb' ).removeClass('ab');
                                } );
                            } );
                            $( document ).ready( function() {
                                $( '.btn9' ).click( function() {
                                    $('.000000c7').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.000000c7' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.000000c7' ).removeClass('ab');
                                } );
                            } );

                            $( document ).ready( function() {
                                $( '.btn10' ).click( function() {
                                    $('.3F51B5').each(function(){
                                        $( this).toggleClass( 'ab' );
                                        $( 'input' ).not( 'input.3F51B5' ).removeClass('ab');
                                    });
                                    $( 'input' ).not( 'input.3F51B5' ).removeClass('ab');
                                } );
                            } );

                            </script>

                            <!-- relate keyword -->   
                            <div style="padding-top: 3%;"> 
                                <section>       
                                    <div class="relate"> <a style="color: #777777;" href="<?php echo $sn2.$reWord2; ?>"  target="_blank"> <?php echo $reWord2 ?> </a></div>
                                    <?php
                                        $sql = "select yeon from relation where contents = '".$reWord2."' order by date limit 5";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_array($result)){
                                            echo '<div class="reword"> <a href="'.$sn2.$row["yeon"].'" target="_blank" > #'.$row["yeon"].' </a></div>';
                                        }
                                    ?>
                                    <div style="clear:both;"></div>
                                </section>
                            </div>
						</section>
					</div>

				</div>
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